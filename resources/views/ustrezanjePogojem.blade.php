@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Ustreznost vpisnih pogojev kandidata</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ action('StudijskiProgrami\StudijskiProgramiController@izvozPodatkov') }}">
            <div class="panel-group">
                {!! csrf_field() !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Kandidat</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Kandidat: </label>
                            <div class="col-md-6">
                                <input value="{{$kandidat->ime.' '.$kandidat->priimek}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">EMŠO: </label>
                            <div class="col-md-6">
                                <input value="{{$kandidat->emso}}" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                </div>


                @if ($matura != null)
                    <div class="panel panel-default">
                        <div class="panel-heading">Podatku o zaključku srednje šole</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tip mature: </label>
                                <div class="col-md-6">
                                    <input value="{{$tipMature == 0 ? "Splošna matura" : "Poklicna matura"}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Poklic: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->poklic->ime}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Opravljena matura: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->opravil == 0 ? "Ne" : "Da"}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Uspeh 3. in 4. letnika srednje šole</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-4 control-label">3.letnik: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->ocena_3_letnik}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">4.letnik: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->ocena_4_letnik}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Število točk na maturi: </label>
                                <div class="col-md-6">
                                    <input value="{{$matura->ocena}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Maturitetni predmeti</div>
                        <div class="panel-body">

                        <table class="table table-hover">
                            <tr>
                                <th>Šifra predmeta</th>
                                <th>Predmet</th>
                                <th>Ocena</th>
                            </tr>
                            @foreach($predmeti as $predmet)
                                <tr>
                                    <td>{{$predmet->predmet->id}}</td>
                                    <td>{{$predmet->predmet->ime}}</td>
                                    <td>{{$predmet->ocena}}</td>
                                </tr>
                            @endforeach
                        </table>

                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">Podatku o zaključku srednje šole</div>
                        <div class="panel-body">
                            Podatki o zaključku še niso vnešeni.
                        </div>
                    </div>
                @endif


                @foreach($prijave as $prijava)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$prijava->zelja}}. želja</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Visokošolski zavod: </label>
                                <div class="col-md-6">
                                    <input value="{{$prijava->studijskiProgram->visokosolskiZavod->ime}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Študijski program: </label>
                                <div class="col-md-6">
                                    <input value="{{$prijava->studijskiProgram->ime.' ('.$prijava->studijskiProgram->nacin_studija.')'}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Kandidat ustreza pogojem: </label>
                                <div class="col-md-6">
                                    <input value="{{$rezultat[$prijava->zelja-1] == 0 ? 'Ne' : 'Da'}}" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Število točk: </label>
                                <div class="col-md-6">
                                    <input value="{{$tocke[$prijava->zelja-1] == 0 ? '/' : $tocke[$prijava->zelja-1]}}" class="form-control" readonly>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <?php $i = 0; ?>
                        @foreach($prijava->studijskiProgram->VpisniPogoji as $pogoj)
                            <?php $i++; ?>
                            <div class="panel-group"><div class="panel-default"><div class="panel-heading">{{$i}}.vpisni pogoj:</div><div class="panel-body">
                                <div class="col-md-6">
                                    <ul>
                                        @if ($pogoj->splosna_matura == 1)
                                            <li>Splošna matura</li>
                                        @elseif($pogoj->poklicna_matura == 1)
                                            <li>Poklicna matura</li>
                                        @elseif($pogoj->id_poklica != null)
                                            <li>Poklic: {{$pogoj->Poklic->ime}}</li>
                                        @endif
                                        @if ($pogoj->id_elementa != null)
                                            <li>{{ ucfirst(mb_strtolower($pogoj->Element->ime)) }}</li>
                                        @endif
                                        @if ($pogoj->id_elementa2 != null)
                                            <li>{{ ucfirst(mb_strtolower($pogoj->Element2->ime)) }}</li>
                                        @endif
                                    </ul>
                                </div>
                                <br/><br/><br/><br/>
                                <div style="width: 100%">
                                    @if(count($pogoj->Kriterij) > 0)
                                        <div class="well" style="display: inline-block; width: 50%; height: 100%">
                                            <label>Kriterij za izračun točk:</label>
                                            <br>
                                            <ul>
                                                @foreach($pogoj->Kriterij as $kriterij)
                                                    @if($kriterij->id_elementa == null)
                                                        @if($kriterij->maturitetni_uspeh == 1)
                                                            <li>{{$kriterij->utez}}<span class="col-md-6">Uspeh na maturi: </span></li>
                                                        @elseif($kriterij->ocene_34_letnika == 1 && $kriterij->utez > 0)
                                                            <li>{{$kriterij->utez}}<span class="col-md-6">Uspeh v 3. in 4. letniku:</span></li>
                                                        @endif
                                                    @else
                                                        <li>{{$kriterij->utez}} <span class="col-md-6">{{ucfirst(strtolower($kriterij->Element->ime))}}:</span></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                             </div></div></div>
                        @endforeach
                    </div>
                @endforeach

            </div>

        </form>
    </div>
@endsection
