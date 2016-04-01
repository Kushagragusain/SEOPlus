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
        
        Route::get('loadForm', function(){
            return view('pages.loadForm');
        });

        //to see all previous searches
        Route::get('history', 'SEOController@history');
        
    });
    
    Route::post('search/url', 'SEOController@domainData');
    
    Route::post('search/keyword', 'SEOController@keywordData');
});

Route::get('demo', function(){
            return view('pages.demo');
        });
Route::post('demoo', 'SEOController@demo');
