<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 13.4.2016
 * Time: 17:42
 */ ?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Dodajanje študijskega programa</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/studijskiProgrami/dodaj') }}">
            <div class="panel-group">
                {!! csrf_field() !!}

                @if (isset($failure))
                    <div class="alert alert-danger">
                        @foreach (array_unique($failure) as $e)
                            {{ $e }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Študijski program</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fakulteta: </label>
                            <div class="col-md-6">
                                <select class="form-control" name="fakulteta" id="vzdrzevanjeProgramov_fakultete">
                                    @foreach($fakultete as $fakulteta)
                                        <option value="{{$fakulteta->id}}">{{$fakulteta->ime}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program: </label>
                            <div class="col-md-6">
                                <input type="text" id="ime_programa" class="form-control" name="naziv">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Šifra: </label>
                            <div class="col-md-6">
                                <input type="text" id="sifra_programa" class="form-control" name="sifra">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Informacije o vpisu</div>
                    <div class="panel-body">
                        <p>* : podatki za Slovence in pripadnike EU</p>
                        <p>** : podatki za tujce in Slovence brez slovenskega državljanstva</p>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest*: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest**: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_vpisnih_mest_tujci" class="form-control" name="stevilo_mest_tujci">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Omejitev vpisa*: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="omejitev" name="omejitev">
                                    <option value="da">Da</option>
                                    <option value="ne">Ne</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Omejitev vpisa**: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="omejitev_tujci" name="omejitev_tujci">
                                    <option value="da">Da</option>
                                    <option value="ne">Ne</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število mest po omejitvi vpisa*: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_mest_omejitev" class="form-control" name="stevilo_mest_omejitev">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Število mest po omejitvi vpisa**: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_mest_omejitev_tujci" class="form-control" name="stevilo_mest_omejitev_tujci">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število sprejetih kandidatov*: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_sprejetih" class="form-control" name="stevilo_sprejetih">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število sprejetih kandidatov**: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_sprejetih_tujci" class="form-control" name="stevilo_sprejetih_tujci">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Splošne informacije</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Način študija: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="nacin_studija"  name="nacin_studija">
                                        <option value="redni">Redni</option>
                                        <option value="izredni">Izredni</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Vrsta študija: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="vrsta_studija" name="vrsta_studija">
                                    <option value="un">Univerzitetni</option>
                                    <option value="vs">Visokošolski strokovni</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" name="shrani" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-sign-in"></i>Shrani
                    </button>
                </div>
            </div>

            @include('flash_message')
        </form>
    </div>
@endsection

