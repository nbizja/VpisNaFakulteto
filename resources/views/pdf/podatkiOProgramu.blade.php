<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>E-študij FRI</title>

    <script src="{{ asset('js/jquery-te-1.4.0.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-family:  DejaVu Sans;
        }
        p, div {
            font-family: DejaVu Sans;
        }
    </style>
</head>

<body style="font-family: Arial ">
<div class="panel panel-default">
    <div class="panel-heading"><h3 style="color: #005580">Podatki o študijskem programu</h3></div>
    <div class="panel-body">
	
	<h4 style="color: #005580">Študijski program</h4>
	<dl class="dl-horizontal">
		<dt>Fakulteta:</dt>
		<dd><?php echo $fakulteta ?></dd>
		
		<dt>Študijski program:</dt>
		<dd><?php echo $program ?></dd>
	</dl>
	
	<h4 style="color: #005580">Informacije o vpisu</h4>
	<dl class="dl-horizontal">
		<dt>Število razpisanih vpisnih mest:</dt>
		<dd><?php echo $st_mest_razpis ?></dd>
		
		<dt>Omejitev vpisa:</dt>
		<dd><?php echo $omejitev ?></dd>
		
		<dt>Število mest po omejitvi vpisa:</dt>
		<dd><?php echo $st_mest_omejitev ?></dd>

		<dt>Število sprejetih kandidatov:</dt>
		<dd>{{$p->stevilo_sprejetih}}</dd>
	</dl>
	<h4 style="color: #005580">Informacije o vpisu za tujce in Slovence brez slovenskega državljanstva</h4>
	<dl class="dl-horizontal">
		<dt>Število razpisanih vpisnih mest:</dt>
		<dd>{{$p->stevilo_vpisnih_mest_tujci}}</dd>

		<dt>Omejitev vpisa:</dt>
		<dd>{{$p->omejitev_vpisa_tujci > 0 ? 'Da' : 'Ne'}}</dd>

		<dt>Število mest po omejitvi vpisa:</dt>
		<dd>{{$p->stevilo_mest_po_omejitvi_tujci}}</dd>

		<dt>Število sprejetih kandidatov:</dt>
		<dd>{{$p->stevilo_sprejetih_tujci}}</dd>
	</dl>
	
	<h4 style="color: #005580">Splošne informacije</h4>
	<dl class="dl-horizontal">	
		<dt>Način študija:</dt>
		<dd><?php echo $nacin ?></dd>
		
		<dt>Vrsta študija:</dt>
		<dd><?php echo $vrsta ?></dd>
	</dl>

	<h4 style="color: #005580">Vpisni pogoji</h4>
	<dl class="dl-horizontal">
		<?php $i = 0; ?>
		@foreach($p->VpisniPogoji as $pogoj)
			<?php $i++; ?>
			<div class="panel panel-default vpisni_pogoj program_{{ $p->id }}">
				<div style="color: #005580" class="panel-heading" >
					{{$i}}. vpisni pogoj:
				</div>
				<div class="panel-body">
					<div class="col-md-4">
						<ul>
							@if ($pogoj->splosna_matura == 1)
								<li>Splošna matura</li>
							@elseif($pogoj->poklicna_matura == 1)
								<li>Poklicna matura</li>
							@elseif($pogoj->id_poklica != null)
								<li>Poklic: {{$pogoj->Poklic->ime}}</li>
							@endif
							@if ($pogoj->id_elementa != null)
								<li>{{ ucfirst(strtolower($pogoj->Element->ime)) }}</li>
							@endif
							@if ($pogoj->id_elementa2 != null)
								<li>{{ ucfirst(strtolower($pogoj->Element2->ime)) }}</li>
							@endif
						</ul>

						@if(count($pogoj->Kriterij) > 0)
								<label>Kriterij za izračun točk:</label>
								<ul>
									@foreach($pogoj->Kriterij as $kriterij)
										@if($kriterij->id_elementa == null)
											@if($kriterij->maturitetni_uspeh == 1)
												<li>Uspeh na maturi: {{$kriterij->utez}}</li>
											@elseif($kriterij->ocene_34_letnika == 1 && $kriterij->utez > 0)
												<li>Uspeh v 3. in 4. letniku: {{$kriterij->utez}}</li>
											@endif
										@else
											<li> {{ucfirst(strtolower($kriterij->Element->ime))}}: {{$kriterij->utez}}</li>
										@endif
									@endforeach
								</ul>
						@endif
					</div>
				</div>
				<br>
			</div>
		@endforeach
	</dl>
	
    </div>
</div>

</body>
</html> 