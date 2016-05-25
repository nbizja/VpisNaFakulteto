@extends('layouts.app')

@section('content')
        <div class="container">
                <h4>Urejanje deležev za izračun točk za študijski program {{$program->ime}} ({{$program->nacin_studija}})</h4>
                <form class="form-horizontal" name="forma" role="form" method="POST" action="{{ url('/vpisniPogoji/shraniDeleze') }}">
                <div class="panel-group">
                        {!! csrf_field() !!}

                        <div class="panel panel-default">
                                <div class="panel-body">
                                        <div class="form-group">
                                                <br>
                                                <div id="seznam_elementov">
                                                        <div class="form-group">
                                                                <?php $exists = 0 ?>
                                                                <label class="col-md-5 control-label">Uspeh v 3. in 4. letniku</label>
                                                                @foreach ($pogoj->Kriterij as $kriterij)
                                                                        @if($kriterij->ocene_34_letnika == 1)
                                                                                <?php $exists = 1 ?>
                                                                                <div class="col-md-1">
                                                                                        <input type="text" class="form-control" name="uspeh" value="{{$kriterij->utez}}">
                                                                                </div>
                                                                        @endif
                                                                @endforeach
                                                                @if($exists == 0)
                                                                        <div class="col-md-1">
                                                                                <input type="text" class="form-control" name="uspeh" value="0.00">
                                                                        </div>
                                                                @endif
                                                        </div>
                                                        <div class="form-group">
                                                                <?php $exists = 0 ?>
                                                                <label class="col-md-5 control-label">Uspeh na maturi</label>
                                                                @foreach ($pogoj->Kriterij as $kriterij)
                                                                        @if($kriterij->maturitetni_uspeh == 1)
                                                                                <?php $exists = 1 ?>
                                                                                <div class="col-md-1">
                                                                                        <input type="text" class="form-control" name="matura" value="{{$kriterij->utez}}">
                                                                                </div>
                                                                        @endif
                                                                @endforeach
                                                                @if($exists == 0)
                                                                        <div class="col-md-1">
                                                                                <input type="text" class="form-control" name="matura" value="0.00">
                                                                        </div>
                                                                @endif
                                                        </div>
                                                        @foreach ($pogoj->Kriterij as $kriterij)
                                                                @if($kriterij->id_elementa != '')
                                                                        <div class="form-group" id="div{{$kriterij->id}}">
                                                                                <label class="col-md-5 control-label">{{ucfirst(strtolower($kriterij->Element->ime))}}</label>
                                                                                <div class="col-md-1">
                                                                                        <input type="text" class="form-control" name="name{{$kriterij->Element->id}}" value="{{$kriterij->utez}}">
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

                                        <div id="error_message" style="display: none; width: 82%; margin: auto; margin-top: 0%" class="alert alert-success"> </div>
                                        <br>

                                        <div class="form-group">
                                                <div class="col-md-7 col-md-offset-4">
                                                        <button type="submit" name="pogoj{{$pogoj->id}}" class="btn btn-primary pull-right">
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
                                                '<input type="text" class="form-control" name="name' + id +'" value="0.00">' +
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

                        $('form[name=forma]').submit(function(e) {
                                if (!validateInput()) {
                                        return false;
                                }
                        });

                        function validateInput(){
                                var isValid = true;
                                var sum = 0;
                                $("input[type=text]").each(function() {
                                        if(this.value > 1) {
                                                isValid = false;
                                                $(this).css("background-color", "#ff4d4d");
                                        }
                                        else {
                                                $(this).css("background-color", "#ffffff");
                                        }
                                        sum += parseFloat($(this).val());
                                });

                                if (sum == 1 && isValid) return true;
                                else {
                                        $("#error_message").css('display', 'block');
                                        if(sum != 1) $("#error_message").html("Vsota deležev mora biti 1!");
                                        else $("#error_message").text("Vnešene vrednosti ne ustrezajo formatu!");
                                        return false;
                                }
                        }
                });
        </script>
@endsection