@extends('layouts.app')

@section('content')
        <div class="container">
                <h4>Urejanje vpisnih pogojev za študijski program {{$program->ime}}</h4>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/vpisniPogoji/shraniPogoj') }}">
                <div class="panel-group">
                        {!! csrf_field() !!}

                        <div class="panel panel-default">
                                <div class="panel-body">
                                        <div class="form-group">
                                                <input type="hidden" name="pogoj" value="{{$pogoj->id}}"/>
                                                <label class="col-md-4 control-label">Elementi vpisnega pogoja: </label>
                                                <div class="col-md-3 pull-left">

                                                        <select name="element1" class="form-control" id="izberiPogoj">
                                                                <option selected value="">--Izberite element--</option>
                                                                @if($pogoj->splosna_matura == 1)
                                                                        <option value="splosna_matura" selected>Splošna matura</option>
                                                                        <option value="poklicna_matura">Poklicna matura</option>
                                                                        <option value="brez_mature"></option>
                                                                @elseif ($pogoj->poklicna_matura == 1)
                                                                        <option value="splosna_matura">Splošna matura</option>
                                                                        <option value="poklicna_matura" selected>Poklicna matura</option>
                                                                        <option value="brez_mature"></option>
                                                                @else
                                                                        <option selected value="brez_mature"></option>
                                                                        <option value="splosna_matura">Splošna matura</option>
                                                                        <option value="poklicna_matura" selected>Poklicna matura</option>
                                                                @endif
                                                        </select>
                                                        <br>

                                                        <select name="element2"  class="form-control" id="izberiPogoj">
                                                                <option value="">--Izberite element--</option>
                                                                @foreach($elementi as $element)
                                                                        @if($element->id == $pogoj->id_elementa)
                                                                                <option value="{{$element->id}}" selected>{{$element->ime}}</option>
                                                                        @else
                                                                                <option value="{{$element->id}}">{{$element->ime}}</option>
                                                                        @endif
                                                                @endforeach
                                                                @if(empty($pogoj->id_elementa))
                                                                        <option selected value="prazno"></option>
                                                                @else
                                                                        <option value="prazno"></option>
                                                                @endif
                                                        </select>


                                                        <br>
                                                        <select name="element3"  class="form-control" id="izberiPogoj2">
                                                                <option value="">--Izberite element--</option>
                                                                @foreach($elementi as $element)
                                                                        @if($element->id == $pogoj->id_elementa2)
                                                                                <option value="{{$element->id}}" selected>{{$element->ime}}</option>
                                                                        @else
                                                                                <option value="{{$element->id}}">{{$element->ime}}</option>
                                                                        @endif
                                                                @endforeach
                                                                @if(empty($pogoj->id_elementa2))
                                                                        <option selected value="prazno"></option>
                                                                @else
                                                                        <option value="prazno"></option>
                                                                @endif
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