@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pozabljeno geslo</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('pozabljeno_geslo') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Uporabniško ime</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Novo geslo</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="new-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Potrdi geslo</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password-confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-refresh"></i>Pošlji
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
                                    <p>Potrditvena povezava je bila poslana na vaš email naslov.</p>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
