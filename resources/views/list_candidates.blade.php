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
                            <label>State
                                <select name="state" id="state" class="form-control input-sm">
                                    <option value=""></option>
                                    @foreach($vz as $zavod)
                                        {{ $zavod->ime}}
                                    @endforeach
                                </select>
                            </label>
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
                                <input type="password" class="form-control" name="password1" value="{{ old('password1') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Ponovno vnestite geslo</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password2" value="{{ old('password2') }}">
                            </div>
                        </div>

                        @if (session('message0') != '')
                            <div class="alert alert-success"> {{session('message0')}}</div>
                        @endif
                        @if (session('message1') != '')
                            <div class="alert alert-danger"> {{session('message1')}}</div>
                        @endif
                        @if (session('message2') != '')
                            <div class="alert alert-danger"> {{session('message2')}}</div>
                        @endif
                        @if (session('message3') != '')
                            <div class="alert alert-danger"> {{session('message3')}}</div>
                        @endif
                        @if (session('message4') != '')
                            <div class="alert alert-danger"> {{session('message4')}}</div>
                        @endif
                        @if (session('message5') != '')
                            <div class="alert alert-danger"> {{session('message5')}}</div>
                        @endif

                        <br/>
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