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
{
    //add new keyword to display table
    public function addkeyword(Request $request){

        $keyy = explode("\n", $request->keyword);

        $url = $request->url;

        for($i = 0; $i < count($keyy); $i++ ){
            $urlId = SearchedUrl::latest('searched_at')->where('user_id', Auth::user()->id)->where('url', $url)->first()['id'];

            $k = preg_replace( "/\r|\n/", "", $keyy[$i] ) ;
            $check_keyword = SearchedKeyword::checkKeyword($url, $k );
            $result[$i]['keyword'] = $k;

            //new keyword
            if( $check_keyword->count() == 0 && $k != '' ){
                $client = new Client('https://online.seranking.com/structure/clientapi/positions/?token=54b0b0b40bc9e349b211ba26e29b4578&method=addTask&query='.$k.'&engine_id=200');
                $request = $client->get();

                $response = $request->send();
                $ddata = json_decode($response->getBody(), true);

                $t = Carbon::now();
                $key = new SearchedKeyword;
                $key->user_id = Auth::user()->id;
                $key->task_id = $ddata['task_id'];

                $key->url_id = $urlId;
                $key->url = $url;
                $key->keyword = $k;
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
        $rank = [];
        $i = 0;
        $res = '';

        foreach( $data as $d ){
            if( $d['id'] != 'null' ){
                $taskid = SearchedKeyword::findorFail($d['id'])['task_id'];

                $rank[$i]['rank'] = $this->rank( $d['id'], $d['keyword'], $url, $taskid, 'first' );
                $rank[$i]['id'] = $d['id'];

                SearchedKeyword::findorFail($d['id'])->update([ 'latest_rank' => $rank[$i]['rank'] ]);
                $keydata = new Keydata;
                $keydata->key_id = $d['id'];
                $keydata->keyword_rank = $rank[$i]['rank'];
                $keydata->searched_at = Carbon::now();
                $keydata->save();

                $i = $i + 1;
            }
            //$res = $res."  ".$d['keyword'];
        }

        //return $data[1]['keyword'];
        return json_encode($rank);

        //return $rank[0]['rank'];
    }

    public function rank($id, $key, $url, $taskid, $stat){
        if( $stat === 'first' )
            sleep(180);

        $client = new Client('https://online.seranking.com/structure/clientapi/positions/?token=54b0b0b40bc9e349b211ba26e29b4578&method=getTaskResults&task_id='.$taskid);
        $request = $client->get();

        $count = 1;
        $rank = 0;
        $ch = 0;

        $response = $request->send();
        $data = json_decode($response->getBody(), true);

        $urldata = '';

        foreach($data as $d){
            foreach($d as $dd){

                $urldata = $urldata."".$dd['url'];
                if( $count < 100 )
                    $urldata = $urldata."@";

                if( $rank == 0 && strpos($dd['url'], $url) )
                    $rank = $count;

                $count++;
                if( $count > 100 ){
                    $ch = 1;
                    break;
                }
            }
            if( $ch != 0 )
                break;
        }

        if( $stat == 'first' ){
            $store = new Storekeyurl;
            $store->keywordname = $key;
            $store->urls = $urldata;
            $store->latestcheck = Carbon::now();
            $store->save();
        }
        else {
            $keyy = SearchedKeyword::find($id);
            SearchedKeyword::find($id)->update(['latest_rank' => $rank, 'previous_rank' => $keyy['latest_rank']]);
        }

        return $rank;
                //return $dd['url'];
    }

    public function refresh(Request $request){
        $url = $request->data;
        $data = SearchedKeyword::where('user_id', Auth::user()->id)->where('url', $url)->get();
        $rank = [];
        $i = 0;

        foreach($data as $d){
            $rank[$i]['id'] = $d['id'];
            $rank[$i]['rank'] = $this->rank($d['id'], $d['keyword'], $url, $d['task_id'], 100);
            $i = $i + 1;
        }
        return json_encode($rank);
    }
}
