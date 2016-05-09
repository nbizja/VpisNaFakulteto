@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Urejanje vpisnih pogojev</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/vpisniPogoji/urediPogoj') }}">
            <div class="panel-group">
                {!! csrf_field() !!}

                <div class="panel panel-default">
                    <div class="panel-heading">Študijski program</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fakulteta: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="vzdrzevanjePogojev_fakultete">
                                    <option selected value="">Izberite visokošolski zavod.</option>
                                    @foreach($fakultete as $fakulteta)
                                        <option value="{{$fakulteta->id}}">{{$fakulteta->ime}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Študijski program: </label>
                            <div class="col-md-6">
                                <select name="program" class="form-control" id="vzdrzevanjePogojev_programi">
                                    <option selected data-fakulteta="-1" value="">Izberite program izbranega visokošolskega zavoda.</option>
                                    @foreach($programi as $program)
                                        <option data-vpisniPogoji="{{ $program->vpisniPogoji }}" data-fakulteta="{{ $program->id_zavoda }}"
                                                value="{{$program->id}}" style="display:none">{{$program->ime}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="vpisni_pogoji" style="display: none">

                @foreach($programi as $program)
                    <?php $i = 0; ?>
                    @foreach($program->VpisniPogoji as $pogoj)
                        <?php $i++; ?>
                        <div class="panel panel-default vpisni_pogoj program_{{ $program->id }}" style="display: none;">
                            <div class="panel-heading" >
                                {{$i}}. vpisni pogoj: 
                            </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <ul>
                                            @if ($pogoj->splosna_matura == 1)
                                                <li>Splošna matura</li>
                                            @elseif($pogoj->poklicna_matura == 1)
                                                <li>Poklicna matura</li>
                                            @endif
                                            @if ($pogoj->id_elementa != null)
                                                <li>{{ ucfirst(strtolower($pogoj->Element->ime)) }}</li>
                                            @endif
                                            @if ($pogoj->id_elementa2 != null)
                                                <li>{{ ucfirst(strtolower($pogoj->Element2->ime)) }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" name="uredi{{$pogoj->id}}" class="btn btn-primary pull-right">
                                                <i class="fa fa-btn fa-sign-in"></i>Uredi
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" name="brisi{{$pogoj->id}}" class="btn btn-primary pull-right">
                                                <i class="fa fa-btn fa-sign-in"></i>Izbriši ta pogoj
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" name="dodajPogoj" class="btn btn-primary pull-right">
                        <i class="fa fa-btn fa-sign-in"></i>Dodaj pogoj
                    </button>
                </div>
            </div>

            @include('flash_message')
        </form>
    </div>
@endsection
