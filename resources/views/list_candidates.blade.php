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
                                    <option value=""> -- </option>
                                    @foreach($vz as $zavod)
                                        <option value=""> {{ $zavod }} </option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" name="zavod1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control input-sm"></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Način študija</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control input-sm">
                                    <option value="">REDNI</option>
                                    <option value="">IZREDNI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Zadnja zaključena izobrazba</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control input-sm">
                                    @foreach($koncana_srednja as $s)
                                        <option value=""> {{ $s }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Izredni talent</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control input-sm">
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
@endsection

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(document).ready(function(){

        //display modal form for task editing
        $('#zavod').change(function(){
            var zavod_id = $('#zavod option:selected').index();

            console.log(zavod_id);

            $.get('/seznamKandidatov/' + zavod_id, function (data) {

                var option = '';
                $('#program').empty();
                $.each(data, function(i, val) {
                    option += '<option>' + val + '</option>';
                });
                $('#program').append(option);
            });
        });

    });

</script>