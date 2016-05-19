@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">Pregled prijave</div>

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
                        <p class="col-md-12">
                            <span class="pregled">spol:</span> {{ $osebniPodatki->spol == 5 ? 'Ženski' : 'Moški' }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Država rojstva: </span>{{ $osebniPodatki->drzavaRojstva->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Kraj rojstva: </span>{{ $osebniPodatki->kraj_rojstva }}
                        </p>
                        <p class="col-md-12">
                            <span  class="pregled">Državljanstvo: </span>{{ $osebniPodatki->drzavljanstvo->ime }}
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Stalno prebivališče</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Država:</span> {{ $stalnoPrebivalisce->drzava->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Naslov:</span> {{ $stalnoPrebivalisce->naslov }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Pošta:</span> {{ $stalnoPrebivalisce->posta->postna_stevilka . ' - ' . $stalnoPrebivalisce->posta->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Občina:</span> {{ $stalnoPrebivalisce->obcina->ime }}
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Naslov za pošiljanje</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Država:</span> {{ $naslovZaPosiljanje->drzava->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Naslov:</span> {{ $naslovZaPosiljanje->naslov }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Pošta:</span> {{ $naslovZaPosiljanje->posta->postna_stevilka . ' - ' . $naslovZaPosiljanje->posta->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Občina:</span> {{ $naslovZaPosiljanje->obcina->ime }}
                        </p>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Srednješolska izobrazba</div>
                    <div class="panel-body">
                        <p class="col-md-12">
                            <span class="pregled">Spričevalo o končani srednji šoli že imam:</span> {{ $srednjesolskaIzobrazba->ima_spricevalo ? 'Da' : 'Ne' }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Način zaključka srednje šole:</span> {{ $srednjesolskaIzobrazba->nacinZakljucka->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Država srednje šole:</span> {{ $srednjesolskaIzobrazba->drzava->ime }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Ime srednje šole:</span> {{ $srednjesolskaIzobrazba->drzava->ime == 'SLOVENIJA' ? $srednjesolskaIzobrazba->srednjaSola->ime : $srednjesolskaIzobrazba->ime_srednje_sole }}
                        </p>
                        <p class="col-md-12">
                            <span class="pregled">Datum izdaje spričevala:</span> {{ date('d.m.Y', strtotime($srednjesolskaIzobrazba->datum_izdaje_spricevala)) }}
                        </p>
                        @if($srednjesolskaIzobrazba->sifra_maturitetnega_predmeta > 0 )
                            <p class="col-md-12">
                                <span class="pregled">Maturitetni predmet</span> {{ $srednjesolskaIzobrazba->maturitetniPredmet->ime }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Izbrani študijski programi</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr><th>Želja</th><th>Zavod</th><th>Program</th><th>Način</th></tr>
                            @foreach($prijave as $prijava)
                                <tr>
                                    <td>{{ $prijava->zelja }}.</td>
                                    <td>{{ $prijava->studijskiProgram->visokosolskiZavod->ime }}</td>
                                    <td>{{ $prijava->studijskiProgram->ime }}</td>
                                    <td>{{ $prijava->studijskiProgram->nacin_studija }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                    @if($admin && !empty($datum_oddaje_prijave))

                    <form method="post" class="form-horizontal" action="{{ url('vpis/'. $id .'/oddaja_prijave') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" name="shraniPogoj" class="btn btn-danger pull-right">
                                    <i class="fa fa-btn fa-sign-in"></i>Izbriši prijavo
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <a href="{{ url('vpis/'. $id .'/prijava_za_studij') }}" class="btn btn-danger pull-left">
                                    <i class="fa fa-btn fa-sign-in"></i>Nazaj
                                </a>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{{ url('vpis/'. $id .'/tisk_prijave') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Natisni prijavo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    @elseif(empty($datum_oddaje_prijave))
                        <form method="post" class="form-horizontal" action="{{ url('vpis/'. $id .'/oddaja_prijave') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{{ url('vpis/'. $id .'/prijava_za_studij') }}" class="btn btn-danger pull-left">
                                        <i class="fa fa-btn fa-sign-in"></i>Nazaj
                                    </a>
                                    <button type="submit" name="shraniPogoj" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Potrdi prijavo
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <form method="post" class="form-horizontal" action="{{ url('vpis/'. $id .'/izbris_prijave') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" name="shraniPogoj" class="btn btn-danger pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Izbriši prijavo
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{{ url('vpis/'. $id .'/tisk_prijave') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Natisni prijavo
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endif
            </div>
        </div>
    </div>
@endsection