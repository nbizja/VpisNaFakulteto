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

Route::group(['middleware' => ['web']], function () {
    Route::get('registracija', 'Auth\RegisterController@showRegister');
    Route::post('registracija', 'Auth\RegisterController@register');
    Route::get('registracija/{zeton?}', 'Auth\RegisterController@showActivation');
});



//Uporabnik mora biti prijavljen za dosto do teh strani
Route::group(['middleware' => ['prijavljen']], function () {

    Route::get('studijskiProgrami/urejanje', 'StudijskiProgrami\StudijskiProgramiController@urediPrograme');
    Route::post('studijskiProgrami/shrani', 'StudijskiProgrami\StudijskiProgramiController@shraniPrograme');
    Route::get('studijskiProgrami/nov', 'StudijskiProgrami\StudijskiProgramiController@novProgram');
    Route::post('studijskiProgrami/dodaj', 'StudijskiProgrami\StudijskiProgramiController@dodajProgram');

    Route::get('studijskiProgrami/seznam', 'StudijskiProgrami\SeznamController@seznamProgramov');
    Route::post('studijskiProgrami/seznam/izvoz', 'StudijskiProgrami\SeznamController@izvozi');

    Route::get('studijskiProgrami/izpis', 'StudijskiProgrami\StudijskiProgramiController@izpisPodatkov');

    Route::get('vpisniPogoji/urejanje', 'StudijskiProgrami\VpisniPogojiController@urediPogoje');
    Route::post('vpisniPogoji/shrani', 'StudijskiProgrami\VpisniPogojiController@shraniPogoje');

    Route::get('prijava', 'Auth\AuthController@showLoginForm');
    Route::get('odjava', 'Auth\AuthController@logout');

    Route::get('/', 'HomeController@index');

    Route::get('/geslo', 'ProfilController@index');
    Route::post('/geslo/ponastavi', 'ProfilController@ponastaviGeslo');
    Route::get('/pozabljeno_geslo', 'ProfilController@pozabljenoGeslo');
    Route::post('/pozabljeno_geslo', 'ProfilController@posljiGeslo');
    Route::get('/pozabljeno_geslo/{zeton}', 'ProfilController@potrditevMenjave');

    Route::get('kreiranjeRacuna/zaposleni', 'AddEmployeeController@loadPage');
    Route::post('kreiranjeRacuna/zaposleni', 'AddEmployeeController@validateInput');

    Route::get('seznamKandidatov', 'ListOfCandidatesController@loadPage');
    Route::post('seznamKandidatov', 'ListOfCandidatesController@getList');

    Route::get('api/dropdown', function(){
        $id = Input::get('option');
        $zavod = \App\VisokosolskiZavod::find($id);
        return $zavod->pluck('ime');
    });

    Route::get('/sifranti', 'SifrantiController@index');
    Route::get('/sifranti/{ime_sifranta}', 'SifrantiController@prikazi');
    Route::any('/sifranti/{ime_sifranta}/edit', 'SifrantiController@uredi');

    Route::any('/sifranti/{ime_sifranta}/razveljavi/{id_vnosa}', 'SifrantiController@razveljavi');
    Route::any('/sifranti/{ime_sifranta}/povrni/{id_vnosa}', 'SifrantiController@povrni');

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

