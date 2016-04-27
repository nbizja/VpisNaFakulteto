@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">V skladu z razpisom za vpis se prijavljam za študij</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis/vpis_za_studij') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <h2>Študij</h2>
                                <label class="col-md-4 control-label">Visokošolski zavod: </label>
                                <div class="col-md-6">
                                    <select name="visokosolski_zavod">
                                        @foreach($visokosolskiZavodi as $zavod)
                                            <option value="{{ $zavod->id }}">{{ $zavod->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-6">
                                    <select name="visokosolski_zavod">
                                        @foreach($studijskiProgrami as $program)
                                            <option value="{{ $program->id }}">{{ $program->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-4 control-label">Smer/modul: </label>
                                <div class="col-md-6">
                                    <select name="visokosolski_zavod">
                                        @foreach($studijskiProgrami as $program)
                                            <option value="{{ $program->id }}">{{ $program->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Način študija: </label>
                                <div class="col-md-6">
                                    <select name="nacin_studija">
                                        @foreach($naciniStudija as $nacin)
                                            <option value="{{ $nacin->id }}">{{ $nacin->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection