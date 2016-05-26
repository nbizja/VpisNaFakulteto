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

    <h4 style="color: #005580">Kandidat</h4>
    <label class="col-md-4 control-label">Kandidat: {{$kandidat->ime.' '.$kandidat->priimek}}</label> <br>
    <label class="col-md-4 control-label">EMŠO: {{$kandidat->emso}}</label><br>
    @if ($matura != null)

        <h4 style="color: #005580">Podatku o zaključku srednje šole</h4>

        <label class="col-md-4 control-label">Tip mature: {{$tipMature == 0 ? "Splošna matura" : "Poklicna matura"}}</label><br>
        <label class="col-md-4 control-label">Poklic: {{$matura->poklic->ime}}</label><br>
        <label class="col-md-4 control-label">Opravljena matura: {{$matura->opravil == 0 ? "Ne" : "Da"}}</label><br>

        <h4 style="color: #005580">Uspeh 3. in 4. letnika srednje šole</h4>

        <label class="col-md-4 control-label">3.letnik: {{$matura->ocena_3_letnik}}</label><br>
        <label class="col-md-4 control-label">4.letnik: {{$matura->ocena_4_letnik}}</label><br>
        <label class="col-md-4 control-label">Število točk na maturi: {{$matura->ocena}}</label><br>

        <h4 style="color: #005580">Maturitetni predmeti</h4>
            <table class="table table-hover">
                <tr>
                    <th>Šifra predmeta</th>
                    <th>Predmet</th>
                    <th>Ocena (3.letnik)</th>
                    <th>Ocena (4.letnik)</th>
                    <th>Ocena (matura)</th>
                </tr>
                @foreach($predmeti as $predmet)
                    <tr>
                        <td>{{$predmet->predmet->id}}</td>
                        <td>{{$predmet->predmet->ime}}</td>
                        <td>{{$predmet->ocena_3_letnik}}</td>
                        <td>{{$predmet->ocena_4_letnik}}</td>
                        <td>{{$predmet->ocena}}</td>
                    </tr>
                @endforeach
            </table>
    @else
        <h4 style="color: #005580">Podatku o zaključku srednje šole</h4>
        Podatki o zaključku še niso vnešeni.
    @endif

    <br><br>
    @foreach($prijave as $prijava)

        <h4 style="color: #005580">{{$prijava->zelja}}. želja</h4>

        <label class="col-md-4 control-label">Visokošolski zavod: {{$prijava->studijskiProgram->visokosolskiZavod->ime}}</label><br>
        <label class="col-md-4 control-label">Študijski program: {{$prijava->studijskiProgram->ime.' ('.$prijava->studijskiProgram->nacin_studija.')'}}</label><br>
        <label class="col-md-4 control-label">Kandidat ustreza pogojem: {{$rezultat[$prijava->zelja-1] == 0 ? 'Ne' : 'Da'}}</label><br>
        <label class="col-md-4 control-label">Število točk: {{$tocke[$prijava->zelja-1] == 0 ? '/' : $tocke[$prijava->zelja-1]}}</label><br><br>
    @endforeach
</div>
</body>
</html>