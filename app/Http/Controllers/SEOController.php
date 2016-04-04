<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \SEOstats\Services as SEOstats;
use App\SearchedUrl;
use App\SearchedKeyword;
use App\Keydata;
use App\Country;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;

class SEOController extends Controller
{
    public function domainSave(Request $request){
        try {
            $url = 'http://www.'.$request->url;

            // Create a new SEOstats instance.
            $seostats = new \SEOstats\SEOstats;

            // Bind the URL to the current SEOstats instance.
            if ($seostats->setUrl($url)) {
                $cntry = Country::first()->where('tld', $request->country)->take(1)->get();
                foreach($cntry as $i)
                    $specified_country = $i['country_name'];
                $heading = $request->url;
                $alexa_rank = SEOstats\Alexa::getGlobalRank();
                $google_page_rank = SEOstats\Google::getPageRank();
                $backlinks = SEOstats\Google::getBacklinksTotal();
                $origin_country = SEOstats\Alexa::getCountryRank();
                $country_rank = SEOstats\SemRush::getDomainRank($url, $request->country);
                if( $country_rank=='n.a.' )
                    $country_rank_res = 'NA';
                else
                    $country_rank_res = $country_rank['Rk'];

                //store searched url in table searched_urls
                $store = new SearchedUrl;
                $store->user_id = Auth::user()->id;
                $store->url = $request->url;
                $store->specified_country = $request->country;
                $store->alexa_rank = $alexa_rank;
                $store->google_page_rank = $google_page_rank;
                $store->backlinks = $backlinks;
                $store->origin_country_name = $origin_country['country'];
                $store->origin_country_rank = $origin_country['rank'];
                $store->specified_country = $specified_country;
                $store->country_rank = $country_rank_res;
                $store->searched_at = Carbon::now();
                $store->save();

                $id = $store->id;
                $rurl = 'url_rank/'.$id;

                return Redirect::to($rurl)->with('mes', 'search');
                //return Redirect::route('showUrlData')->with('id', $id);

                //return redirect($rurl);

                //return view('pages.results', compact( 'heading', 'alexa_rank', 'google_page_rank','backlinks',                    'origin_country', 'country_rank', 'specified_country' ));
            }
        }
        catch (SEOstatsException $e) {
          die($e->getMessage());  
        }
    }
    
    public function fetchUrlData($id){
        if( ctype_digit($id) ){
            $data = SearchedUrl::find($id);
            $mes = Session::get('mes');

            $heading = $data->url;
            $alexa_rank = $data->alexa_rank;
            $google_page_rank = $data->google_page_rank;
            $backlinks = $data->backlinks;
            $origin_country['country'] = $data->origin_country_name;
            $origin_country['rank'] = $data->origin_country_rank;
            $country_rank = $data->country_rank;
            $specified_country = $data->specified_country;

            return view('pages.results', compact( 'id', 'heading', 'alexa_rank', 'google_page_rank','backlinks',                    'origin_country', 'country_rank', 'specified_country', 'mes' ));
        }
        else
            return view('pages.error');
    }

    /*public function keywordData($id){
        $data = SearchedKeyword::findorFail($id);
        $url = $data->url;
        $keyword = $data->keyword;

        $res = SEOstats\Google::getSerps($keyword, 10, 'http://www.'.$url);
        $totsearch = SEOstats\Google::getSearchResultsTotal($keyword);

        return view('pages.keyword_data', compact('keyword', 'url', 'res', 'totsearch'));
    }*/
    
    public function history(){
        $urls = SearchedUrl::where('user_id', Auth::user()->id)->get();
        //$keywords = SearchedKeyword::latest('searched_at')->where('user_id', Auth::user()->id)->get();
        return view('pages.history', compact('urls'));
    }

    //add new keyword to display table
    public function addkeyword(Request $request){
        $result['keyword'] = $request->keyword;
        $url = $request->url;
        $ch = 1;

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
            $key->save();
            $result['id'] = $key->id;

            $ch = 0;
        }
        else{
            $result['id'] = 'null';
        }

        return json_encode($result);
    }

    //remove keywords from display table on logout
    public function updateSearchedKeyworddb(){
        SearchedKeyword::status();
    }

    //put all keywords added by currentle logged in user
    public function fetchkeywords(){
        $url = $_GET['domain'];
        $urlid = SearchedUrl::fetchId($url)['id'];

        SearchedKeyword::where('user_id', Auth::user()->id)->where('url', $url)->update(['url_id' => $urlid, 'status' => 'active']);

        $result = SearchedKeyword::activeKeywords($url);
        return json_encode($result);
    }

    public function deleteKeyword(){
        $id = $_GET['id'];
        SearchedKeyword::find($id)->delete();
        Keydata::where('key_id', $id)->delete();
    }

    public function historydata($id){
        $rurl = 'url_rank/'.$id;
        return Redirect::to($rurl)->with('mes', 'history');
    }

    public function graph(Request $request){
        $id = $request->id;
        if( ctype_digit($id) ){
            $url = SearchedUrl::find($id)['url'];
            $data = SearchedUrl::where('user_id', Auth::user()->id)->where('url', $url)->get();

            $keywords = SearchedKeyword::where('user_id', Auth::user()->id)->where('url', $url)->get();
            return view('pages.showGraph', compact('id', 'data', 'keywords', 'id', 'url'));
        }
        else
            return view('pages.error');
    }

    /*public function demo(){
        $uid = $_GET['uid'];
        $type = $_GET['type'];
        if( $type == 'url' ){
            $url = SearchedUrl::find($uid)['url'];
            $data = SearchedUrl::where('user_id', Auth::user()->id)->where('url', $url)->get();
        }
        else{
            $data = Keydata::where('key_id', $uid)->get();
        }
        return json_encode($data);
    }*/
}
