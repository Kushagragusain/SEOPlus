<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \SEOstats\Services as SEOstats;
use App\SearchedUrl;
use App\SearchedKeyword;
use App\GoogleKeywordsRank;
use App\Keydata;
use Auth;
use DB;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;

class KeyAddController extends Controller
{
    public $start;
    public $end;

	public function __construct( $start = 1, $end = 2 ) {
		$this->start = $start;
		$this->end = $end;
	}

    //add new keyword to display table
    public function addkeyword(Request $request){

        $result['keyword'] = $request->keyword;
        $url = $request->url;


        $urlId = SearchedUrl::latest('searched_at')->where('user_id', Auth::user()->id)->where('url', $url)->first()['id'];

        $check_keyword = SearchedKeyword::checkKeyword($url, $result['keyword']);

        //new keyword
        if( $check_keyword->count() == 0 ){
            $t = Carbon::now();
            $key = new SearchedKeyword;
            $key->user_id = Auth::user()->id;
            $key->url_id = $urlId;
            $key->url = $url;
            $key->keyword = $result['keyword'];
            $key->searched_at = $t;
            $key->status = 'active';

            $key->latest_rank = $this->find($result['keyword']);

            $key->previous_rank = 'N.A.';
            $key->position_status = 'no';
            $key->save();
            $result['id'] = $key->id;
            $result['latest_rank'] = $key->latest_rank;
        }
        else{
            $result['id'] = 'null';
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

    public function find() {

        $data = SearchedKeyword::findorFail($id);
        $keyword = $data->keyword;
        $domain = $data->url;

        $query = str_replace(' ', '%20', $keyword);
        $urlid = SearchedUrl::fetchId($domain)['id'];

        $results = array();
        $fetch = array();
        $counter = 0;
        $check = 0;
        $rank = 0;
        $error = "";
        $getres = "";
        $res = [];
        $urls = [];
        $got = 0;


        $saveurls = "";
        $nw = date_create(Carbon::now());
         // $nw->sub(new \DateInterval('P7D'));

        //Checking keyword history and time elapsed.
        $temp = DB::table('storekeyurls')->where('keywordname', $keyword)->first();

        if((sizeof($temp) > 0)) {
            $er = date_create($temp->latestcheck);
            $d_dates = date_diff($nw, $er);
        }

        if((sizeof($temp) > 0) && ($d_dates->format("%a") < 7)) {

            $ans = $temp->urls;

            //Calculate rank also from this content.
            $token = strtok($ans, "*");
            $cc = 0;
            while ($token !== false)
            {
                $res[$cc] = $token;
               // $te = "www.".$res[$cc];
                if($got == 0 && ((strpos(trim($res[$cc]), trim($domain)) !== false))) {
                    $rank = $cc+1;
                    $got = 1;
                    //  var_dump("hi");
                }
                $token = strtok("*");
                $cc++;
            }

            //store in keydata
            $store = new Keydata;
            $store->key_id = $id;
            $store->keyword_rank = $rank;
            $store->searched_at = Carbon::now();
            $store->save();
        }
        else {
            $getres = "Outside";
            $KEY = "AIzaSyCgEhwLRxr2-dN68_x58XMSsLelpKJxTxA";
            $CSE = "003799387166088970884:mguauzeslus";

           //var_dump($_SERVER['REMOTE_ADDR']);

            for($i = 0; $i <= 40; $i += 8) {

                $first = rand(40, 240);
                $second = rand(20, 250);
                $slast = rand(10, 254);
                $last = rand(10, 254);

                $ip = $first.".".$second.".".$slast.".".$last;

                //generate random string
                $newstr = "";
                $len = rand(10, 15);
                for($d = 0; $d < $len; $d++) {
                    $rvar = rand(97, 123);
                    $newstr .= chr($rvar);
                }

                $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$query."&rsz=large"."&start=".$i."&userIp=".$ip."&rand=".$newstr;

                $body = file_get_contents($url);
                //var_dump($body);
                $json = json_decode($body);

                if($json->responseData === NULL) {
                    //var_dump($json);
                    $error = "multiple";
                    break;
                }
                for($x=0;$x<count($json->responseData->results);$x++){
                    $res[$counter] = $json->responseData->results[$x]->visibleUrl;
                    $saveurls .= $res[$counter]."*";
                    //$te = "www.".$res[$counter];

                    // var_dump($res[$counter]);
                    //Check if URL matches
                    if($check == 0 && (strpos(trim($res[$counter]), trim($domain)) !== false)) {
                        $check = 1;
                        $rank = $counter+1;
                    }
                    $counter++;
                }

                $ssleep = 5;
                sleep($ssleep);
            }

            if($error !== "multiple") {
                $store = new Keydata;
                $store->key_id = $id;
                $store->keyword_rank = $rank;
                $store->searched_at = Carbon::now();
                $store->save();

                $x = Carbon::now();

                //Save keyword data as new
                DB::table('storekeyurls')->insert([
                    ['keywordname' => $keyword, 'urls' => $saveurls, 'latestcheck' => $x]
                ]);
            }

        }

        /*$fetch = Keydata::where('key_id', $id)->get();
        SearchedKeyword::findorFail($id)->update(['latest_rank' => $rank]);
        return view('pages.keyword_data', compact('keyword', 'rank', 'res', 'found', 'domain', 'urlid', 'fetch', 'error', 'ip', 'getres'));*/

        return $rank;
    }

    private function _isCurl() {
	   return function_exists( 'curl_version' );
    }

    private function _curl( $url ) {
		try {
	       $ch = curl_init( $url );

			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_HEADER, false );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
			curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:34.0) Gecko/20100101 Firefox/34.0' );
			curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 120 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 120 );
			curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_SSLVERSION, 3 );
			$content = curl_exec( $ch );
			$errno = curl_errno( $ch );
			$error = curl_error( $ch );
			curl_close( $ch );

			if ( !$errno ) {
				return $content;
			} else {
				return array( 'errno' => $errno, 'errmsg' => $error );
			}
        } catch ( Exception $e ) {
		  return array( 'errno' => $e->getCode(), 'errmsg' => $e->getMessage() );
		}
    }
}
