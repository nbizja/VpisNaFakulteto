<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <div class="panel-heading"><h3 style="color: #005580">Seznam študijskih programov</h3></div>
    <div class="panel-body">
        <table class="CSSTableGenerator" id="tblData">
            <thead>
            <tr style="background-color: #cccccc">
                @if ($sifra)
                    <th style="width:50px" class="sifra">Šifra</th>
                @endif
                @if ($zavod)
                    <th style="width:150px"  class="zavod">Fakulteta</th>
                @endif
                <th>Naziv</th>
                @if($nacin)
                    <th class="nacin">Način študija</th>
                @endif
                @if($vrsta)
                    <th class="vrsta">Vrsta vpisa</th>
                @endif
                @if($stevilo)
                    <th class="stevilo">Število vpisnih mest</th>
                @endif
                @if($steviloO)
                    <th class="stevilo_omejitev">Število vpisnih mest po omejitvi</th>
                @endif
                @if($steviloS)
                    <th class="stevilo_sprejetih">Število sprejetih kandidatov</th>
                @endif
                @if($omejitev)
                    <th class="omejitev">Omejitev vpisa</th>
                @endif
                @if($steviloT)
                    <th class="steviloT">Število vpisnih mest (tujci)</th>
                @endif
                @if($steviloOT)
                    <th class="stevilo_omejitevT">Število vpisnih mest po omejitvi(tujci)</th>
                @endif
                @if($steviloST)
                    <th class="stevilo_sprejetihT">Število sprejetih kandidatov (tujci)</th>
                @endif
                @if($omejitevT)
                    <th class="omejitevT">Omejitev vpisa (tujci)</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($programi as $program)
                <tr>
                    @if ($sifra)
                        <td class="sifra">{{$program->sifra}}</td>
                    @endif
                    @if ($zavod)
                        <td class="zavod">{{$program->visokosolskiZavod->ime}}</td>
                    @endif
                        <td>{{$program->ime}}</td>
                    @if($nacin)
                        <td class="nacin">{{$program->nacin_studija}}</td>
                    @endif
                    @if($vrsta)
                        <td class="vrsta">{{$program->vrsta}}</td>
                    @endif
                    @if($stevilo)
                        <td class="stevilo">{{$program->stevilo_vpisnih_mest}}</td>
                    @endif
                    @if($steviloO)
                        <td class="stevilo_omejitev" >{{$program->stevilo_mest_po_omejitvi}}</td>
                    @endif
                    @if($steviloS)
                        <td class="stevilo_sprejetih">{{$program->stevilo_sprejetih}}</td>
                    @endif
                    @if($omejitev)
                        <td class="omejitev">{{$program->omejitev_vpisa == 1 ? 'Da':'Ne'}}</td>
                    @endif
                    @if($steviloT)
                        <td class="steviloT">{{$program->stevilo_vpisnih_mest_tujci}}</td>
                    @endif
                    @if($steviloOT)
                        <td class="stevilo_omejitevT">{{$program->stevilo_mest_po_omejitvi_tujci}}</td>
                    @endif
                    @if($steviloST)
                        <td class="stevilo_sprejetihT">{{$program->stevilo_sprejetih_tujci}}</td>
                    @endif
                    @if($omejitevT)
                        <td class="omejitevT">{{$program->omejitev_vpisa_tujci == 1 ? 'Da':'Ne'}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>