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

//Throttle middleware za 5 min zaklene sistem po 3 neuspešnih poizkusih
Route::group(['middleware' => ['prijavljen', 'throttle:3,5']], function () {
    Route::post('prijava', 'Auth\AuthController@login');
});

//Uporabnik mora biti prijavljen za dosto do teh strani
Route::group(['middleware' => ['prijavljen']], function () {

    Route::get('prijava', 'Auth\AuthController@showLoginForm');
    Route::get('odjava', 'Auth\AuthController@logout');

    Route::get('registracija', 'Auth\AuthController@showRegistrationForm');
    Route::post('registracija', 'Auth\AuthController@register');

    Route::get('geslo/ponastavi/{zeton?}', 'Auth\PasswordController@showResetForm');
    Route::post('geslo/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('geslo/ponastavi', 'Auth\PasswordController@reset');

    Route::get('/', 'HomeController@index');

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

