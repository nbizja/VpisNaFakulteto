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


Route::group(['middleware' => ['web']], function () {
    Route::post('prijava', 'Auth\AuthController@login');
    Route::get('prijava', 'Auth\AuthController@showLoginForm');

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
    Route::post('studijskiProgrami/izpis/izvoz', 'StudijskiProgrami\StudijskiProgramiController@izvozPodatkov');

    Route::get('vpisniPogoji/urejanje', 'StudijskiProgrami\VpisniPogojiController@urediPogoje');
    Route::post('vpisniPogoji/urediPogoj', 'StudijskiProgrami\VpisniPogojiController@urediPogoj');
    Route::post('vpisniPogoji/urediDelez', 'StudijskiProgrami\VpisniPogojiController@urediPogoj');
    Route::post('vpisniPogoji/shraniPogoj', 'StudijskiProgrami\VpisniPogojiController@shraniPogoj');
    Route::get('vpisniPogoji/dodajPogoj', 'StudijskiProgrami\VpisniPogojiController@dodajPogoj');
    Route::post('vpisniPogoji/novPogoj', 'StudijskiProgrami\VpisniPogojiController@novPogoj');
    Route::post('/vpisniPogoji/shraniDeleze', 'StudijskiProgrami\VpisniPogojiController@shraniDeleze');
    Route::get('/vpisniPogoji/shraniDeleze', 'StudijskiProgrami\VpisniPogojiController@shraniDeleze');

    Route::get('/ustrezanjePogojem/{id_kandidata}', 'UspehKandidatovController@preveriPogoje');

    Route::get('iskanje', 'ListOfCandidatesController@loadCandidates');
    Route::post('iskanje', 'ListOfCandidatesController@findCandidates');

    Route::get('urejanjePodatkovoUspehu', 'ListOfCandidatesController@urediPodatke');


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

    Route::get('vpis/{id}/osebni_podatki',           'VpisController@osebniPodatki');
    Route::post('vpis/{id}/osebni_podatki',          'VpisController@shraniOsebnePodatke');
    Route::get('vpis/{id}/stalno_prebivalisce',      'VpisController@stalnoPrebivalisce');
    Route::post('vpis/{id}/stalno_prebivalisce',     'VpisController@shraniStalnoPrebivalisce');
    Route::get('vpis/{id}/srednjesolska_izobrazba',  'VpisController@srednjeSolskaIzobrazbaPrikaz');
    Route::post('vpis/{id}/srednjesolska_izobrazba', 'VpisController@shraniSrednjeSolskoIzobrazbo');
    Route::get('vpis/{id}/prijava_za_studij',        'VpisController@prijavaZaStudijPrikaz');
    Route::post('vpis/{id}/prijava_za_studij',       'VpisController@shraniPrijavoZaStudij');
    Route::get('vpis/{id}/pregled',                  'VpisController@pregled');
    Route::post('vpis/{id}/izbris_prijave',          'VpisController@izbrisPrijave');
    Route::post('vpis/{id}/oddaja_prijave',          'VpisController@oddajaPrijave');
    Route::get('vpis/{id}/tisk_prijave',             'VpisController@tiskPrijave');
    
    Route::get('/matura/uvozPodatkov', 'Matura\MaturaController@uvoziPodatke');
    Route::post('/matura/naloziDatoteko', 'Matura\MaturaController@naloziDatoteko');
	
    Route::get('/poklicnaMatura/uvozPodatkov', 'Matura\PoklicnaMaturaController@uvoziPodatke');
    Route::post('/poklicnaMatura/naloziDatoteko', 'Matura\PoklicnaMaturaController@naloziDatoteko');

});

Route::get('/seznamKandidatov/{zavod_id?}', function($zavod_id){
    $zavodi =  \App\Models\VisokosolskiZavod::orderBy('ime')->pluck('id');
    if($zavod_id > 0) {
        $zavod_id = $zavodi[$zavod_id - 1];
        $programi = \App\Models\StudijskiProgram::where('id_zavoda', '=', $zavod_id)->orderBy('ime')->pluck('ime');
        $programi_nacin = \App\Models\StudijskiProgram::where('id_zavoda', '=', $zavod_id)->orderBy('ime')->pluck('nacin_studija');
        for ($i = 0; $i < count($programi); $i++) {
            $programi[$i] = $programi[$i] .  ", " . strtoupper($programi_nacin[$i]);
        }
        return Response::json($programi);
    }
    else return Response::json();
});

Route::get('seznamKandidatov/pdf', 'ListOfCandidatesController@exportPdf');