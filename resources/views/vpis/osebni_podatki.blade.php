@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Prijava za vpis</div>
                    <div class="panel-body">
                        <form class="form-horizontal pull-left" role="form" method="post" action="{{ url('vpis/osebni_podatki') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-3 control-label">Emšo: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="emso" placeholder="0101998500123" value="{{ $osebniPodatki->emso ?? old('emso') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Ime: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="ime" value="{{  $osebniPodatki->ime ?? old('ime') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Priimek: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="priimek" value="{{ $osebniPodatki->priimek ?? old('priimek') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Datum rojstva: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="datum_rojstva" placeholder="dd.mm.yyyy"
                                           value="@if($osebniPodatki->datum_rojstva ?? false){{ date('d.m.Y', strtotime($osebniPodatki->datum_rojstva)) }} @else {{ old('datum_rojstva') }}@endif" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Država rojstva: </label>
                                <div class="col-md-9">
                                    <select name="drzava_rojstva" class="form-control col-md-6" required>
                                        @foreach($drzave as $drzava)
                                            <option value="{{ $drzava->id }}" @if(($drzava->ime == 'SLOVENIJA' && empty($osebniPodatki)) ||
                                                (($osebniPodatki->id_drzave_rojstva ?? -1) == $drzava->id)) {{ 'selected' }} @endif>
                                                {{ $drzava->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Kraj rojstva: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="kraj_rojstva" value="{{ $osebniPodatki->kraj_rojstva ?? old('kraj_rojstva') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Državljanstvo: </label>
                                <div class="col-md-9">
                                    <select name="drzavljanstvo" class="form-control col-md-9">
                                        @foreach($drzavljanstva as $drzavljanstvo)
                                            <option value="{{ $drzavljanstvo->id }}"
                                                @if(!empty($osebniPodatki) && $osebniPodatki->id_drzavljanstva == $drzavljanstvo->id
                                                    || $drzavljanstvo->id == 2) {{ 'selected' }} @endif>
                                                {{ $drzavljanstvo->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Kontaktni telefon: </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="kontaktni_telefon" placeholder="030123456" value="{{ $osebniPodatki->kontaktni_telefon ?? old('kontaktni_telefon') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{{ url('vpis/prijava_za_studij') }}" class="btn btn-danger pull-left">
                                        <i class="fa fa-btn fa-sign-in"></i>Nazaj
                                    </a>
                                    <button type="submit" name="shraniPogoj" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Potrdi prijavo
                                    </button>
                                </div>
                            </div>

                            @if (!empty(session('errors')))
                                <div class="alert alert-danger">
                                    @foreach (array_unique(session('errors')) as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif

                            @include('flash_message')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
