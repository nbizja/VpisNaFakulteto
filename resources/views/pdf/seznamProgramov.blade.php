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
                <th style="width:50px" class="sifra">Šifra</th>
                <th style="width:100px"  class="zavod">Fakulteta</th>
                <th>Naziv</th>
                <th class="nacin">Način študija</th>
                <th class="vrsta">Vrsta vpisa</th>
                <th class="stevilo" style="width: 100px">Število vpisnih mest</th>
                <th class="omejitev">Omejitev vpisa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($programi as $program)
                <tr>
                    <td class="sifra">{{$program->sifra}}</td>
                    <td class="zavod">{{$program->visokosolskiZavod->ime}}</td>
                    <td>{{$program->ime}}</td>
                    <td class="nacin">{{$program->nacin_studija}}</td>
                    <td class="vrsta">{{$program->vrsta}}</td>
                    <td class="stevilo">{{$program->stevilo_vpisnih_mest}}</td>
                    <td class="omejitev">{{$program->omejitev_vpisa == 1 ? 'Da':'Ne'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>