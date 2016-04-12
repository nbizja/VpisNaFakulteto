@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Seznam prijavljenih kandidatov</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{action('AddEmployeeController@validateInput')}}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Visokošolski zavod</label>
                            <div class="col-md-6">
                                <select name="zavod" id="zavod" class="form-control input-sm">
                                    @foreach($vz as $zavod)
                                        <option value=""> {{ $zavod }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Visokošolski zavod</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control input-sm">

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

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(document).ready(function(){

        //display modal form for task editing
        $('#zavod').change(function(){
            var zavod_id = $('#zavod option:selected').index();

            console.log(zavod_id);

            $.get('/seznamKandidatov/' + zavod_id, function (data) {

                console.log(data);
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