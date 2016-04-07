@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registracija novega uporabniškega računa za zaposlene</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{action('AddEmployeeController@validateInput')}}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Uporabniško ime</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Email naslov</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Ime</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Priimek</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Geslo</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <br/>

                        {{ session('message1') }}
                        {{ session('message2') }}
                        {{ session('message3') }}

                        <br/><br/>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Dodaj račun
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection