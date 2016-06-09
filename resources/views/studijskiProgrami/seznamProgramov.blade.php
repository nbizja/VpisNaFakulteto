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
                <label class="checkbox-inline"><input type="checkbox" value="1" name="steviloCO" id="steviloCO" checked>Število mest po omejitvi</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="steviloCS" id="steviloCS" checked>Število sprejetih kandidatov</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="omejitevC" id="omejitevC" checked>Omejitev</label>
                <br><br>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="steviloCT" id="steviloCT">Število vpisnih mest (tujci)</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="steviloCOT" id="steviloCOT">Število mest po omejitvi (tujci)</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="steviloCST" id="steviloCST">Število sprejetih kandidatov (tujci)</label>
                <label class="checkbox-inline"><input type="checkbox" value="1" name="omejitevCT" id="omejitevCT">Omejitev (tujci)</label>

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
                        <th class="stevilo_omejitev">Število mest po omejitvi</th>
                        <th class="stevilo_sprejetih">Število sprejetih kandidatov</th>
                        <th class="omejitev">Omejitev vpisa</th>
                        <th style="display: none" class="steviloT">Število vpisnih mest (tujci)</th>
                        <th style="display: none" class="stevilo_omejitevT">Število mest po omejitvi (tujci)</th>
                        <th style="display: none" class="stevilo_sprejetihT">Število sprejetih kandidatov (tujci)</th>
                        <th style="display: none" class="omejitevT">Omejitev vpisa (tujci)</th>
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
                            <td class="stevilo_omejitev">{{$program->stevilo_mest_po_omejitvi}}</td>
                            <td class="stevilo_sprejetih">{{$program->stevilo_sprejetih}}</td>
                            <td class="omejitev">{{$program->omejitev_vpisa > 0 ? 'Da':'Ne'}}</td>
                            <td style="display: none" class="steviloT">{{$program->stevilo_vpisnih_mest_tujci}}</td>
                            <td style="display: none" class="stevilo_omejitevT">{{$program->stevilo_mest_po_omejitvi_tujci}}</td>
                            <td style="display: none" class="stevilo_sprejetihT">{{$program->stevilo_sprejetih_tujci}}</td>
                            <td style="display: none" class="omejitevT">{{$program->omejitev_vpisa_tujci > 0 ? 'Da':'Ne'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    </div>
    </div>
@endsection