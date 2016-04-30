@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Prijava za vpis</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Emšo: </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="emso" value="{{ $emso or old('emso') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Ime: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ime" value="{{ Auth::user()->ime or old('ime') }}">
                                </div>
                                <label class="col-md-4 control-label">Priimek: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="priimek" value="{{ Auth::user()->priimek or old('priimek') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Datum rojstva: </label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" name="datum_rojstva" value="{{ $datumRojstva or old('datum_rojstva') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Država rojstva: </label>
                                <div class="col-md-6">
                                    <select name="drzava_rojstva">
                                        @foreach($drzave as $drzava)
                                            <option value="{{ $drzava->id }}">{{ $drzava->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kraj rojstva: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="kraj_rojstva" value="{{ $krajRojstva or old('kraj_rojstva') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Državljanstvo: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="drzavljanstvo" value="{{ $drzavljanstvo or old('drzavljanstvo') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Kontaktni telefon: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="kontaktni_telefon" value="{{ $telefon or old('kontaktni_telefon') }}">
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
