@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Srednješolska izobrazba</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis/srednjesolska_izobrazba') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Način zakljuka srednje šole: </label>
                                <div class="col-md-6">
                                    <select name="srednja_sola">
                                        @foreach($naciniZakljuckaSrednjeSole as $nacin)
                                            <option value="{{ $nacin->id }}">{{ $nacin->ime }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Datum izdaje spričevala: </label>
                                <input type="date" name="datum_zakljucka" />
                                <label class="col-md-4 control-label">Srednja šola: </label>
                                <div class="col-md-6">
                                    <select name="srednja_sola">
                                        @foreach($srednjeSole as $srednjaSola)
                                            <option value="{{ $srednjaSola->id }}">{{ $srednjaSola->ime }}</option>
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