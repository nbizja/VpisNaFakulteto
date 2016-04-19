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
                                <label class="col-md-4 control-label">Država: </label>
                                <div class="col-md-6">
                                    <select name="drzava">
                                        @foreach($drzave as $drzava)
                                            <option value="{{ $drzava->id }}">{{ $drzava->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-4 control-label">Občina: </label>
                                <div class="col-md-6">
                                    <select name="obcina">
                                        @foreach($obcine as $obcina)
                                            <option value="{{ $obcine->id }}">{{ $obcine->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-4 control-label">Pošta: </label>
                                <div class="col-md-6">
                                    <select name="posta">
                                        @foreach($poste as $posta)
                                            <option value="{{ $posta->postna_stevilka }}">{{ $posta->postna_stevilka . ' '. $posta->ime }}</option>
                                        @endforeach
                                    </select>
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
                                <label class="col-md-4 control-label">Emšo: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="emso" value="{{ $emso or old('emso') }}">
                                </div>
                            </div>

                            <h2>Izbira študijskih programov:</h2>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Emšo: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="emso" value="{{ $emso or old('emso') }}">
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Registracija
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

                            @if (!empty(session('success')))
                                <div class="alert alert-success">
                                    Registracija je bila uspešna. Na vaš email naslov so bili poslani aktivacijski podatki.
                                </div>
                            @endif

                            @if (isset($comment))

                                @if ($comment == 'success')
                                    <div class="alert alert-success">
                                        Uporabniški račun uspešno aktiviran. Lahko se prijavite.
                                        @elseif ($comment == 'fail')
                                            <div class="alert alert-danger">
                                                Aktivacija neuspešna.
                                                @else
                                                    <div class="alert alert-danger">
                                                        Čas za aktivacijo je potekel.
                                                        @endif
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
