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

        //Route::get('demo', 'KeyAddController@demo');

       //to see all previous searches
        Route::get('history', 'SEOController@history');
        
        Route::get('updatedb', 'SEOController@updateSearchedKeyworddb');

        Route::get('url_rank/history', 'SEOController@graph');

        Route::get('history/{id}', 'SEOController@historydata');

        Route::get('url_rank/{id}', array('as' => 'showUrlData', 'uses' => 'SEOController@fetchUrlData'));

        Route::get('url_rank/keyword/{id}', 'KeywordController@find');




        //Route::get('demo', 'SEOController@demo');

        Route::get('foo/{id}', 'KeywordController@foo');

        Route::post('addkey', 'KeyAddController@addkeyword');

        Route::get('fetchkey', 'KeyAddController@fetchkeywords');

        Route::get('delete', 'KeyAddController@deleteKeyword');



         //TEst Controller
         Route::get('fetchkey1/{id}', 'SEOOController@fetchkeywords');

    });

    Route::post('search/url', 'SEOController@domainSave');
    
    Route::post('keyword', 'SEOController@keywordData');
});
