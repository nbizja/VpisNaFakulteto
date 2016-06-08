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

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($kandidati as $kandidat)
                @if(!$kandidat->prijave->isEmpty())
                    <h3>Sklep o uvrstitvi na študijske programe</h3>
                    <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                        <caption style="text-align:left; height:30px;background-color: #F5F5F5;border-bottom: solid 1px; padding-left:10px;"><strong>Osebni podatki</strong></caption>

                        <tr>
                            <td  style="padding-left: 10px;width:25%;">Ime: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $kandidat->ime }}</td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 10px;width:25%;">Priimek: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $kandidat->priimek }}</td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 10px;width:25%">Emšo: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $kandidat->emso }}</td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 10px;width:25%;">Datum rojstva: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ date('d.m.Y', strtotime($kandidat->osebniPodatki->first()->datum_rojstva)) }}</td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 10px;width:25%;">Država rojstva: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $kandidat->osebniPodatki->first()->drzavaRojstva->ime }}</td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 10px;width:25%;">Kraj rojstva: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $kandidat->osebniPodatki->first()->kraj_rojstva }}</td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 10px;width:25%;">Državljanstvo: </td><td style="padding-left: 10px;background-color: #cccccc;">{{ $kandidat->osebniPodatki->first()->drzavljanstvo->ime }}</td>
                        </tr>
                    </table>
                    <p>
                    </p>
                    <br><br>
                    <?php foreach($kandidat->prijave as $prijava){ ?>
                        <table class="CSSTableGenerator" id="tblData" style="width:100%;">
                            <caption style="text-align:left; height:30px;background-color: #F5F5F5;border-bottom: solid 1px; padding-left:10px;"><strong>{{$prijava->zelja.'. želja'}}</strong></caption>
                            <tr>
                                <td  style="padding-left: 10px;width:25%;">Visokošolski zavod: </td><td style="padding-left: 10px;background-color: #cccccc;">{{$prijava->studijskiProgram->visokosolskiZavod->ime}}</td>
                            </tr>
                            <tr>
                                <td  style="padding-left: 10px;width:25%;">Študijski program: </td><td style="padding-left: 10px;background-color: #cccccc;">{{$prijava->studijskiProgram->ime.', '.$prijava->studijskiProgram->nacin_studija}}</td>
                            </tr>
                            <tr>
                                <td  style="padding-left: 10px;width:25%">Sprejet: </td><td style="padding-left: 10px;background-color: #cccccc;">{{$prijava->sprejet == '1' ? 'Da' : 'Ne'}}</td>
                            </tr>
                            <tr>
                                <td  style="padding-left: 10px;width:25%">Število točk: </td><td style="padding-left: 10px;background-color: #cccccc;">{{$prijava->tocke}}</td>
                            </tr>
                            <tr>
                                <td  style="padding-left: 10px;width:25%">Uvrstitev: </td><td style="padding-left: 10px;background-color: #cccccc;"></td>
                            </tr>
                            @if($kandidat->osebniPodatki->first()->id_drzavljanstva != 2)
                                <tr>
                                    <td  style="padding-left: 10px;width:25%;">Meja za sprejem: </td><td style="padding-left: 10px;background-color: #cccccc;">{{$prijava->studijskiProgram->omejitev_vpisa_tujci}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td  style="padding-left: 10px;width:25%;">Meja za sprejem: </td><td style="padding-left: 10px;background-color: #cccccc;">{{$prijava->studijskiProgram->omejitev_vpisa}}</td>
                                </tr>
                            @endif

                        </table>
                        @if($prijava->sprejet == '1')
                            <?php break; ?>
                        @endif
                        <p>
                        </p>
                    <?php } ?>
                    <div class="page-break"></div>
                @endif
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
<style>
    .page-break {
        page-break-after: always;
    }
</style>