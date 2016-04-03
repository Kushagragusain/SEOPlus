<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SearchedKeyword;

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

    public function find($id) {
        $data = SearchedKeyword::findorFail($id);
        $keyword = $data->keyword;
        $domain = $data->url;
        $results = array();
        $res = array();

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
                }
            }
        }

        if($check == 'success'){
            foreach( $results as $i ){
                if (strpos($i['url'], $domain)){
                    $res[] = array( 'rank' => $i['rank'], 'url' => $i['url'] );
                }
            }
        }

        $sort_col = array();
        foreach ($res as $key=> $row) {
            $sort_col[$key] = $row['rank'];
        }

        array_multisort($sort_col, SORT_ASC, $res);

		return view('pages.keyword_data', compact('keyword', 'res', 'check', 'domain'));
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
