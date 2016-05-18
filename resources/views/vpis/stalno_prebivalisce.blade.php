@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                        <form class="form-horizontal" role="form" method="post" action="{{ url('vpis/stalno_prebivalisce') }}">
                            {!! csrf_field() !!}
                            <div class="panel-heading">Stalno prebivališče</div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Država: </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="drzava" id="stalno_prebivalisce_drzava">
                                            @foreach($drzave as $drzava)
                                                <option value="{{ $drzava->id }}"
                                                @if((!isset($stalnoPrebivalisce->id_drzave) && $drzava->ime == 'SLOVENIJA') ||
                                                    (isset($stalnoPrebivalisce->id_drzave) && $stalnoPrebivalisce->id_drzave == $drzava->id ))
                                                    {{ 'selected' }}
                                                @endif
                                                >
                                                    {{ $drzava->ime }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Naslov: </label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="naslov" value="{{ $stalnoPrebivalisce->naslov ?? old('naslov') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Občina: </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="obcina" id="stalno_prebivalisce_obcina">
                                            @foreach($obcine as $obcina)
                                                <option value="{{ $obcina->id }}"
                                                    @if(isset($stalnoPrebivalisce->id_obcine) && $stalnoPrebivalisce->id_obcine == $obcina->id) {{ 'selected' }}@endif
                                                >
                                                    {{ $obcina->ime }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pošta: </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="posta" id="stalno_prebivalisce_posta">
                                            @foreach($poste as $posta)
                                                <option value="{{ $posta->postna_stevilka }}"
                                                    @if(isset($stalnoPrebivalisce->postna_stevilka) && $stalnoPrebivalisce->postna_stevilka == $posta->postna_stevilka) {{ 'selected' }}@endif
                                                >
                                                    {{ '['.$posta->postna_stevilka . '] '. $posta->ime }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">Naslov za pošiljanje:</div>
                            <div class="panel-body">
                                <div class="form-group form-inline">
                                    <div class="col-md-6 col-md-offset-5">
                                        <input class="radio isti_naslov_za_posiljanje" type="radio" name="isti_naslov_za_posiljanje"
                                               @if(!(isset($stalnoPrebivalisce) && isset($naslovZaPosiljanje) && $stalnoPrebivalisce->naslov != $naslovZaPosiljanje->naslov)) {{ 'checked' }} @endif
                                               value="1" >  Isti kot stalno prebivališče
                                        <input class="radio isti_naslov_za_posiljanje" type="radio" name="isti_naslov_za_posiljanje"
                                               @if(isset($stalnoPrebivalisce) && isset($naslovZaPosiljanje) && $stalnoPrebivalisce->naslov != $naslovZaPosiljanje->naslov) {{ 'checked'}} @endif
                                               value="0" style="margin-left: 20px;">  Drugi
                                    </div>
                                </div>
                                <div class="obrazec" @if(!(isset($stalnoPrebivalisce) && isset($naslovZaPosiljanje) && $stalnoPrebivalisce->naslov != $naslovZaPosiljanje->naslov)) {!! 'style="display:none;"' !!} @endif>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Država: </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="posiljanje_drzava">
                                                @foreach($drzave as $drzava)
                                                    <option value="{{ $drzava->id }}"
                                                    @if((!isset($naslovZaPosiljanje->id_drzave) && $drzava->ime == 'SLOVENIJA') ||
                                                         (isset($naslovZaPosiljanje->id_drzave) && $naslovZaPosiljanje->id_drzave == $drzava->id ))
                                                        {{ 'selected' }}
                                                            @endif
                                                    >
                                                        {{ $drzava->ime }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Naslov: </label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="posiljanje_naslov" value="{{ $naslovZaPosiljanje->naslov ?? old('naslov') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Občina: </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="posiljanje_obcina">
                                                @foreach($obcine as $obcina)
                                                    <option value="{{ $obcina->id }}"
                                                    @if(isset($naslovZaPosiljanje->id_obcine) && $naslovZaPosiljanje->id_obcine == $obcina->id) {{ 'selected' }}@endif
                                                    >
                                                        {{ $obcina->ime }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Pošta: </label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="posiljanje_posta">
                                                @foreach($poste as $posta)
                                                    <option value="{{ $posta->postna_stevilka }}"
                                                    @if(isset($naslovZaPosiljanje->postna_stevilka) && $naslovZaPosiljanje->postna_stevilka == $posta->postna_stevilka) {{ 'selected' }}@endif
                                                    >
                                                        {{ $posta->postna_stevilka . ' '. $posta->ime }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <a href="{{ url('vpis/srednjesolska_izobrazba') }}" class="btn btn-danger pull-left">
                                        <i class="fa fa-btn fa-sign-in"></i>Nazaj
                                    </a>
                                    <button type="submit" name="shraniPogoj" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-sign-in"></i>Naslednji korak
                                    </button>
                                </div>
                            </div>

                            @include('flash_message')
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection