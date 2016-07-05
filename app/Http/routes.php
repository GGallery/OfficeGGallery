<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::group(array('before' => 'auth'), function() {


    Route::get('/', function() {
        return View::make('home');
    });
    Route::get('home', function() {
        return View::make('home');
    });
    


    Route::get('/charts', function() {
        return View::make('mcharts');
    });

    Route::get('/tables', function() {
        return View::make('table');
    });

    Route::get('/forms', function() {
        return View::make('form');
    });

    Route::get('/grid', function() {
        return View::make('grid');
    });

    Route::get('/buttons', function() {
        return View::make('buttons');
    });


    Route::get('/icons', function() {
        return View::make('icons');
    });

    Route::get('/panels', function() {
        return View::make('panel');
    });

    Route::get('/typography', function() {
        return View::make('typography');
    });

    Route::get('/notifications', function() {
        return View::make('notifications');
    });

    Route::get('/blank', function() {
        return View::make('blank');
    });

    Route::get('/login', function() {
        return View::make('login');
    });

    Route::get('/documentation', function() {
        return View::make('documentation');
    });


    Route::resource('dipendenti', 'dipendentiController');
    Route::resource('commesse', 'commesseController');
    Route::resource('calendario', 'calendarioController');

    Route::get('calendario.calendar', function() {
        return View::make('calendario.calendar');
    });
    

    //AUTOCOMPLETE 
    Route::get('autocomplete/commesse', 'autocompleteController@Commesse');
    Route::get('autocomplete', function() {
        return View::make('autocomplete');
    });
});


Route::filter('auth', function() {
    if (Auth::guest())
        return Redirect::to('login');
});


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');



Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

