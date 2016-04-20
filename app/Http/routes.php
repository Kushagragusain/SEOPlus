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

    Route::get('/',['middleware' => 'guest', function(){
            return view('pages.index');        
    }]);
    
    Route::get('new', ['middleware' => 'auth', function(){
        //return view('pages.payment');
        if( Auth::user()->verified  == 1 )
            return view('pages.payment');
        else
            return view('pages.verificationError');
    }]);

    Route::get('errorVerify', ['middleware' => 'auth', function(){
        return view('pages.verificationError');
    }]);

    Route::group(['middleware' => ['auth','payauthenticate']], function () {
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



        Route::get('demo', 'SEOController@domainSave');



        //Route::get('checkpay','Paycontroller@check');emails/confirm/

    });

    //Route::get('emails/confirm/{email_token}','Paycontroller@confirmEmail');

    Route::post('new','Paycontroller@check');

    // Route::post('cancel','Paycontroller@cancel');

    Route::post('search/url', 'SEOController@domainSave');
    
    Route::post('keyword', 'SEOController@keywordData');

    //Route::get('foo','Paycontroller@foo');
});






