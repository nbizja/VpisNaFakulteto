@extends('layouts.app')

@section('content')
        <div class="container">
                <h4>Urejanje deležev za izračun točk za študijski program {{$program->ime}} ({{$program->nacin_studija}})</h4>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/vpisniPogoji/shraniDeleze') }}">
                <div class="panel-group">
                        {!! csrf_field() !!}

                        <div class="panel panel-default">
                                <div class="panel-body">

                                        <div class="form-group">
                                                <br>
                                                <div class="form-group">
                                                        <label class="col-md-4 control-label">Uspeh v 3. in 4. letniku</label>
                                                        <div class="col-md-1">
                                                                <input type="text" class="form-control" name="uspeh" value="">
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        @if($pogoj->splosna_matura == 1)
                                                                <label class="col-md-4 control-label">Splošna matura</label>
                                                        @elseif ($pogoj->poklicna_matura == 1)
                                                                <label class="col-md-4 control-label">Poklicna matura</label>
                                                        @endif
                                                        <div class="col-md-1">
                                                                <input type="text" class="form-control" name="matura" value="">
                                                        </div>
                                                </div>
                                                @foreach($elementi as $element)
                                                        @if($element->id == $pogoj->id_elementa)
                                                                <div class="form-group">
                                                                        <label class="col-md-4 control-label">{{ucfirst(strtolower($element->ime))}}</label>
                                                                        <div class="col-md-1">
                                                                                <input type="text" class="form-control" name="elem" value="">
                                                                        </div>
                                                                </div>
                                                        @endif
                                                @endforeach
                                        </div>

                                        <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" name="shraniDeleze" class="btn btn-primary pull-right">
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