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
                                    <input type="text" class="form-control" name="ime">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Priimek: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="priimek">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Email: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email">
                                </div>
                             </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Uporabniško ime: </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="col-md-4 control-label">Geslo: </label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                             </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Registracija
                                    </button>
                                </div>
                            </div>
                            @if (isset($errors))
                                <div class="alert alert-danger">
                                    @foreach (array_unique($errors) as $error)
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
