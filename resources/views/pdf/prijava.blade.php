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

        .caption {
            text-align:left;
            height:30px;
            background-color: #F5F5F5;
            border-bottom: solid 1px;
        }
    </style>
</head>

<body style="font-family: Arial ">

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                <tr>
                    <td style="width:70%">Visokošolska prijavno-informacijska služba, <br>
                        Univerza v Ljubljani, p.p. 524, 1001 LJUBLJANA</td>
                    <td style="width:30%">Prijava oddana dne: {{ date('d.m.Y', strtotime($uporabnik->datum_oddaje_prijave)) }}</td>
                </tr>
            </table>
            <p>
            </p>

            <p><strong>Prijavni rok: </strong> Prvi prijavni rok </p>
            <p><strong>Številka prijave:</strong> {{ $uporabnik->id }}</p>

            <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                <caption style="text-align:left; height:30px;background-color: #F5F5F5;border-bottom: solid 1px; padding-left:10px;"><strong>Osebni podatki</strong></caption>

                <tr>
                    <td  style="padding-left: 10px;width:25%;">Ime: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->ime }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%;">Priimek: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->priimek }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Emšo: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->emso }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Spol: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->spol == 5 ? 'Ž' : 'M' }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%;">Datum rojstva: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ date('d.m.Y', strtotime($osebniPodatki->datum_rojstva)) }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%;">Država rojstva: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->drzavaRojstva->ime }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%;">Kraj rojstva: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->kraj_rojstva }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%;">Državljanstvo: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $osebniPodatki->drzavljanstvo->ime }}</td>
                </tr>
            </table>

            <br>
            <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                <caption style="text-align:left; height:30px;background-color: #F5F5F5;border-bottom: solid 1px; padding-left:10px;"><strong>Stalno prebivališče</strong></caption>

                <tr>
                    <td  style="padding-left: 10px;width:25%">Država: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $stalnoPrebivalisce->drzava->ime }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Naslov: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $stalnoPrebivalisce->naslov }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Pošta: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $stalnoPrebivalisce->posta->postna_stevilka . ' - ' . $stalnoPrebivalisce->posta->ime }}</td>
                </tr>
            </table>
            <br>

            <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                <caption style="text-align:left; height:30px;background-color: #F5F5F5;border-bottom: solid 1px; padding-left:10px;"><strong>Naslov za pošiljanje</strong></caption>

                <tr>
                    <td  style="padding-left: 10px;width:25%">Država: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $naslovZaPosiljanje->drzava->ime }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Naslov: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $naslovZaPosiljanje->naslov }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Pošta: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $naslovZaPosiljanje->posta->postna_stevilka . ' - ' . $stalnoPrebivalisce->posta->ime }}</td>
                </tr>
            </table>
            <br>

            <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                <caption style="text-align:left; height:30px;background-color: #F5F5F5;border-bottom: solid 1px; padding-left:10px;"><strong>Dosedanja izobrazba</strong></caption>

                <tr>
                    <td  style="padding-left: 10px;width:25%">Spričevalo že imam: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $srednjesolskaIzobrazba->ima_spricevalo ? 'Da' : 'Ne' }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Način zakljuka srednje šole: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $srednjesolskaIzobrazba->nacinZakljucka->ime }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Država srednje šole: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $srednjesolskaIzobrazba->drzava->ime }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Ime srednje šole: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $srednjesolskaIzobrazba->drzava->ime == 'SLOVENIJA' ? $srednjesolskaIzobrazba->srednjaSola->ime : $srednjesolskaIzobrazba->ime_srednje_sole }}</td>
                </tr>
                <tr>
                    <td  style="padding-left: 10px;width:25%">Datum izdaje spričevala: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ date('d.m.Y', strtotime($srednjesolskaIzobrazba->datum_izdaje_spricevala)) }}</td>
                </tr>
                @if($srednjesolskaIzobrazba->id_maturitetnega_predmeta > 0 )
                    <tr>
                        <td  style="padding-left: 10px;width:25%">Maturitetni predmet: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $srednjesolskaIzobrazba->maturitetniPredmet->ime }}</td>
                    </tr>
                @endif

            </table>
            <br>
            <br>
            <br>

            <table class="table" style="width:100%;">
                <caption class="caption"><strong>Izbrani študijski programi</strong></caption>
                <tr><th>Želja</th><th>Zavod</th><th>Program</th><th>Način</th></tr>
                @foreach($prijave as $prijava)
                    <tr>
                        <td>{{ $prijava->zelja }}.</td>
                        <td>{{ $prijava->studijskiProgram->visokosolskiZavod->ime }}</td>
                        <td>{{ $prijava->studijskiProgram->ime }}</td>
                        <td>{{ $prijava->studijskiProgram->nacin_studija }}</td>
                    </tr>
                @endforeach
            </table>

            <br>
            <br>
            <br>

            <table class="CSSTableGenerator" id="tblData" style="width:100%;border-collapse: collapse;">
                <tr>
                    <td style="width:15%;border: solid 1px;padding-left: 10px;">Datum: </td><td style="width:35%;border: solid 1px;padding-left: 10px;">{{ date('d.m.Y', strtotime($uporabnik->datum_oddaje_prijave)) }}</td>
                    <td style="width:15%;border: solid 1px;padding-left: 10px;">Podpis: </td><td style="width:35%;border: solid 1px;padding-left: 10px;"></td>
                </tr>
            </table>

        </div>
    </div>
</div>
</body>
</html>