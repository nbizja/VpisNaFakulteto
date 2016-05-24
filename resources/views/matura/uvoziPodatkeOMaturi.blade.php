@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Uvoz podatkov o maturi</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
						{{ Form::open(array('action' => 'Matura\MaturaController@naloziDatoteko', 'files' => true)) }}
                        
							@if (count($errors) > 0)
								<div class="alert alert-danger">
									<ul>
									@foreach ($errors->all() as $e)
										<li>{{ $e }}</li>
									@endforeach
									</ul>
								</div>
							@endif	
							
							<div class="form-group">
								<label for="datotekaMaturant">Datoteka maturant.txt</label>
								{{ Form::file('datotekaMaturant') }}
								<p class="help-block">Izberite datoteko s podatki o kandidatu in o splošnem uspehu.</p>
							</div>
							
							<div class="form-group">
								<label for="datotekaMaturantPre">Datoteka maturpre.txt</label>
								{{ Form::file('datotekaMaturPre') }}
								<p class="help-block">Izberite datoteko s podatki o uspehu pri posameznih predmetih.</p>
							</div>
							
							<div class="form-group">
								{{ Form::submit('Uvozi podatke', array('class' => 'btn btn-primary pull-right')) }}
							</div>
							
							@include('flash_message')
							@if (Session::has('flash_message'))
								{{ Session::get('flash_message') }}
							@endif
							
						{{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

