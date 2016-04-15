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
                            <label class="col-md-4 control-label">Vloga uporabnika</label>
                            <div class="col-md-6">
                                <select name="vloga" id="vloga" class="form-control input-sm">
                                    <option value="v1">VPIS</option>
                                    <option value="v2">FAKULTETA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="vzavod" style="display:none">
                            <label class="col-md-4 control-label">Visokošolski zavod</label>
                            <div class="col-md-6">
                                <select name="zavod" id="zavod" class="form-control input-sm">
                                    @foreach($vz as $i=>$zavod)
                                        <option value="{{ $i }}"> {{ $zavod }} </option>
                                        {{++$i}}
                                    @endforeach
                                </select>
                            </div>
                        </div>

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

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(document).ready(function(){

        $('#vloga').on('change', function() {
            if(this.value == 'v1') $('#vzavod').hide();
            else $('#vzavod').show();
        });

    });

</script>