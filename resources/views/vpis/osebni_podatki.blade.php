@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Prijava za vpis</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" action="{{ url('vpis/osebni_podatki') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Emšo: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="emso" placeholder="0101998500123" value="{{ $osebniPodatki->emso ?? old('emso') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Ime: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ime" value="{{  $osebniPodatki->ime ?? Auth::user()->ime }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Priimek: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="priimek" value="{{ $osebniPodatki->priimek ?? Auth::user()->priimek }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Datum rojstva: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="datum_rojstva" placeholder="dd.mm.yyyy" value="{{ $osebniPodatki->datum_rojstva ?? old('datum_rojstva') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Država rojstva: </label>
                                <div class="col-md-6">
                                    <select name="drzava_rojstva" class="form-control col-md-6" required>
                                        @foreach($drzave as $drzava)
                                            <option value="{{ $drzava->id }}" @if($drzava->ime == 'SLOVENIJA') {{ 'selected' }} @endif>{{ $drzava->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kraj rojstva: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="kraj_rojstva" value="{{ $krajRojstva or old('kraj_rojstva') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Državljanstvo: </label>
                                <div class="col-md-6">
                                    <select name="drzavljanstvo" class="form-control col-md-6">
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
                                <label class="col-md-4 control-label">Kontaktni telefon: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="kontaktni_telefon" placeholder="030123456" value="{{ $osebniPodatki->kontaktni_telefon ?? old('kontaktni_telefon') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3">
                                    <input type="submit" class="form-control btn-primary" value="Naslednji korak">
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
