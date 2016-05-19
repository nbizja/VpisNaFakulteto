@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Srednješolska izobrazba</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis/'. $id .'/srednjesolska_izobrazba') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-3 control-label">Spričevalo o končani srednji šoli že imam: </label>
                                <div class="input-group col-md-9 col-md-offset-3">
                                    <input type="radio" name="kandidat_ima_spricevalo" @if(!($srednjesolskaIzobrazba->ima_spricevalo ?? false)){{ 'checked' }}@endif value="0"/> Ne

                                    <input type="radio" name="kandidat_ima_spricevalo" @if($srednjesolskaIzobrazba->ima_spricevalo ?? false){{ 'checked' }}@endif value="1" style="margin-left: 20px;;"/> Da
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Način zaključka srednje šole: </label>
                                <div class="col-md-9">
                                    <select id="nacin_zakljucka" name="nacin_zakljucka" class="form-control">
                                        @foreach($naciniZakljucka as $nacinZakljucka)
                                            <option value="{{ $nacinZakljucka->id }}" @if(($srednjesolskaIzobrazba->id_nacina_zakljucka ?? -1) == $nacinZakljucka->id){{ 'selected' }}@endif>
                                                {{ $nacinZakljucka->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Država srednje šole: </label>
                                <div class="col-md-9">
                                    <select name="drzava_srednje_sole" id="drzava_srednje_sole" class="form-control">
                                        @foreach($drzave as $drzava)
                                            <option value="{{ $drzava->id }}" @if(($srednjesolskaIzobrazba->id_drzave ?? 705) == $drzava->id){{ 'selected' }}@endif>
                                                {{ $drzava->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="srednja_sola_tujina" @if((isset($srednjesolskaIzobrazba) && $srednjesolskaIzobrazba->id_drzave == 705) || !isset($srednjesolskaIzobrazba)) {!! 'style="display: none;"' !!} @endif>
                                <label class="col-md-3 control-label">Ime srednje šole: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="srednja_sola_tujina" placeholder="Ime srednje šole v tujini" value="{{ $srednjesolskaIzobrazba->ime_srednje_sole ?? '' }}" />
                                </div>
                            </div>
                            <div class="form-group" id="srednja_sola_slo" @if((isset($srednjesolskaIzobrazba->id_drzave) && $srednjesolskaIzobrazba->id_drzave != 705)) {!! 'style="display: none;"' !!} @endif>
                                <label class="col-md-3 control-label">Srednja šola: </label>
                                <div class="col-md-9">
                                    <select name="srednja_sola" class="form-control">
                                        @foreach($srednjeSole as $srednjaSols)
                                            <option value="{{ $srednjaSols->id }}" @if(($srednjesolskaIzobrazba->id_srednje_sole ?? 0) == $srednjaSols->id){{ 'selected' }}@endif>
                                                {{ $srednjaSols->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Datum izdaje spričevala: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="datum_izdaje_spricevala" placeholder="dd.mm.yyyy"
                                           value="@if($srednjesolskaIzobrazba->datum_izdaje_spricevala ?? false){{ date('d.m.Y', strtotime($srednjesolskaIzobrazba->datum_izdaje_spricevala)) }}@endif" />
                                </div>
                            </div>

                            <div class="form-group" id="maturitetni_predmet" @if(($srednjesolskaIzobrazba->nacinZakljucka->ime ?? '') != 'POKLICNA MATURA'){!! 'style="display: none;"' !!}@endif>
                                <label class="col-md-3 control-label">Maturitetni predmet: </label>
                                <div class="col-md-9">
                                    <select class="form-control" name="maturitetni_predmet">
                                        <option value="0" @if(!isset($srednjesolskaIzobrazba)){{ 'selected' }}@endif>Brez maturitetnega predmeta</option>

                                        @foreach($splosniPredmeti as $splosniPredmet)
                                            <option value="{{ $splosniPredmet->id }}" <?php if(($srednjesolskaIzobrazba->sifra_maturitetnega_predmeta ?? '0') == $splosniPredmet->id) echo 'selected';?>>
                                                {{ $splosniPredmet->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{{ url('vpis/'. $id .'/stalno_prebivalisce') }}" class="btn btn-danger pull-left">
                                        <i class="fa fa-btn fa-sign-in"></i>Nazaj
                                    </a>
                                    <button type="submit" name="shraniPogoj" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Potrdi prijavo
                                    </button>
                                </div>
                            </div>

                            @include('flash_message')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection