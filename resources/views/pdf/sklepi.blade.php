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

    @foreach($kandidati as $kandidat)
        @if(!$kandidat->prijave->isEmpty())
            <h4 style="color: #005580">Kandidat</h4>
            <label class="col-md-4 control-label">Kandidat: {{$kandidat->ime.' '.$kandidat->priimek}}</label> <br>
            <label class="col-md-4 control-label">EMŠO: {{$kandidat->emso}}</label><br>

            <?php foreach($kandidat->prijave as $prijava){ ?>
                <label class="col-md-4 control-label">Želja: {{$prijava->zelja.'.'}}</label> <br>
                <label class="col-md-4 control-label">Visokošolski zavod: {{$prijava->studijskiProgram->visokosolskiZavod->ime}}</label> <br>
                <label class="col-md-4 control-label">Študijski program: {{$prijava->studijskiProgram->ime.', '.$prijava->studijskiProgram->nacin_studija}}</label> <br>
                <label class="col-md-4 control-label">Sprejet: {{$prijava->sprejet == '1' ? 'Da' : 'Ne'}}</label> <br>
                @if($prijava->sprejet == '1')
                    <?php break; ?>
                @endif
            <?php } ?>
        @endif
    @endforeach

</div>
</body>
</html>