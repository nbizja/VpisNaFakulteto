@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Urejanje podatkov za {{$kandidat->ime}} {{$kandidat->priimek}}</h4>
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="panel-group">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Uspeh v 3. letniku</div>
                    <div class="panel-body">
                        @foreach($predmeti as $predmet)
                            @if($predmet->ocena_3_letnik > 0)
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{$predmet->id_predmeta}}</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="ocena3{{$predmet->id_predmeta}}" value="{{$predmet->ocena_3_letnik}}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Uspeh v 4. letniku</div>
                    <div class="panel-body">
                        @foreach($predmeti as $predmet)
                            @if($predmet->ocena_4_letnik > 0)
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{$predmet->id_predmeta}}</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="ocena4{{$predmet->id_predmeta}}" value="{{$predmet->ocena_4_letnik}}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Rezultati splošne mature</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest*: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Rezultati poklicne mature</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest*: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Rezultati mednarodne mature</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest*: </label>
                            <div class="col-md-6">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" name="shrani" class="btn btn-primary pull-right">
                            <i class="fa fa-btn fa-sign-in"></i>Shrani
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection