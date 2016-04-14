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

Route::get('/helper', function () {
    return view('helper');
});


//Throttle middleware za 2 min zaklene sistem po 3 neuspešnih poizkusih
Route::group(['middleware' => ['prijavljen', 'throttle:3,2']], function () {
    Route::post('prijava', 'Auth\AuthController@login');
});


Route::get('registracija', 'Auth\RegisterController@showRegister');
Route::post('registracija', 'Auth\RegisterController@register');

Route::get('registracija/{zeton?}', 'Auth\RegisterController@showActivation');

//Uporabnik mora biti prijavljen za dosto do teh strani
Route::group(['middleware' => ['prijavljen']], function () {

    Route::get('prijava', 'Auth\AuthController@showLoginForm');
    Route::get('odjava', 'Auth\AuthController@logout');


    Route::get('/', 'HomeController@index');

    Route::get('/geslo', 'ProfilController@index');
    Route::post('/geslo/ponastavi', 'ProfilController@ponastaviGeslo');

    Route::get('kreiranjeRacuna/zaposleni', 'AddEmployeeController@loadPage');
    Route::post('kreiranjeRacuna/zaposleni', 'AddEmployeeController@validateInput');

    Route::get('seznamKandidatov', 'ListOfCandidatesController@loadPage');
    Route::post('seznamKandidatov', 'ListOfCandidatesController@getList');

    Route::get('api/dropdown', function(){
        $id = Input::get('option');
        $zavod = \App\VisokosolskiZavod::find($id);
        return $zavod->pluck('ime');
    });

});

Route::get('/seznamKandidatov/{zavod_id?}', function($zavod_id){
    $zavodi =  \App\VisokosolskiZavod::orderBy('ime')->pluck('id');
    if($zavod_id > 0) {
        $zavod_id = $zavodi[$zavod_id - 1];
        $programi = \App\StudijskiProgram::where('id_zavoda', '=', $zavod_id)->orderBy('ime')->pluck('ime');
        return Response::json($programi);
    }
    else return Response::json();

});







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

