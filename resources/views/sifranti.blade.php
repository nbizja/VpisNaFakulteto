@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$title}}</div>
                        <div class="panel-body">
                            <div class="rapyd-filter">
                            {!! $filter !!}
                            {!! $grid !!}
                            <a class="btn btn-default" href="{{$add_url}}" role="button">Nov vnos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection