@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Seznam prijavljenih kandidatov</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{action('ListOfCandidatesController@getList')}}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Visokošolski zavod</label>
                            <div class="col-md-6">
                                <select name="zavod" id="zavod" class="form-control input-sm">
                                    <option value="-1"> VSI </option>
                                    @foreach($vz as $i=>$zavod)
                                        <option value="{{ $i }}"> {{ $zavod }} </option>
                                        {{++$i}}
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control input-sm">
                                    <option value="-1">VSI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Način študija</label>
                            <div class="col-md-6">
                                <select name="nacin" id="nacin" class="form-control input-sm">
                                    <option value="-1">VSI</option>
                                    <option value="0">REDNI</option>
                                    <option value="1">IZREDNI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-md-4 control-label">Način zaključa srednje šole </label>
                            <div class="col-md-6">
                                <select name="izob" id="izob" class="form-control input-sm">
                                    <option value="-1">VSI</option>
                                    <option value="0">SPLOŠNA MATURA</option>
                                    <option value="1">POKLICNA MATURA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Izredni talent</label>
                            <div class="col-md-6">
                                <select name="talent" id="talent" class="form-control input-sm">
                                    <option value="-1">VSI</option>
                                </select>
                            </div>
                        </div>

                        <br/>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Išči
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding: 5%">
@if(!empty($kandidati))
<table class="table table-hover">
    <tr>
        <th>  </th>
        <th>Priimek in ime</th>
        <th>Način zaključka srednje šole</th>
        <th>Visokošolski zavod</th>
        <th>Študijski program</th>
        <th>Izredni talent</th>
        <th>Način študija</th>
    </tr>
    @foreach($kandidati as $kandidat)
    <tr>
        <td> {{$kandidat->priimek}} {{$kandidat->ime}}</td>
        <td> {{$kandidat->srednja}}  </td>
        <td> {{$kandidat->zavod}} </td>
        <td> {{$kandidat->program}} </td>
        <td> NE </td>
        <td> {{$kandidat->nacin}} </td>
    </tr>
    @endforeach
</table>
@endif
<script>
    var tables = document.getElementsByTagName('table');
    var table = tables[tables.length - 1];
    var rows = table.rows;
    for(var i = 1, td; i < rows.length; i++){
        td = document.createElement('td');
        td.appendChild(document.createTextNode(i));
        rows[i].insertBefore(td, rows[i].firstChild);
    }
</script>
</div>

@endsection

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(document).ready(function(){

        //display modal form for task editingv3r3
        $('#zavod').change(function(){
            var zavod_id = $('#zavod option:selected').index();

            $.get('/seznamKandidatov/' + zavod_id, function (data) {

                var option = '';
                $('#program').empty();
                $('#program').append('<option value="-1">VSI</option>');
                $.each(data, function(i, val) {
                    option += '<option value="'+i+'">' + val + '</option>';
                });
                $('#program').append(option);
            });
        });

    });

</script>