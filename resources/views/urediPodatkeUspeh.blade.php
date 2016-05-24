@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="panel-group">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Uspeh pri predmetih v 3. in 4. letniku</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Ime predmeta: </label>
                            <div class="col-md-4">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest" style="width: 10px">
                            </div>
                            <label class="col-md-6 control-label">Ime predmeta: </label>
                            <div class="col-md-8">
                                <input type="text" id="stevilo_vpisnih_mest" class="form-control" name="stevilo_mest" style="width: 10px">
                            </div>
                        </div>
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