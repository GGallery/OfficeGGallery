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

Route::group(array('middleware' => 'auth'), function() {


    Route::get('/', function() {
        $today = \Carbon\Carbon::today();
        $tomorrow = \Carbon\Carbon::tomorrow();

        $data['assenze'] = \App\calendario::where('type', '>' , 0)
            ->where('giorno' ,'>',$today)
            ->where('giorno' ,'<',$tomorrow)
            ->where('approvato' , 1)
            ->orderBy('giorno' ,'asc')
            ->get();

        $data['assenze_domani'] = \App\calendario::where('type', '>' , 0)
            ->where('giorno' ,'>',$tomorrow)
            ->where('approvato' , 1)
            ->orderBy('giorno' ,'asc')
            ->get();

        $data['ultime_commesse'] = \App\commesse::take(10)->orderBy('created_at', 'desc')->get();

        return View::make('home')->with($data);
    });

    Route::get('home', function() {

        $today = \Carbon\Carbon::today();
        $tomorrow = \Carbon\Carbon::tomorrow();

        $data['assenze'] = \App\calendario::where('type', '>' , 0)
            ->where('giorno' ,'>',$today)
            ->where('giorno' ,'<',$tomorrow)
            ->where('approvato' , 1)
            ->orderBy('giorno' ,'asc')
            ->get();

        $data['assenze_domani'] = \App\calendario::where('type', '>' , 0)
            ->where('giorno' ,'>',$tomorrow)
            ->where('approvato' , 1)
            ->orderBy('giorno' ,'asc')
            ->get();

        $data['ultime_commesse'] = \App\commesse::take(10)->orderBy('created_at', 'desc')->get();

        return View::make('home')->with($data);
    });


    Route::resource('users', 'usersController');
    Route::resource('clienti', 'clientiController');
    Route::resource('commesse', 'commesseController');
    Route::get('userPerCommessa', 'commesseController@userPerCommessa');




    Route::resource('calendario', 'calendarioController');
    Route::resource('calendario.destroy', 'calendarioController@destroy');


    Route::resource('calendar', 'calendarioController@calendar'); //in disuso


    Route::resource('feriepermessi', 'calendarioController@feriepermessi');
    Route::resource('approvazione', 'calendarioController@approvazione');
    Route::resource('rilevazione', 'calendarioController@rilevazione');
    Route::resource('do_rileva', 'calendarioController@do_rileva');

    Route::resource('google', 'googleController');


    Route::resource('controllocf', 'utilityController@controllocf');
    Route::resource('coupon', 'utilityController@coupon');

//    Route::get('/coupon', function() {
//        return View::make('coupon/ausind');
//    });


    //AUTOCOMPLETE
    Route::get('autocomplete/commesse', 'ajaxRequestController@Commesse');







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




});


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

//    A  P  I


Route::group(['middleware' => ['cors' ], 'prefix' => 'api'], function () {

    Route::post('register', 'APIController@register');

    Route::get('login', 'APIController@login');

    Route::group(['middleware' => 'jwt-auth'], function () {

        Route::get('get_user_details', 'APIController@get_user_details');
        Route::get('assenti', 'APIController@getAssenti');
        Route::get('commesse_mie', 'APIController@commesse_mie');
        Route::get('commesse_all', 'APIController@commesse_all');
        Route::post('commessa_store', 'APIController@commessa_store');

    });
});
