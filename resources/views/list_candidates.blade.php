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
                                    @if(Auth::user()->vloga != 'fakulteta')
                                        <option value="-1" @if ($zavod_id == -1) selected="selected" @endif> VSI </option>
                                    @endif
                                    @foreach($vz as $i=>$zavod)
                                        <option value="{{ $i }}" @if ($zavod_id == $i) selected="selected" @endif> {{ $zavod }} </option>
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
                                    <option value="-1" @if ($nacin == -1) selected="selected" @endif>VSI</option>
                                    <option value="0" @if ($nacin == 0) selected="selected" @endif>REDNI</option>
                                    <option value="1" @if ($nacin == 1) selected="selected" @endif>IZREDNI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label class="col-md-4 control-label">Način zaključa srednje šole </label>
                            <div class="col-md-6">
                                <select name="izob" id="izob" class="form-control input-sm">
                                    <option value="-1" @if ($srednja == -1) selected="selected" @endif>VSI</option>
                                    <option value="0" @if ($srednja == 0) selected="selected" @endif>SPLOŠNA MATURA</option>
                                    <option value="1" @if ($srednja == 1) selected="selected" @endif>POKLICNA MATURA</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" name="izpisi" value="izpisi" class="btn btn-primary">
                                    Išči
                                </button>
                                @if(!empty($kandidati) && count($kandidati) > 0)
                                <button type="submit" name="pdf" value="pdf" class="btn btn-primary">
                                    Izvozi pdf
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding: 5%">
@if(!empty($kandidati) && count($kandidati) > 0)
<table class="table table-hover">
    <tr>
        <th>  </th>
        <th>Priimek in ime</th>
        <th>Način zaključka srednje šole</th>
        <th>Visokošolski zavod</th>
        <th>Študijski program</th>
        <th>Način študija</th>
    </tr>
    @foreach($kandidati as $kandidat)
    <tr>
        <td> <a href="{{ url('vpis/'.$kandidat->id.'/pregled') }}">{{$kandidat->priimek}} {{$kandidat->ime}}</a></td>
        <td> {{$kandidat->srednja}}  </td>
        <td> {{$kandidat->zavod}} </td>
        <td> {{$kandidat->program}} </td>
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

        var zavod_id = $('#zavod option:selected').index();
        var tr = {{Auth::user()->vloga == 'fakulteta'}} + 0;
        if(tr) {
            zavod_id = {{$idz}} + 1;
        }
        console.log(zavod_id);
        $.get('/seznamKandidatov/' + zavod_id, function (data) {
            var option = '';
            $('#program').empty();
            var id = {{ $program_id }};
            console.log(id);
            $('#program').append('<option value="-1">VSI</option>');
            $.each(data, function(i, val) {
                if(id == i) option += '<option value="'+i+'" selected="selected">' + val + '</option>';
                else option += '<option value="'+i+'">' + val + '</option>';
            });
            $('#program').append(option);
        });

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