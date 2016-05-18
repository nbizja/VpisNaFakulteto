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
    <div class="panel-heading"><h4 style="color: #444444">Seznam prijavljenih kandidatov</h4></div>
    <div class="panel-body">
        <table class="table table-hover" style="width:100%; font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd; border-collapse: collapse; color: #444444">
            <tr style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #aaaaaa;  background-color: #dddddd;">
                <th  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd; background-color: #dddddd;">  </th>
                <th  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;">Ime</th>
                <th  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;">Zaključek</th>
                <th  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;">Zavod</th>
                <th  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;">Program</th>
                <th  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;">Način</th>
            </tr>
            @foreach($kandidati as $kandidat)
                <tr>
                    <td  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;"> {{$kandidat->st}} </td>
                    <td  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;"> {{$kandidat->priimek}} {{$kandidat->ime}}</td>
                    <td  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;"> {{$kandidat->srednja}}  </td>
                    <td  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;"> {{$kandidat->zavod}} </td>
                    <td  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;"> {{$kandidat->program}} </td>
                    <td  style="font-size: 12px; float: left; text-align: left; border: 0.01em solid #dddddd;"> {{$kandidat->nacin}} </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>