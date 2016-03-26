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
        //validating url
        /*$this->validate($request, [
            'url'   => 'required|url',
        ]);*/
        
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
            return view('pages.results', [
                'url' => $request->url,
                'alexa_rank' => SEOstats\Alexa::getGlobalRank(),
                'google_page_rank' => SEOstats\Google::getPageRank(),
            ]);
          }
        }
        catch (SEOstatsException $e) {
          die($e->getMessage());  
        }
    }
    
    public function keywordData(Request $request){
        //validating url
        /*$this->validate($request, [
            'keyword'   => 'required|alpha',
        ]);*/
        
        //store searched keyword in table searched_keywords
        $store = new SearchedKeyword;
        $store->user_id = Auth::user()->id;
        $store->keyword = $request->keyword;
        $store->searched_at = Carbon::now();
        $store->save();
        
        $results = SEOstats\Google::getSerps($request->keyword);
        return $results;
    }
    
    public function history(){
        $urls = SearchedUrl::latest('searched_at')->where('user_id', Auth::user()->id)->get();
        $keywords = SearchedKeyword::latest('searched_at')->where('user_id', Auth::user()->id)->get();
        return view('pages.history', compact('urls', 'keywords'));
    }
}
