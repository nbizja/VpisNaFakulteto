/@extends('layouts.app')

@section('content')
    <div class="container">
        <h4><b>{{$kandidat->priimek}}, {{$kandidat->ime}}</b>: urejanje podatkov o uspehu</h4>
        <br>
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="panel-group">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Splošni uspeh</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Uspeh v 3. letniku: </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ocena3letnik" value="{{$matura->ocena_3_letnik}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Uspeh v 4. letniku: </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ocena4letnik" value="{{$matura->ocena_4_letnik}}">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Uspeh na maturi</div>
                    <div class="panel-body">
                        @foreach($predmeti as $predmet)
                            @if($predmet->ocena > 0)
                                <div class="form-group">
                                    <div class="form-group">
                                        <label style="padding-left: 5%" class="control-label">{{substr($predmet->ime_predmeta, 0, -11)}}</label>
                                    </div><br>
                                    <div class="form-group">
                                        <div class="col-md-4" style="padding-left: 20%">Ocena v 3. letniku: </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="ocena3{{$predmet->id_predmeta}}" value="{{$predmet->ocena_3_letnik}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4" style="padding-left: 20%">Ocena v 4. letniku: </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="ocena4{{$predmet->id_predmeta}}" value="{{$predmet->ocena_4_letnik}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4" style="padding-left: 20%">Ocena na maturi: </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="ocenam{{$predmet->id_predmeta}}" value="{{$predmet->ocena}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endif
                        @endforeach
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