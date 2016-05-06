@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Podatki o študijskem programu</h4>
            <div class="panel-group">
                {!! csrf_field() !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Študijski program</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fakulteta: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="izpisProgramov_fakultete">
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
                                <select name="program" class="form-control" id="izpisProgramov_programi">
                                    <option selected data-fakulteta="-1" value="">Izberite program izbranega visokošolskega zavoda.</option>
                                    @foreach($programi as $program)
                                    <option data-fakulteta="{{ $program->id_zavoda }}"
                                            data-mesta="{{ $program->stevilo_vpisnih_mest }}" 
                                            data-mesta_omejitev="{{ $program->stevilo_mest_po_omejitvi }}"
                                            data-omejitev="{{$program->omejitev_vpisa}}" 
                                            data-nacin="{{$program->nacin_studija}}" 
                                            data-vrsta="{{$program->vrsta}}" 
                                            value="{{$program->id}}" style="display:none">{{$program->ime}}
                                    </option>
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
                                <p id="stevilo_vpisnih_mest" class="form-control-static"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Omejitev vpisa: </label>
                            <div class="col-md-6">
                                <p class="form-control-static" id="omejitev"</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število mest po omejitvi vpisa: </label>
                            <div class="col-md-6">
                                <p id="stevilo_mest_omejitev" class="form-control-static"></p>
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
                                <p id="nacin_studija" class="form-control-static"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Vrsta študija: </label>
                            <div class="col-md-6">
                                <p id="vrsta_studija" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection
