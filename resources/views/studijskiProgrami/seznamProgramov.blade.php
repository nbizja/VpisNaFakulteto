@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Študijski programi</h3>
        </div>
        <div class="panel-body">
            <label class="col-md-1 control-label">Filter: </label>
            <div class="col-md-3">
                <select class="form-control" name="filtri" id="filtri">
                    <option selected value="">--Izberi--</option>
                    <option value="nacin">Način študija</option>
                    <option value="vrsta">Vrsta študija</option>
                    <option value="omejitev">Omejitev</option>
                </select>
            </div>

            <label class="col-md-1 control-label">Izberi: </label>
            <div class="col-md-3">
                <select class="form-control" name="izbira" id="izbira">
                    <option selected value="">--Izberi--</option>
                </select>
            </div>

            <form action="{{ action('StudijskiProgrami\SeznamController@izvozi') }}" method="post">
                {!! csrf_field() !!}

                <br><br><br>
                <div class="form-group col-xs-7">
                    <label for="zavod">Iskanje po ključni besedi (visokošolski zavod, program,...): </label>
                    <input type="text" class="form-control" name="search" id="search">
                </div>

                <br><br><br><br>
                
                <p>Izberi elemente za prikaz: </p>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="sifraC" id="sifraC" checked>Šifra</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="zavodC" id="zavodC" checked>Fakulteta</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="nacinC" id="nacinC" checked>Način študija</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="vrstaC" id="vrstaC" checked>Vrsta vpisa</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="steviloC" id="steviloC" checked>Število vpisnih mest</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="omejitevC" id="omejitevC" checked>Omejitev</label>


                <div class="text-right">
                    @foreach($query as $key => $value)
                        <input class="btn" type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input class="btn btn-primary pull-right" type="submit" name="pdf" id="izvoz" value="Izvoz v PDF">
                </div>
            </form>

        </div>
        <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="tblData">
                    <thead>
                    <tr>
                        <th class="sifra">Šifra</th>
                        <th class="zavod">Fakulteta</th>
                        <th>Naziv</th>
                        <th class="nacin">Način študija</th>
                        <th class="vrsta">Vrsta vpisa</th>
                        <th class="stevilo">Število vpisnih mest</th>
                        <th class="omejitev">Omejitev vpisa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programi as $program)
                        <tr>
                            <td class="sifra">{{$program->sifra}}</td>
                            <td class="zavod">{{$program->visokosolskiZavod->ime}}</td>
                            <td>{{$program->ime}}</td>
                            <td class="nacin">{{$program->nacin_studija}}</td>
                            <td class="vrsta">{{$program->vrsta}}</td>
                            <td class="stevilo">{{$program->stevilo_vpisnih_mest}}</td>
                            <td class="omejitev">{{$program->omejitev_vpisa == 1 ? 'Da':'Ne'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    </div>
    </div>
@endsection