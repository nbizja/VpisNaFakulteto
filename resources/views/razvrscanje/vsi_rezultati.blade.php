@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Rezultati razvrstitve</div>

                    <div class="panel-body">

                        <a class="btn btn-primary" href="{{ action('UspehKandidatovController@zapisiTocke') }}">Izracunaj točke</a>
                        <a class="btn btn-primary" href="{{ action('RazvrscanjeController@razvrsti') }}">Razvrsti kandidate</a>
                        <a class="btn btn-primary" href="{{ action('RazvrscanjeController@izvoziSklepe') }}">Izvozi sklepe</a>
                        <br>
                        <br>
                        <br>
                        <p>*SBSD = Slovenec brez slovenskega državljanstva</p>
                        @foreach($programi as $program)
                            <table class="table table-bordered table-hover table-striped">
                                <caption>{{ $program->ime . '('. $program->nacin_studija  .')' }}</caption>
                                <tr>
                                    <th>Mesto</th>
                                    <th>Emso</th>
                                    <th>Ime</th>
                                    <th>Priimek</th>
                                    <th>Stevilo tock</th>
                                    <th>Želja</th>
                                    <th>Opombe</th>
                                </tr>
                                <tr>
                                    <td colspan="7">Kandidati iz območja EU</td>
                                </tr>
                                <?php $uvrstitevSlo = $uvrstitevTujci =  1; ?>
                                @foreach($program->prijave->filter(function($prijava) {
                                    return !$prijava->tujec;
                                }) as $prijava)
                                    <tr>
                                        <td>{{ $uvrstitevSlo }}</td>
                                        <td>{{ $prijava->kandidat->emso }}</td>
                                        <td>{{ $prijava->kandidat->ime }}</td>
                                        <td>{{ $prijava->kandidat->priimek }}</td>
                                        <td>{{ $prijava->tocke }}</td>
                                        <td>{{ $prijava->zelja }}</td>
                                        <td></td>
                                    </tr>
                                    <?php $uvrstitevSlo++; ?>
                                @endforeach
                                @if($uvrstitevSlo == 1)
                                    <tr>
                                        <td colspan="7">/</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td colspan="7">Kandidati izven območja EU</td>
                                </tr>
                                @foreach($program->prijave->filter(function($prijava) {
                                            return $prijava->tujec;
                                        }) as $prijava)
                                    <tr>
                                        <td>{{ $uvrstitevTujci }}</td>
                                        <td>{{ $prijava->kandidat->emso }}</td>
                                        <td>{{ $prijava->kandidat->ime }}</td>
                                        <td>{{ $prijava->kandidat->priimek }}</td>
                                        <td>{{ $prijava->tocke }}</td>
                                        <td>{{ $prijava->zelja }}</td>
                                        <td>{{ $prijava->osebniPodatki->id_drzavljanstva == 5 ? 'SBSD' : '' }}</td>

                                    </tr>
                                    <?php $uvrstitevTujci++; ?>
                                @endforeach
                                @if($uvrstitevTujci == 1)
                                    <tr>
                                        <td colspan="7">/</td>
                                    </tr>
                                @endif

                            </table>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection