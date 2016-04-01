<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \SEOstats\Services as SEOstats;
use App\SearchedUrl;
use App\SearchedKeyword;
use Auth;
use Carbon\Carbon;

class SEOController extends Controller
{
    public function domainData(Request $request){
        //store searched url in table searched_urls
        $store = new SearchedUrl;
        $store->user_id = Auth::user()->id;
        $store->url = $request->url;
        $store->searched_at = Carbon::now();
        $store->save();
        
        try {
            $url = 'http://www.'.$request->url;

            // Create a new SEOstats instance.
            $seostats = new \SEOstats\SEOstats;

            // Bind the URL to the current SEOstats instance.
            if ($seostats->setUrl($url)) {
                $tp = 'url';
                $type = 'url';
                $specified_country = $request->country;
                $heading = $request->url;
                $alexa_rank = SEOstats\Alexa::getGlobalRank();
                $google_page_rank = SEOstats\Google::getPageRank();
                $backlinks = SEOstats\Google::getBacklinksTotal();
                $origin_country = SEOstats\Alexa::getCountryRank();
                $country_rank = SEOstats\SemRush::getDomainRank($url, $specified_country);
                //$top10 = SEOstats\Google::getSerps($url);
                return view('pages.results', compact( 'tp', 'type', 'heading', 'alexa_rank', 'google_page_rank','backlinks',                        'origin_country', 'country_rank', 'specified_country' ));
            }

        }
        catch (SEOstatsException $e) {
          die($e->getMessage());  
        }
    }
    
    public function keywordData(Request $request){
        $keyword = $request->keyword;

        //store searched keyword in table searched_keywords
        $store = new SearchedKeyword;
        $store->user_id = Auth::user()->id;
        $store->keyword = $keyword;
        $store->searched_at = Carbon::now();
        $store->save();
        
        return view('pages.results', [
                'tp' => 'keyword',
                'keyword' => $keyword,
                'heading' => $request->url,
                'x' => SEOstats\Google::getSerps($keyword, 20, 'http://www.'.$request->url)
            ]);
    }
    
    public function history(){
        $urls = SearchedUrl::latest('searched_at')->where('user_id', Auth::user()->id)->get();
        $keywords = SearchedKeyword::latest('searched_at')->where('user_id', Auth::user()->id)->get();
        return view('pages.history', compact('urls', 'keywords'));
    }
}
