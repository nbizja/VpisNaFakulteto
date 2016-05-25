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
                    <h3>Rok za oddajo prijave: {{ date('d.m.Y', strtotime($prijavniRok->konec)) }}</h3>

                    @if(Auth::user()->jeKandidat())
                        @if(date('Y-m-d') <= $prijavniRok->konec)
                            @if(!is_null(Auth::user()->datum_oddaje_prijave))
                                <p>Prijavo ste oddali dne: {{ Auth::user()->datum_oddaje_prijave }}</p>
                                <a class="btn btn-primary" href="{{ url('vpis/'. Auth::user()->id.'/pregled') }}">
                                    Ogled oddane prijave
                                </a>
                            @else
                                <a class="btn btn-primary" href="{{ url('vpis/'. Auth::user()->id.'/osebni_podatki') }}">
                                    Začni prijavni postopek
                                </a>
                            @endif
                        @else
                            <h2>Rok za oddajo prijave je potekel</h2>
                            @if(!empty(Auth::user()->datum_oddaje_prijave))
                                <a class="btn btn-primary" href="{{ url('vpis/'. Auth::user()->id.'/pregled') }}">
                                    Ogled oddane prijave
                                </a>
                            @endif
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
