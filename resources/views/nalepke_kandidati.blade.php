@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('nalepke_kandidati/isci') }}">
        <div class="panel-group">
            {!! csrf_field() !!}
            <h4>Nalepke z naslovi kandidatov</h4>
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
                                    <option data-fakulteta="{{ $program->id_zavoda }}"
                                            data-mesta="{{ $program->stevilo_vpisnih_mest }}" data-mesta_omejitev="{{ $program->stevilo_mest_po_omejitvi }}" data-omejitev="{{$program->omejitev_vpisa}}" data-stevilo_sprejetih="{{$program->stevilo_sprejetih}}"
                                            data-mesta_tujci="{{ $program->stevilo_vpisnih_mest_tujci }}" data-mesta_omejitev_tujci="{{ $program->stevilo_mest_po_omejitvi_tujci }}" data-omejitev_tujci="{{$program->omejitev_vpisa_tujci}}" data-stevilo_sprejetih_tujci="{{$program->stevilo_sprejetih_tujci}}"
                                            data-nacin="{{$program->nacin_studija}}" data-vrsta="{{$program->vrsta}}" value="{{$program->id}}" style="display:none">{{$program->ime}}, {{$program->nacin_studija}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Način študija: </label>
                        <div class="col-md-6">
                            <select name="nacin_studija_kandidati" class="form-control" id="nacin_studija_kandidati">
                                <option selected value="">Izberite način študija.</option>
                                <option value="redni">Redni.</option>
                                <option value="izredni">Izredni.</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Način zaključka srednje šole: </label>
                        <div class="col-md-6">
                            <select name="zakljucek" class="form-control" id="nacin_zakljucka">
                                <option selected value="">Izberite način zaključka srednje šole.</option>
                                <option value="splosna">Splošna matura.</option>
                                <option value="poklicna">Poklicna matura.</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" name="isci" class="btn btn-primary pull-right">
                            <i class="fa fa-btn fa-sign-in"></i>Išči
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" name="izvozi" class="btn btn-primary pull-right">
                            <i class="fa fa-btn fa-sign-in"></i>Izvozi nalepke
                        </button>
                    </div>
                </div>
            </div>

            @if($prikaziSeznam)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="kandidati_seznam">
                                <thead>
                                <tr>
                                    <th>Emšo</th>
                                    <th>Ime in priimek kandidata</th>
                                    <th>Fakulteta in študijski program</th>
                                    <th>Naslov za pošiljanje</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    <div>
                </div>
            @endif

        </div>
        </form>
        @include('flash_message')
    </div>
@endsection
