<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    
    Route::get('/',[
        'middleware' => 'guest', function(){
            return view('pages.index');        
    }]);
    
    Route::group(['middleware' => 'auth'], function () {
        //redirect to dashboard to loged in user
        Route::get('dashboard', function(){
            return view('pages.dashboard');        
        });
        
        /*Route::get('demo', function(){
            return view('pages.dmeo');
        });*/

       //to see all previous searches
        Route::get('history', 'SEOController@history');
        
        Route::get('updatedb', 'SEOController@updateSearchedKeyworddb');

        Route::get('url_rank/history', 'SEOController@graph');

        Route::get('history/{id}', 'SEOController@historydata');

        Route::get('url_rank/{id}', array('as' => 'showUrlData', 'uses' => 'SEOController@fetchUrlData'));


        //Route::get('foo/{id}', 'KeywordController@foo');

        //add keyword(s) in db
        Route::post('addkey', 'KeyAddController@addkeyword');

        //get keyword(s) rank
        Route::get('getrank', 'KeyAddController@getRank');

        //get stored keyword on page load
        Route::get('fetchkey', 'KeyAddController@fetchkeywords');

        //delete keyword
        Route::get('delete', 'KeyAddController@deleteKeyword');

        //keyword rank page
        Route::get('url_rank/keyword/{id}', 'KeyAddController@find');

        Route::get('refresh', 'KeyAddController@refresh');

        //get average ranking
        Route::get('avgrank', 'KeyAddController@avgRank');


         //TEst Controller
         Route::get('fetchkey1/{id}', 'SEOOController@fetchkeywords');
         Route::get('foo', function() {
             $key = "air conditioning calgary";
             $datacheck = \App\Storekeyurl::where('keywordname', $key)->get();
           // var_dump($datacheck); die();
            if( count($datacheck) > 0 ) {
                return "p";
            }
              //  \App\Storekeyurl::where('keywordname', $key)->update(['urls'=> $urldata]);
            else{
                return "j";
                $store = new Storekeyurl;
                $store->keywordname = $key;
                $store->urls = $urldata;
                $store->latestcheck = Carbon::now();
                $store->save();
            }

         });

    });

    Route::post('search/url', 'SEOController@domainSave');
    
    Route::post('keyword', 'SEOController@keywordData');
});

