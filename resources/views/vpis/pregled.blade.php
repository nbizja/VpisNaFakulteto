@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">V skladu z razpisom za vpis se prijavljam za študij</div>

                <div class="panel panel-default">
                    <div class="panel-heading">Osebni podatki</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Emšo:</span> {{ $osebniPodatki->emso }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Ime:</span> {{ $osebniPodatki->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Priimek:</span> {{ $osebniPodatki->priimek }}
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Stalno prebivališče</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Država:</span> {{ $stalnoPrebivalisce->drzava()->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Naslov:</span> {{ $stalnoPrebivalisce->naslov }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Pošta:</span> {{ $stalnoPrebivalisce->posta()->postna_stevilka . ' - ' . $stalnoPrebivalisce->posta()->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Obcina:</span> {{ $stalnoPrebivalisce->obcina()->ime }}
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Naslov za pošiljanje</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Država:</span> {{ $naslovZaPosiljanje->drzava()->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Naslov:</span> {{ $naslovZaPosiljanje->naslov }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Pošta:</span> {{ $naslovZaPosiljanje->posta()->postna_stevilka . ' - ' . $naslovZaPosiljanje->posta()->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Obcina:</span> {{ $naslovZaPosiljanje->obcina()->ime }}
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Srednješolska izobrazba</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Spričevalo o končani srednji šoli že imam::</span> {{ $srednjesolskaIzobrazba->ima_spricevalo ? 'Da' : 'Ne' }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Način zakljuka srednje šole:</span> {{ $srednjesolskaIzobrazba->nacinKoncanjaSrednjeSole()->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Država srednje šole:</span> {{ $srednjesolskaIzobrazba->drzava()->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Ime srednje šole:</span> {{ $srednjesolskaIzobrazba->drzava()->ime == 'SLOVENIJA' ? $srednjesolskaIzobrazba->srednjaSola()->ime : $srednjesolskaIzobrazba->ime_srednje_sole }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Datum izdaje spričevala:</span> {{ date('d.m.Y', strtotime($srednjesolskaIzobrazba->datum_izdaje_spricevala)) }}
                        </p>
                        @if($srednjesolskaIzobrazba->id_maturitetnega_predmeta > 0 )
                            <p class="col-md-12">
                                <span class="pregled">Maturitetni predmet</span> {{ $srednjesolskaIzobrazba->maturitetniPredmet()->ime }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Izbrani študijski programi</div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection