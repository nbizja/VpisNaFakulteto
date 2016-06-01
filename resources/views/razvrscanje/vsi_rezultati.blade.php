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
                                <?php $mesto = 1; ?>
                                @foreach($program->prijave as $prijava)
                                    <tr>
                                        <td>{{ $mesto }}</td>
                                        <td>{{ $prijava->kandidat->emso }}</td>
                                        <td>{{ $prijava->kandidat->ime }}</td>
                                        <td>{{ $prijava->kandidat->priimek }}</td>
                                        <td>{{ $prijava->tocke }}</td>
                                        <td>{{ $prijava->zelja }}</td>
                                    </tr>
                                    <?php $mesto++; ?>
                                @endforeach
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection