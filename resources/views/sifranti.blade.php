@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Seznam šifrantov</div>
                        <div class="panel-body">
                            <div class="table">
                                <table class="table table-hover table-condensed">
                                    <tr>

                                    @foreach($columns as $column)
                                        <th>{{$column}}</th>
                                    @endforeach

                                    </tr>

                                    @foreach($items as $row)
                                    <tr>

                                        @foreach($columns as $column)
                                        <td>{{$row[$column]}}</td>
                                        @endforeach

                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
