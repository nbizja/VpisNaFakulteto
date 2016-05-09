@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Podatki o študijskem programu</h4>
        <form class="form-horizontal" role="form" method="POST" action="{{ action('StudijskiProgrami\StudijskiProgramiController@izvozPodatkov') }}">
            <div class="panel-group">
                {!! csrf_field() !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Študijski program</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fakulteta: </label>
                            <div class="col-md-6">
                                <select name="fakulteta" class="form-control" id="izpisProgramov_fakultete">
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
                                <select name="program" class="form-control" id="izpisProgramov_programi">
                                    <option selected data-fakulteta="-1" value="">Izberite program izbranega visokošolskega zavoda.</option>
                                    @foreach($programi as $program)
                                    <option data-fakulteta="{{ $program->id_zavoda }}"
                                            data-mesta="{{ $program->stevilo_vpisnih_mest }}" 
                                            data-mesta_omejitev="{{ $program->stevilo_mest_po_omejitvi }}"
                                            data-omejitev="{{$program->omejitev_vpisa}}" 
                                            data-nacin="{{$program->nacin_studija}}" 
                                            data-vrsta="{{$program->vrsta}}" 
                                            value="{{$program->id}}" style="display:none">{{$program->ime}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Informacije o vpisu</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število razpisanih vpisnih mest: </label>
                            <div class="col-md-6">
                                <input name="st_mest_razpis" id="stevilo_vpisnih_mest" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Omejitev vpisa: </label>
                            <div class="col-md-6">
                                <input name="omejitev" class="form-control" id="omejitev" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Število mest po omejitvi vpisa: </label>
                            <div class="col-md-6">
                                <input name="st_mest_omejitev" id="stevilo_mest_omejitev" class="form-control" readonly>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Splošne informacije</div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Način študija: </label>
                            <div class="col-md-6">
                                <input name="nacin" id="nacin_studija" class="form-control" readonly>
							</div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Vrsta študija: </label>
                            <div class="col-md-6">
                                <input name="vrsta" id="vrsta_studija" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
			</div>	
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button id="gumbIzvozi" type="submit" name="izvozi" class="btn btn-primary pull-right" disabled="disabled">
						<i class="fa fa-btn fa-download"></i>Izvozi
					</button>
				</div>
			</div>
		</form>
    </div>
@endsection
