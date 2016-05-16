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
                                    <select name="visokosolski_zavod_1">
                                        @foreach($visokosolskiZavodi as $zavod)
                                            <option value="{{ $zavod->id }}">{{ $zavod->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-6">
                                    <select name="studijski_program_1">
                                        @foreach($studijskiProgrami as $program)
                                            <option value="{{ $program->id }}">{{ $program->ime }}</option>
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