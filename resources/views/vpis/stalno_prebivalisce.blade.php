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
                                        <select name="drzava">
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
                                        <input type="text" name="naslov" value="{{ $stalnoPrebivalisce->naslov ?? old('naslov') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Občina: </label>
                                    <div class="col-md-6">
                                        <select name="obcina">
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
                                        <select name="posta">
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
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="radio" name="isti_naslov_za_posiljanje" value="1">Isti kot stalno prebivališče
                                        <input type="radio" name="isti_naslov_za_posiljanje" value="0">Drugo
                                    </div>
                                </div>
                                <div class="obrazec">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Država: </label>
                                        <div class="col-md-6">
                                            <select name="posiljanje_drzava">
                                                @foreach($drzave as $drzava)
                                                    <option value="{{ $drzava->id }}">{{ $drzava->ime }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Naslov: </label>
                                        <div class="col-md-6">
                                            <input type="text" name="posiljanje_naslov" value="{{ $naslov or old('naslov') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Občina: </label>
                                        <div class="col-md-6">
                                            <select name="posiljanje_obcina">
                                                @foreach($obcine as $obcina)
                                                    <option value="{{ $obcina->id }}">{{ $obcina->ime }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Pošta: </label>
                                        <div class="col-md-6">
                                            <select name="posiljanje_posta">
                                                @foreach($poste as $posta)
                                                    <option value="{{ $posta->postna_stevilka }}">{{ $posta->postna_stevilka . ' '. $posta->ime }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <input type="submit" class="form-control btn-primary" value="Naslednji korak">
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
@endsection