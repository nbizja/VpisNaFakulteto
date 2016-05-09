@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Urejanje študijskega programa</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/studijskiProgrami/shrani') }}">
                <div class="panel-group">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Študijski program</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fakulteta: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="vzdrzevanjeProgramov_fakultete">
                                    <option selected value="">Izberite visokošolski zavod.</option>
                                    @foreach($fakultete as $fakulteta)
                                        <option value="{{$fakulteta->id}}">{{$fakulteta->ime}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program: </label>
                            <div class="col-md-6">
                                <select name="program" class="form-control" id="vzdrzevanjeProgramov_programi">
                                    <option selected data-fakulteta="-1" value="">Izberite program izbranega visokošolskega zavoda.</option>
                                    @foreach($programi as $program)
                                        <option data-fakulteta="{{ $program->id_zavoda }}" data-mesta="{{ $program->stevilo_vpisnih_mest }}" data-mesta_omejitev="{{ $program->stevilo_mest_po_omejitvi }}"
                                                data-omejitev="{{$program->omejitev_vpisa}}" data-nacin="{{$program->nacin_studija}}" data-vrsta="{{$program->vrsta}}" value="{{$program->id}}" style="display:none">{{$program->ime}}, {{$program->nacin_studija}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Informacije o vpisu</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Omejitev vpisa: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="omejitev" name="omejitev">
                                    <option value="da">Da</option>
                                    <option value="ne">Ne</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število mest po omejitvi vpisa: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_mest_omejitev" class="form-control" name="stevilo_mest_omejitev">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Splošne informacije</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Način študija: </label>
                            <div class="col-md-6">
                                <select class="form-control" name="nacin_studija" id="nacin_studija">
                                    <option value="redni">Redni</option>
                                    <option value="izredni">Izredni</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Vrsta študija: </label>
                            <div class="col-md-6">
                                <select class="form-control" name="vrsta_studija" id="vrsta_studija">
                                    <option value="un">Univerzitetni</option>
                                    <option value="vs">Visokošolski strokovni</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" name="shrani" class="btn btn-primary pull-right">
                    <i class="fa fa-btn fa-sign-in"></i>Shrani
                </button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" name="brisi" class="btn btn-primary pull-right">
                    <i class="fa fa-btn fa-sign-in"></i>Izbriši ta program
                </button>
            </div>
        </div>
        @include('flash_message')
        </form>
    </div>
@endsection
