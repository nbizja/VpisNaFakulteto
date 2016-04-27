@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Naslov za obveščanje</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('vpis') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Država: </label>
                                <div class="col-md-6">
                                    <input type="radio" name="tip" value="stalno">Isti kot stalno prebivališče
                                    <input type="radio" name="tip" value="drugo">Drugo
                                </div>
                            </div>
                            <div class="obrazec">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Država: </label>
                                    <div class="col-md-6">
                                        <select name="drzava">
                                            @foreach($drzave as $drzava)
                                                <option value="{{ $drzava->id }}">{{ $drzava->ime }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Naslov: </label>
                                    <div class="col-md-6">
                                        <input type="text" name="naslov" value="{{ $naslov or old('naslov') }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Občina: </label>
                                    <div class="col-md-6">
                                        <select name="obcina">
                                            @foreach($obcine as $obcina)
                                                <option value="{{ $obcine->id }}">{{ $obcine->ime }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Pošta: </label>
                                    <div class="col-md-6">
                                        <select name="posta">
                                            @foreach($poste as $posta)
                                                <option value="{{ $posta->postna_stevilka }}">{{ $posta->postna_stevilka . ' '. $posta->ime }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection