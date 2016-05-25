@extends('layouts.app')

@section('content')
    <br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Iskanje po kandidatih</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="{{action('ListOfCandidatesController@findCandidates')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Emšo, ime ali priimek kandidata</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="podatki" value="{{ $niz }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" name="isci" value="isci" class="btn btn-primary">
                                    Išči
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="padding: 5%">
    @if(!empty($kandidati))
        <table class="table table-hover">
            <tr>
                <th>  </th>
                <th>Emšo</th>
                <th>Priimek in ime</th>
                <th></th>
            </tr>
            @foreach($kandidati as $kandidat)
                <tr>
                    <td> {{$kandidat->emso}}  </td>
                    <td> {{$kandidat->priimek}} {{$kandidat->ime}} </td>
                    <td>
                        <form action="{{ action('ListOfCandidatesController@urediPodatke') }}">
                            <button type="submit" name="uredi{{$kandidat->id}}" class="btn btn-primary pull-right">
                                Popravi podatke o uspehu
                            </button>
                        </form>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ url('/ustrezanjePogojem/'.$kandidat->id) }}">Preveri vpisne pogoje</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
    <script>
        var tables = document.getElementsByTagName('table');
        var table = tables[tables.length - 1];
        var rows = table.rows;
        for(var i = 1, td; i < rows.length; i++){
            td = document.createElement('td');
            td.appendChild(document.createTextNode(i));
            rows[i].insertBefore(td, rows[i].firstChild);
        }
    </script>
</div>

@endsection