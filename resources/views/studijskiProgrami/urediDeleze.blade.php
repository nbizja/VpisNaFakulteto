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
                                                <div id="seznam_elementov">
                                                        <div class="form-group">
                                                                <label class="col-md-5 control-label">Uspeh v 3. in 4. letniku</label>
                                                                @foreach ($pogoj->Kriterij as $kriterij)
                                                                        @if($kriterij->ocene_34_letnika == 1)
                                                                                <div class="col-md-1">
                                                                                        <input type="text" class="form-control" name="uspeh" value="{{$kriterij->utez}}">
                                                                                </div>
                                                                        @endif
                                                                @endforeach
                                                        </div>
                                                        <div class="form-group">
                                                                @foreach ($pogoj->Kriterij as $kriterij)
                                                                        @if($kriterij->maturitetni_uspeh == 1)
                                                                                @if($pogoj->splosna_matura == 1)
                                                                                        <label class="col-md-5 control-label">Splošna matura</label>
                                                                                @elseif ($pogoj->poklicna_matura == 1)
                                                                                        <label class="col-md-5 control-label">Poklicna matura</label>
                                                                                @endif
                                                                                <div class="col-md-1">
                                                                                        <input type="text" class="form-control" name="matura" value="{{$kriterij->utez}}">
                                                                                </div>
                                                                        @endif
                                                                @endforeach
                                                        </div>
                                                        @foreach ($pogoj->Kriterij as $kriterij)
                                                                @if($kriterij->id_elementa != '')
                                                                        <div class="form-group" id="div{{$kriterij->id}}">
                                                                                <label class="col-md-5 control-label">{{ucfirst(strtolower($kriterij->Element->ime))}}</label>
                                                                                <div class="col-md-1">
                                                                                        <input type="text" class="form-control" name="elem" value="{{$kriterij->utez}}">
                                                                                </div>
                                                                                <a class="btn btn-default izbrisi">
                                                                                        <i class="glyphicon glyphicon-remove"></i>
                                                                                </a>
                                                                        </div>
                                                                @endif
                                                        @endforeach
                                                </div>

                                                <br><br>

                                                <div class="well" style="margin-left: auto; margin-right: auto; width: 80%;">
                                                        <label style="margin-left: 4%">Dodaj element kot kriterij za izračun točk:</label>
                                                        <br><br>
                                                        <div class="form-group">
                                                                <select class="col-md-5 form-control" id="elementi" style="margin-left: 5%; width: 70%">
                                                                        <option selected value="">Izberi element</option>
                                                                        @foreach($elementi as $element)
                                                                                <option value="{{$element->id}}">{{ucfirst(strtolower($element->ime))}}</option>
                                                                        @endforeach
                                                                </select>
                                                                <a id="dodaj_element" class="btn btn-default" style="margin-left: 5px">
                                                                        <i class="glyphicon glyphicon-ok"></i>
                                                                </a>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                                <div class="col-md-7 col-md-offset-4">
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

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>
                $(document).ready(function() {

                        $('#dodaj_element').click(function() {

                                var name = $("#elementi option:selected").text();
                                var id = $("#elementi option:selected").val();

                                if($("#div" + id).length == 0) {
                                        $('#seznam_elementov').append(
                                                '<div class="form-group" id="div' + id + '"> ' +
                                                '<label class="col-md-5 control-label">'+ name +'</label>' +
                                                '<div class="col-md-1">' +
                                                '<input type="text" class="form-control" id="' + id +'" value="0.00">' +
                                                '</div>' +
                                                '<a class="btn btn-default izbrisi">' +
                                                '<i class="glyphicon glyphicon-remove"></i>' +
                                                '</a>' +
                                                '</div>'
                                        );
                                }
                        });

                        $(document).delegate('.izbrisi', 'click', function() {
                                $(this).parent().remove();
                        });
                });
        </script>
@endsection