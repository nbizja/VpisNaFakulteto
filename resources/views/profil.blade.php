@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Menjava gesla</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/geslo/ponastavi') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Trenutno geslo</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="old-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Novo geslo</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="new-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Potrdi geslo</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password-confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-refresh"></i>Ponastavi geslo
                                    </button>
                                </div>
                            </div>
                            @if (!empty(session('errors')))
                                <div class="alert alert-danger">
                                    @foreach (array_unique(session('errors')) as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif

                            @if (!empty(session('success')))
                                <div class="alert alert-success">
                                    Geslo je bilo spremenjeno
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
