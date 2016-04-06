<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SearchedKeyword;
use App\SearchedUrl;
use App\Keydata;
use Carbon\Carbon;
use \SEOstats\Services as SEOstats;
use App\GoogleKeywordsRank;

class KeywordController extends Controller
{
    //if ( ini_set( 'max_execution_time', 1200 ) !== FALSE )
    //ini_set( 'max_execution_time', 1200 );

    public $start;
    public $end;

	public function __construct( $start = 1, $end = 2 ) {
		$this->start = $start;
		$this->end = $end;
	}

    /*

        if( ctype_digit($id) ){
            $data = SearchedKeyword::findorFail($id);
            $keyword = $data->keyword;
            $domain = $data->url;

            $urlid = SearchedUrl::fetchId($domain)['id'];

            $results = array();
            $res = array();
            $fetch = array();

            for ( $start = ( $this->start-1 ) * 10; $start <= $this->end * 10; $start += 10 ) {
                $ua	= array(
                    0 	=> 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                    10 	=> 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
                    20 	=> 'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0;  rv:11.0) like Gecko'
                );

                $options = array(
                    "http" => array(
                        "method" => "GET",
                        "header" => "Accept-language: en\r\n" .
                            "Cookie: SEO Zen\r\n" .
                        "User-Agent: " . $ua[ $start ] )
                );

                $keyword = str_replace( ' ', '+', trim( $keyword ) );
                $url = 'https://www.google.com/search?ie=UTF-8&q=' . $keyword . '&start=' . $start . '&num=30';
                $context = stream_context_create( $options );

                if ( $this->_isCurl() ) {
                    $data = $this->_curl( $url );
                } else {
                    $data	= @file_get_contents( $url, false, $context );
                }
                var_dump($data);
                if ( is_array( $data ) ) {
                    $errmsg = $data['errmsg'];
                    $results = array( 'rank' => 'zerox', 'url' => $errmsg );
                    $check = 'fail';
                } else {
                    if ( strpos( $data, 'To continue, please type the characters below' ) !== FALSE || $data == FALSE || strpos( $data, "We're sorry" ) !== FALSE ) {
                        $results = array( 'rank' => 'zero', 'url' => '' );
                        $check = 'fail';
                    } else {
                        $j = -1;
                        $i = 1;
                        $check = 'success';

                        while( ( $j = stripos( $data, '<cite class="_Rm">', $j+1 ) ) !== false ) {
                            $k = stripos( $data, '</cite>', $j );
                            $link = strip_tags( substr( $data, $j, $k-$j ) );
                            $rank	= $i++;
                            $results[] = array( 'rank' => $rank, 'url' => $link );
                        }

                        var_dump($i); die();
                    }
                }
            }

            if($check == 'success'){
                $i = 1;
                $rank = 10000000;
                var_dump($domain."\n");
                foreach( $results as $i ){
                    var_dump("\n".$i['url']);
                    if (strpos($i['url'], $domain)){
                        $rank = $i['rank'];
                        var_dump("==hey".$rank."==");
                    }
                    if( $i <= 10 )
                        $res[] = array( 'rank' => $i['rank'], 'url' => $i['url'] );
                    $i++;
                }

                /*if(count($res) > 0){
                    $sort_col = array();
                    foreach ($res as $key=> $row) {
                        $sort_col[$key] = $row['rank'];
                    }

                    array_multisort($sort_col, SORT_ASC, $res);


                    $store = new Keydata;
                    $store->key_id = $id;
                    $store->keyword_rank = $rank;
                    $store->searched_at = Carbon::now();
                    $store->save();
            }
            $fetch = Keydata::where('key_id', $id)->get();
            var_dump($res);

            return view('pages.keyword_data', compact('keyword', 'rank', 'res', 'check', 'domain', 'urlid', 'fetch'));
        }
        else
            return view('pages.error');
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




    @if($found == 'fail')
                        <h3>Sorry, some error ocuured. Please try again</h3>
                    @else
                        @if(count($res) == 0)
                            <h4>No result in top 100</h4>
                            <div class="clearfix"></div>
                        @else
                            <h4>Rank of {{ $domain }} for {{ $keyword }}:{{ $rank }}</h4>
                            <div class="clearfix"></div>
                            <br>
                            <h4>Top links</h4>
                            <div class="clearfix"></div>
                            @foreach($res as $i)
                                <h5><a href="{{ $i['url'] }}"> {{ $i['url'] }} </a></h5>
                                <div class="clearfix"></div>
                            @endforeach
                        @endif
                    @endif
    */
    public function foo() {

        /*$query = 'furnace%20calgary';
        $domain = "emergencyfurnacerepaircalgary.com";

        //To get top 100 results. Only 8 results at a time.
        for($i = 0; $i < 10; $i += 8) {
        $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$query.'&rsz=large'.'&start='.$i;

        $body = file_get_contents($url);
        $json = json_decode($body);

        $urls = [];
        $found = 0;
        $rank = 0;

        for($x=0;$x<count($json->responseData->results);$x++){
            $urls[$i+$x] = $json->responseData->results[$x]->visibleUrl;

            echo $urls[$i];
            //Check if URL matches
            if($found == 0 && strpos($urls[$i], $domain) !== false) {
                $found = 1;
                $rank = $i+1;
            }
            echo " ".$found;
        }

        }

        print_r($rank);
        echo "/n";
        print_r($urls);*/

        $gRank = new GoogleKeywordsRank('http://www.ycerdan.fr');
        $gRank->setMaxPages(5);

        $keywords = array();
        $keywords[] = "typo3";

        $keywordsPositions = $gRank->getKeywordsArrayRank($keywords);

        foreach ($keywordsPositions as $keywords) {
            echo 'For the keyword "' . $keywords[0] . '": ';
            if ($keywords[1] == 0) {
                echo 'you are not in the ' . ($gRank->getMaxPages() * 10) . ' first results';
            } else {
                echo 'you are ranked ' . $keywords[1];
            }
        }
        var_dump($keywordsPositions);
        die();
    }

    public function find($id) {
        if( ctype_digit($id) ){
            $data = SearchedKeyword::findorFail($id);
            $keyword = $data->keyword;
            $domain = $data->url;
            $domain = "http://".$domain;
            //$query = str_replace(' ', '%20', $keyword);
            $urlid = SearchedUrl::fetchId($domain)['id'];

            $results = array();
            $fetch = array();
            $counter = 0;
            $check = 0;
            $rank = 0;
            $error = "";
            $getres = [];
            $res = [];

            $KEY = "AIzaSyCgEhwLRxr2-dN68_x58XMSsLelpKJxTxA";
            $CSE = "003799387166088970884:mguauzeslus";

            var_dump($_SERVER['REMOTE_ADDR']);

               for($i = 0; $i < 10; $i += 8) {
                   // var_dump("hi");

                    $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=".$query.'&rsz=large'.'&start='.$i.'&key=AIzaSyCgEhwLRxr2-dN68_x58XMSsLelpKJxTxA&cx=003799387166088970884:mguauzeslus';

                    $body = file_get_contents($url);
                    //var_dump($body);
                    $json = json_decode($body);

                    if($json->responseData === NULL) {
                        $error = "multiple";
                        break;
                    }
                    for($x=0;$x<count($json->responseData->results);$x++){
                        $res[$counter] = $json->responseData->results[$x]->visibleUrl;
                         var_dump($res[$counter]);
                        echo "<br>";
                        //Check if URL matches
                        if($check === 0 && strpos($res[$counter], $domain) !== false) {
                            $check = 1;
                            $rank = $counter+1;
                        }

                         $counter++;
                    }

                }

                 var_dump($rank);
            die();
            /*try {

                // Create a new SEOstats instance.
                $seostats = new \SEOstats\SEOstats;

                $getres = SEOstats\Google::getSerps('furnace calgary', 10);
               // var_dump($getres);

            }
            catch (\Exception $e) {
                var_dump($e->getMessage());
            }

            //var_dump("h3");
            $x = 0;
            foreach($getres as $pp) {
              //  var_dump("hi");
              //  var_dump($pp["url"]);
                $res[$x] = $pp["url"];
                //Check if URL matches
                        if($check === 0 && strpos($pp["url"], $domain) !== false) {
                            $check = 1;
                            $rank = $counter+1;
                            break;
                        }
                $counter++;
               // echo $counter."<br>";
            }*/
            if($error !== "multiple") {
            $store = new Keydata;
            $store->key_id = $id;
            $store->keyword_rank = $rank;
            $store->searched_at = Carbon::now();
            $store->save();
            }
            $fetch = Keydata::where('key_id', $id)->get();

            return view('pages.keyword_data', compact('keyword', 'rank', 'res', 'check', 'domain', 'urlid', 'fetch', 'error'));
        }
        else
            return view('pages.error');
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
