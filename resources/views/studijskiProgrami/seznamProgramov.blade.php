@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Študijski programi</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-1 control-label">Filtriraj po: </label>
                <div class="col-md-3">
                    <select class="form-control" name="filtri">
                            <option value="visokosolski_zavod">Visokošolski zavod</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Šifra</th>
                        <th>Fakulteta</th>
                        <th>Naziv</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programi as $program)
                        <tr>
                            <td>{{$program->sifra}}</td>
                            <td>{{$program->visokosolskiZavod->ime}}</td>
                            <td>{{$program->ime}}</td>
                            <td>Uredi</td>
                            <td>Izbriši</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection