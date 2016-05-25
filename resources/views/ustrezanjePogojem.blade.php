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
                                <input value="{{$kandidat->ime.' '.$kandidat->priimek}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">EMŠO: </label>
                            <div class="col-md-6">
                                <input value="{{$kandidat->emso}}" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                </div>


                @if ($matura != null)
                    <div class="panel panel-default">
                        <div class="panel-heading">Podatku o zaključku srednje šole</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tip mature: </label>
                                <div class="col-md-6">
                                    <input value="{{$tipMature == 0 ? "Splošna matura" : "Poklicna matura"}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Poklic: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->poklic->ime}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Opravljena matura: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->opravil == 0 ? "Ne" : "Da"}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Maturitetni predmeti</div>
                        <div class="panel-body">

                            @foreach($predmeti as $predmet)
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="col-md-10">{{$predmet->predmet->ime}}</label>
                                    </div> <br>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">Podatku o zaključku srednje šole</div>
                        <div class="panel-body">
                            Podatki o zaključku še niso vnešeni.
                        </div>
                    </div>
                @endif


                @foreach($prijave as $prijava)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$prijava->zelja}}. želja</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Visokošolski zavod: </label>
                                <div class="col-md-6">
                                    <input value="{{$prijava->studijskiProgram->visokosolskiZavod->ime}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-6">
                                    <input value="{{$prijava->studijskiProgram->ime.' ('.$prijava->studijskiProgram->nacin_studija.')'}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Kandidat ustreza pogojem: </label>
                                <div class="col-md-6">
                                    <input value="{{$rezultat[$prijava->zelja-1] == 0 ? 'Ne' : 'Da'}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </form>
    </div>
@endsection