<!doctype html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        h1, h2, h3, h4, h5, h6 {
            font-family:  DejaVu Sans;
        }
        p, td, div {
            font-family: DejaVu Sans;
        }

        body {
            width: 8.5in;
            margin: 0in .1875in;
            font-family: Arial;
            font-size: 80%;
        }
        .label{
            /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
            width: 1.8in; /* plus .6 inches from padding */
            height: 1.2in; /* plus .125 inches from padding */
            padding: .125in .3in 0;
            margin-right: .125in; /* the gutter */

            float: left;

            text-align: center;
            overflow: hidden;

            outline: 1px dotted; /* outline doesn't occupy space like border does */
        }
        .page-break2  {
            clear: left;
            display:block;
            page-break-after:always;
        }
    </style>

</head>

<body>
    <?php $i = 0; ?>
    <table>
    @foreach($prijave as $prijava)
        @if($i % 3 == 0)
            <tr>
        @endif
        <td class="label">{{$prijava->kandidat->ime.' '.$prijava->kandidat->priimek}}<br>
            {{$prijava->kandidat->naslovZaPosiljanje()->first()->naslov}}<br>
            {{$prijava->kandidat->naslovZaPosiljanje()->first()->posta->postna_stevilka.' '.$prijava->kandidat->naslovZaPosiljanje()->first()->posta->ime}}<br>
            {{$prijava->kandidat->naslovZaPosiljanje()->first()->drzava->ime}}
        </td>
            @if($i % 3 == 2)
                </tr>
            @endif
        <?php $i++; ?>
    @endforeach
    </table>
</body>
</html>