<?php
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

    Route::get('/',['middleware' => 'guest', function(){
        return view('pages.index');
    }]);

    /*Route::get('errorVerify', ['middleware' => 'auth', function(){
        return view('pages.verificationError');
    }]);*/

    /*Route::get('payerror', function(){
        return view('pages.paymentError');
    });*/

    Route::get('new',function(){
        return view('pages.payment');
    });

    Route::get('payerror',function(){
        return view('pages.paymentError');
    });

    Route::group(['middleware' => 'auth'], function () {

        //redirect to dashboard to loged in user
        Route::get('dashboard', function(){
            return view('pages.dashboard');
        });

        Route::group(['middleware' => 'payauthenticate'], function () {

            Route::post('search/url', 'SEOController@domainSave');

            //add keyword(s) in db
            Route::post('addkey', 'KeyAddController@addkeyword');

        });

        //add keyword(s) in db
        Route::post('addkey', 'KeyAddController@addkeyword');


       //to see all previous searches
        Route::get('history', 'SEOController@history');
        
        Route::get('updatedb', 'SEOController@updateSearchedKeyworddb');

        Route::get('url_rank/history', 'SEOController@graph');

        Route::get('history/{id}', 'SEOController@historydata');

        Route::get('url_rank/{id}', array('as' => 'showUrlData', 'uses' => 'SEOController@fetchUrlData'));


        //Route::get('foo/{id}', 'KeywordController@foo');

        //get keyword(s) rank
        Route::get('getrank', 'KeyAddController@getRank');

        //get stored keyword on page load
        Route::get('fetchkey', 'KeyAddController@fetchkeywords');

        //delete keyword
        Route::get('delete', 'KeyAddController@deleteKeyword');

        //keyword rank page
        Route::get('url_rank/keyword/{id}', 'KeyAddController@find');

        Route::get('refresh', 'KeyAddController@refresh');

        Route::get('newtaskid', 'KeyAddController@newtaskid');

        //get average ranking
        Route::get('avgrank', 'KeyAddController@avgRank');

        // Route::get('demo', 'SEOController@domainSave');

        //Route::get('errorVerify', 'EmailController@sendEmailReminder');

        Route::get('cancel','Paycontroller@cancel');

        Route::get('editkey','KeyAddController@edit');


        Route::get('editkeyrank','KeyAddController@editrank');

        Route::get('deleteurl/{url}', 'SEOController@deleteurl');

        Route::get('saveFeedback', 'FeedbackController@saveFeedback');

        Route::get('seo/showfeedback', 'FeedbackController@show');
    });

    Route::post('new','Paycontroller@check');
    
    Route::post('keyword', 'SEOController@keywordData');
});
