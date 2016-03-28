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

    // Authentication Routes...
    Route::get('prijava', 'Auth\AuthController@showLoginForm');
    Route::post('prijava', 'Auth\AuthController@login');
    Route::get('odjava', 'Auth\AuthController@logout');

// Registration Routes...
    Route::get('registracija', 'Auth\AuthController@showRegistrationForm');
    Route::post('registracija', 'Auth\AuthController@register');

// Password Reset Routes...
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

