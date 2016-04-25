<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;

//guzzle lib
use Guzzle\Http\Client;

//seostats lib
use \SEOstats\Services as SEOstats;

//models
use App\SearchedUrl;
use App\SearchedKeyword;
use App\GoogleKeywordsRank;
use App\Keydata;
use App\Storekeyurl;

class KeyAddController extends Controller
{   public function getTaskId($k){
        $client = new Client('https://online.seranking.com/structure/clientapi/positions/?token=54b0b0b40bc9e349b211ba26e29b4578&method=addTask&query='.$k.'&engine_id=200');
        $request = $client->get();

        $response = $request->send();
        $ddata = json_decode($response->getBody(), true);

        return $ddata['task_id'];
    }

    //add new keyword to display table
    public function addkeyword(Request $request){

        $keyy = explode("\n", $request->keyword);

        $url = $request->url;

        for($i = 0; $i < count($keyy); $i++ ){
            $urlId = SearchedUrl::latest('searched_at')->where('user_id', Auth::user()->id)->where('url', $url)->first()['id'];

            $k = preg_replace( "/\r|\n/", "", $keyy[$i] ) ;
            $check_keyword = SearchedKeyword::checkKeyword($url, $k );
            $result[$i]['keyword'] = $k;
            $k = str_replace( ' ', '+', trim( $k ) );

            //new keyword
            if( $check_keyword->count() == 0 && $k != '' ){
                $t = Carbon::now();
                $key = new SearchedKeyword;
                $key->user_id = Auth::user()->id;
                $key->task_id = $this->getTaskId($k);

                $key->url_id = $urlId;
                $key->url = $url;
                $key->keyword = $result[$i]['keyword'];
                $key->searched_at = $t;
                $key->status = 'active';

                $key->latest_rank = 'N.A.';
                    //$this->find($result['keyword'], $url);

                $key->previous_rank = 'N.A.';
                $key->position_status = 'no';
                $key->save();

                $result[$i]['id'] = $key->id;
                $result[$i]['latest_rank'] = $key->latest_rank;

            }
            else{
                $result[$i]['id'] = 'null';
            }
        }

        return json_encode($result);
    }

    //put all keywords added by currentle logged in user
    public function fetchkeywords(){
        $url = $_GET['domain'];
        $urlid = SearchedUrl::fetchId($url)['id'];

        SearchedKeyword::where('user_id', Auth::user()->id)->where('url', $url)->update(['url_id' => $urlid, 'status' => 'active']);

        $result = SearchedKeyword::activeKeywords($url);
        return json_encode($result);
    }

    //delete keyword
    public function deleteKeyword(){
        $id = $_GET['id'];
        SearchedKeyword::find($id)->delete();
        Keydata::where('key_id', $id)->delete();
    }

    //open keyword ranking page
    public function find($id){
        $keyrank = SearchedKeyword::findorFail($id);
        //return $keyrank['url_id'];
        $fetch = Keydata::where('key_id', $id)->get();
        $urldata = Storekeyurl::where('keywordname', $keyrank['keyword'])->first()['urls'];
        $res = explode("@", $urldata);

        return view('pages.keyword_data', compact('keyrank', 'fetch', 'res'));
    }

    public function getRank(Request $request){
        $data = $request->data;
        $url = $request->url;
        $count = $request->countt;
        $rank = [];
        $i = 0;
        $res = '';

        foreach( $data as $d ){
            if( $d['id'] != 'null' ){
                $taskid = SearchedKeyword::findorFail($d['id'])['task_id'];

                $rank[$i]['rank'] = $this->rank( $d['id'], $d['keyword'], $url, $taskid, 'first' );
                $rank[$i]['id'] = $count;

                SearchedKeyword::findorFail($d['id'])->update([ 'latest_rank' => $rank[$i]['rank'] ]);
                /*$keydata = new Keydata;
                $keydata->key_id = $d['id'];
                $keydata->keyword_rank = $rank[$i]['rank'];
                $keydata->searched_at = Carbon::now();
                $keydata->save();*/

                $i = $i + 1;
                $count = $count + 1;
            }
        }

        return json_encode($rank);
    }

    public function rank($id, $key, $url, $taskid, $stat){
        while( $stat === 'first' &&  $this->demo($taskid) == 0 ){
            sleep(30);
        }

        $count = 1;
        $rank = 0;
        $ch = 0;

        $client = new Client('https://online.seranking.com/structure/clientapi/positions/?token=54b0b0b40bc9e349b211ba26e29b4578&method=getTaskResults&task_id='.$taskid);
        //var_dump($taskid);
        $request = $client->get();

        $response = $request->send();
        $data = json_decode($response->getBody(), true);

        $urldata = '';

        foreach($data as $d){
            foreach($d as $dd){

                if( $count > 100 ){
                    if( $rank > 0 ){
                        $ch = 1;
                        break;
                    }
                }
                else{
                    $urldata = $urldata."".$dd['url'];
                    if( $count < 100 )
                        $urldata = $urldata."@";
                }

                if( $rank == 0 && strpos($dd['url'], $url) )
                {
                    $rank = $count;
                }

                $count++;

            }
            if( $ch != 0 )
                break;
        }
        //$rank = 290;
        if( $stat == 'first' ){
            $datacheck = Storekeyurl::where('keywordname', $key)->get();

            if( count($datacheck) > 0 ) {
                Storekeyurl::where('keywordname', $key)->update(['urls'=> $urldata]);
            }
            else{
                $store = new Storekeyurl;
                $store->keywordname = $key;
                $store->urls = $urldata;
                $store->latestcheck = Carbon::now();
                $store->save();
            }
            if( $rank == 0 )
                $rank = 'N.A.';
        }
        else {
            $keyy = SearchedKeyword::find($id);
            $pos = 'no';
            if( $rank == 0 ){
                if( $keyy['latest_rank'] != 'N.A.' )
                    $pos = 'dec';
                $rank = 'N.A.';
            }
            else{
                if( $keyy['latest_rank'] == 'N.A.' )
                    $pos = 'inc';
                else
                {   if( $keyy['latest_rank'] < $rank )
                        $pos = 'dec';
                    else if( $keyy['latest_rank'] > $rank )
                        $pos = 'inc';
                }
            }

            Storekeyurl::where('keywordname', $key)->update(['urls'=> $urldata]);
            SearchedKeyword::find($id)->update(['task_id' => $taskid, 'latest_rank' => $rank, 'previous_rank' => $keyy['latest_rank'], 'position_status' => $pos]);
        }
        $keydata = new KeyData;
        $keydata->key_id = $id;
        $keydata->keyword_rank = $rank;
        $keydata->searched_at = Carbon::now();
        $keydata->save();

        return $rank;
                //return $dd['url'];
    }

    public function refresh(Request $request){
        $id = $request->key_id;
        $data = SearchedKeyword::find($id);
        //$taskid = $this->getTaskId($data['keyword']);
        $rank['rank'] = $this->rank($id, $data['keyword'], $data['url'], $data['task_id'], 100);

        $keydata = SearchedKeyword::find($id);
        $rank['pos'] = $keydata['position_status'];
        $rank['ii'] = $request->ii;
        $rank['latest'] = $keydata['latest_rank'];
        $rank['previous'] = $keydata['previous_rank'];

        return json_encode($rank);
    }

    public function demo($taskid){
        $client = new Client('https://online.seranking.com/structure/clientapi/positions/?token=54b0b0b40bc9e349b211ba26e29b4578&method=getTasks');
        $request = $client->get();

        $response = $request->send();
        $data = json_decode($response->getBody(), true);

        $id = array_column($data['tasks'], 'id');
        $key = array_search($taskid, $id);

        $complete = array_column($data['tasks'], 'is_completed');


        //if(array_search('64', array_column($data['tasks'], 'id')))

        return $complete[$key];
    }

    public function avgRank(Request $request){

        $urlid = $request->urlid;
        $data = SearchedKeyword::where('url_id', $urlid)->get();
        $tot = 0;
        $avg = 0;

        foreach( $data as $d ){
            $avg += (int)$d['latest_rank'];
            $tot++;
        }
        if($tot != 0)
        $avg = $avg / $tot;

        return (int)$avg;
    }

    public function edit(Request $request){
        $newkey = $request->key;
        $id = $request->id;

        Keydata::where('key_id', $id)->delete();

        $task_id = $this->getTaskId($newkey);

        SearchedKeyword::find($id)->update(['task_id' => $task_id, 'keyword' => $newkey, 'searched_at' => Carbon::now(), 'latest_rank' => 'N.A.', 'position_status' => 'no']);
    }

    public function editrank(Request $request){
        $id = $request->id;
        $data = SearchedKeyword::find($id);
        $rank = $this->rank( $id, $data['keyword'], $data['url'], $data['task_id'], 'first' );;
        SearchedKeyword::find($id)->update(['latest_rank' => $rank]);

        return $rank;
    }
}
