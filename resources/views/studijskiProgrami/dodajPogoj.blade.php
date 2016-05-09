@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Dodaj vpisni pogoj za študijski program {{$program->ime}}</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/vpisniPogoji/novPogoj') }}">
            <div class="panel-group">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Elementi vpisnega pogoja: </label>
                            <div class="col-md-3 pull-left">
                                <input type="hidden" name="program" value="{{$program->id}}"/>
                                <select name="element1" class="form-control" id="izberiPogoj">
                                    <option selected value="">--Izberite element--</option>
                                        <option value="splosna_matura" selected>Splošna matura</option>
                                        <option value="poklicna_matura">Poklicna matura</option>
                                        <option value="brez_mature"></option>
                                </select>
                                <br>

                                <select name="element2"  class="form-control" id="izberiPogoj">
                                    <option value="">--Izberite element ali prazno polje--</option>
                                    @foreach($elementi as $element)
                                            <option value="{{$element->id}}">{{$element->ime}}</option>
                                    @endforeach
                                    <option selected value="prazno"></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" name="shraniPogoj" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-sign-in"></i>Shrani
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('flash_message')
        </form>
    </div>
@endsection