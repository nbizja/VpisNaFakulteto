@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registracija</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/registracija') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ime: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="ime" value="{{ $ime or old('ime') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Priimek: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="priimek" value="{{ $priimek or old('priimek') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email" value="{{ $email or old('email') }}">
                                </div>
                             </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Uporabniško ime: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username" value="{{ $username or old('username') }}">
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-4 control-label">Geslo: </label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                             </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Ponovi geslo: </label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
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

                            @if (isset($success))
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
