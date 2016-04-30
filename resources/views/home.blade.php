@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Prva stran</div>

                <div class="panel-body">
                    Pozdravljeni!

                    <br>
                    <h3>Rok za oddajo prijave: {{ $prijavniRok->konec }}</h3>
                    <a class="btn btn-primary" href="{{ url('vpis') }}">Vpis</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
