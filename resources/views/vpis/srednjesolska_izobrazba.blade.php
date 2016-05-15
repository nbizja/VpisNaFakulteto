@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Srednješolska izobrazba</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis/srednjesolska_izobrazba') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Spričevalo o končani srednji šoli že imam: </label>
                                <div class="input-group">
                                    <input type="radio" name="kandidat_ima_spricevalo" checked value="0"/>Ne

                                    <input type="radio" name="kandidat_ima_spricevalo" value="1"/>Da
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Način zakljuka srednje šole: </label>
                                <div class="col-md-6">
                                    <select name="nacin_zakljucka" class="form-control">
                                        @foreach($naciniZakljucka as $nacinZakljucka)
                                            <option value="{{ $nacinZakljucka->id }}">{{ $nacinZakljucka->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Država srednje šole: </label>
                                <div class="col-md-6">
                                    <select name="drzava_srednje_sole" class="form-control">
                                        @foreach($drzave as $drzava)
                                            <option value="{{ $drzava->id }}" @if($drzava->ime == 'SLOVENIJA'){{ 'selected' }}@endif>
                                                {{ $drzava->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="srednja_sola_slo" style="display: none;">
                                <label class="col-md-4 control-label">Ime srednje šole: </label>
                                <div class="col-md-6">
                                    <input type="text" name="srednja_sola_tujina" />
                                </div>
                            </div>
                            <div class="form-group" id="srednja_sola_slo">
                                <label class="col-md-4 control-label">Srednja šola: </label>
                                <div class="col-md-6">
                                    <select name="srednja_sola" class="form-control">
                                        @foreach($srednjeSole as $srednjaSols)
                                            <option value="{{ $srednjaSols->id }}">{{ $srednjaSols->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Datum izdaje spričevala: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="datum_izdaje_spricevala" placeholder="dd.mm.yyyy" />
                                </div>
                            </div>

                            <div class="form-group" id="maturitetni_predmet" style="display: none;">
                                <label class="col-md-4 control-label">Maturitetni predmet: </label>
                                <div class="col-md-6">
                                    <select class="form-control" name="maturitetni_predmet">
                                        <option value="0">Brez maturitetnega predmeta</option>

                                        @foreach($splosniPredmeti as $splosniPredmet)
                                            <option value="{{ $splosniPredmet->id }}">{{ $splosniPredmet->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <input type="submit" class="form-control btn-primary" value="Naslednji korak">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection