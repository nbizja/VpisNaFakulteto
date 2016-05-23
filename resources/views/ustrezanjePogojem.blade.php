@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Ustreznost vpisnih pogojev kandidata</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ action('StudijskiProgrami\StudijskiProgramiController@izvozPodatkov') }}">
            <div class="panel-group">
                {!! csrf_field() !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Kandidat</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Kandidat: </label>
                            <div class="col-md-6">
                                <input value="{{$id_kandidata}}" class="form-control" readonly>
                            </div>
                            <label class="col-md-4 control-label">EMŠO: </label>
                            <div class="col-md-6">
                                <input value="{{$id_kandidata}}" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">Podatku o zaključku srednje šole</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tip mature: </label>
                            <div class="col-md-6">
                                <input name="nacin" id="nacin_studija" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Opravljena matura: </label>
                            <div class="col-md-6">
                                <input name="vrsta" id="vrsta_studija" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Izbirni maturitetni predmeti (samo ob specifičnih vpisnih pogojih): </label>
                            <div class="col-md-6">
                                <input name="vrsta" id="vrsta_studija" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">1. želja</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Visokošolski zavod: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Kandidat ustreza pogojem: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">2. želja</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Visokošolski zavod: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Kandidat ustreza pogojem: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">3. želja</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Visokošolski zavod: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Kandidat ustreza pogojem: </label>
                            <div class="col-md-6">
                                <input class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
@endsection
