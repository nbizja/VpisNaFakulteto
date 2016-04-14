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


Route::group(['middleware' => ['prijavljen']], function () {
    Route::post('prijava', 'Auth\AuthController@login');
});

Route::get('registracija', 'Auth\RegisterController@showRegister');
Route::post('registracija', 'Auth\RegisterController@register');
Route::get('registracija/{zeton?}', 'Auth\RegisterController@showActivation');

//Uporabnik mora biti prijavljen za dosto do teh strani
Route::group(['middleware' => ['prijavljen']], function () {

    Route::get('studijskiProgrami/urejanje', 'StudijskiProgrami\StudijskiProgramiController@urediPrograme');
    Route::post('studijskiProgrami/shrani', 'StudijskiProgrami\StudijskiProgramiController@shraniPrograme');
    Route::get('studijskiProgrami/nov', 'StudijskiProgrami\StudijskiProgramiController@novProgram');
    Route::post('studijskiProgrami/dodaj', 'StudijskiProgrami\StudijskiProgramiController@dodajProgram');
    Route::get('studijskiProgrami/seznam', 'StudijskiProgrami\StudijskiProgramiController@seznamProgramov');

    Route::get('prijava', 'Auth\AuthController@showLoginForm');
    Route::get('odjava', 'Auth\AuthController@logout');

    Route::get('/', 'HomeController@index');

    Route::get('/geslo', 'ProfilController@index');
    Route::post('/geslo/ponastavi', 'ProfilController@ponastaviGeslo');

    Route::get('kreiranjeRacuna/zaposleni', 'AddEmployeeController@loadPage');
    Route::post('kreiranjeRacuna/zaposleni', 'AddEmployeeController@validateInput');

    Route::get('/sifranti', 'SifrantiController@index');
    Route::get('/sifranti/{ime_sifranta}', 'SifrantiController@prikazi');
    Route::any('/sifranti/{ime_sifranta}/edit', 'SifrantiController@uredi');
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

