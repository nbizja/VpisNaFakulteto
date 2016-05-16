@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">V skladu z razpisom za vpis se prijavljam za študij</div>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis/prijava_za_studij') }}">
                    {!! csrf_field() !!}
                    <div id="zelja_1" class="panel panel-default zelja">
                        <div class="panel-heading">1. želja</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Visokošolski zavod: </label>
                                <div class="col-md-8">
                                    <select id="visokosolski_zavod_1" name="visokosolski_zavod_1" class="form-control">
                                        <option value="0">Izberi visokošolski zavod...</option>
                                        @foreach($visokosolskiZavodi as $zavod)
                                            <option value="{{ $zavod->id }}" class="zavod" @if($izbraniZavodi[0] == $zavod->id) {{ 'selected' }} @endif>
                                                {{ $zavod->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-8">
                                    <select id="studijski_program_1" name="studijski_program_1" class="form-control">
                                        <option value="0">Izberi študijski program...</option>
                                        @foreach($studijskiProgrami as $program)
                                            <option value="{{ $program->id }}" class="program zavod_{{ $program->id_zavoda }}" style="display:none;" @if($izbraniProgrami[0] == $program->id) {{ 'selected' }} @endif>
                                                {{ $program->ime . ' (' . strtolower($program->nacin_studija) . ')'}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div id="zelja_2" class="panel panel-default" @if($izbraniProgrami[1] == 0){!! 'style="display:none;"' !!}@endif>
                        <div class="panel-heading">2. želja</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Visokošolski zavod: </label>
                                <div class="col-md-8">
                                    <select id="visokosolski_zavod_2" name="visokosolski_zavod_2" class="form-control">
                                        <option value="0">Izberi visokošolski zavod...</option>
                                    @foreach($visokosolskiZavodi as $zavod)
                                            <option value="{{ $zavod->id }}" class="zavod" @if($izbraniZavodi[1] == $zavod->id) {{ 'selected' }} @endif>
                                                {{ $zavod->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-8">
                                    <select id="studijski_program_2" name="studijski_program_2" class="form-control">
                                        <option value="0">Izberi študijski program...</option>
                                        @foreach($studijskiProgrami as $program)
                                            <option value="{{ $program->id }}" class="program zavod_{{ $program->id_zavoda }}" style="display:none;" @if($izbraniProgrami[1] == $program->id) {{ 'selected' }} @endif>
                                                {{ $program->ime . ' (' . strtolower($program->nacin_studija) . ')'}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="zelja_3" class="panel panel-default" @if($izbraniProgrami[2] == 0){!! 'style="display:none;"'  !!}@endif>
                        <div class="panel-heading">3. želja</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Visokošolski zavod: </label>
                                <div class="col-md-8">
                                    <select id="visokosolski_zavod_3" name="visokosolski_zavod_3" class="form-control">
                                        <option value="0">Izberi visokošolski zavod...</option>
                                        @foreach($visokosolskiZavodi as $zavod)
                                            <option value="{{ $zavod->id }}" class="zavod" @if($izbraniZavodi[2] == $zavod->id) {{ 'selected' }} @endif>
                                                {{ $zavod->ime }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-8">
                                    <select id="studijski_program_3" name="studijski_program_3" class="form-control">
                                        <option value="0">Izberi študijski program...</option>
                                        @foreach($studijskiProgrami as $program)
                                            <option value="{{ $program->id }}" class="program zavod_{{ $program->id_zavoda }}" style="display:none;" @if($izbraniProgrami[2] == $program->id) {{ 'selected' }} @endif>
                                                {{ $program->ime . ' (' . strtolower($program->nacin_studija) . ')'}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                            <a href="{{ url('vpis/srednjesolska_izobrazba') }}" class="btn btn-danger pull-left">
                                <i class="fa fa-btn fa-sign-in"></i>Nazaj
                            </a>
                            <button type="submit" name="shraniPogoj" class="btn btn-primary pull-right">
                                <i class="fa fa-btn fa-sign-in"></i>Naslednji korak
                            </button>
                        </div>
                    </div>
                    @include('flash_message')
                </form>
            </div>
        </div>
    </div>
@endsection