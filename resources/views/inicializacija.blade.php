@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inicializacija sistema za tekoče šolsko leto</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{action('HomeController@init')}}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Začetek prijavnega roka</label>
                            <div class="col-md-6">
                                <input type="date" id="zacetek" name="zacetek" min="{{$today}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Konec prijavnega roka</label>
                            <div class="col-md-6">
                                <input type="date" id="konec" name="konec" min="{{$today}}" >
                            </div>
                        </div>
                        <br/>
                        @if ($message != '')
                            <div class="alert alert-success"> {{$message}}</div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-10">
                                <button type="submit" class="btn btn-primary">
                                    Inicializiraj
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>

    </script>
@endsection