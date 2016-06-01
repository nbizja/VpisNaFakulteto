@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Rezultati razvrstitve</div>

                    <div class="panel-body">

                        <a class="btn btn-primary" href="{{ action('UspehKandidatovController@zapisiTocke') }}">Razvrsti kandidate</a>

                        @foreach($programi as $program)
                            <table class="table table-bordered table-hover table-striped">
                                <caption>{{ $program->ime }}</caption>
                                <tr>
                                    <th>Mesto</th>
                                    <th>Emso</th>
                                    <th>Ime</th>
                                    <th>Priimek</th>
                                    <th>Stevilo tock</th>
                                    <th>Želja</th>
                                </tr>
                                @foreach($program->rezultatiRazvrstitve as $razvrstitev)
                                    <tr>
                                        <td>{{ $razvrstitev->mesto }}</td>
                                        <td>{{ $razvrstitev->kandidat->emso }}</td>
                                        <td>{{ $razvrstitev->kandidat->ime }}</td>
                                        <td>{{ $razvrstitev->kandidat->priimek }}</td>
                                        <td>{{ $razvrstitev->stevilo_tock }}</td>
                                        <td>{{ $razvrstitev->zelja }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection