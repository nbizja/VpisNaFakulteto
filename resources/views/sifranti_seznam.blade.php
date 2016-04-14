@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Seznam šifrantov</div>
                        <div class="panel-body">
                            <div class="seznam-sifrantov">
                                <table class="table table-hover table-condensed">    

                                @foreach($seznam_sifrantov as $id => $title)
                                    <tr><td><a href="{{$sifranti_url}}/{{$id}}">{{$title}}</a></td></tr>
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
