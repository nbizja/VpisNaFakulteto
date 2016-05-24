<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vpis na fakulteto</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Vpis v visoko šolstvo
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/prijava') }}">Prijava</a></li>
                        <li><a href="{{ url('/registracija') }}">Registracija</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->ime . ' ' . Auth::user()->priimek . ' (' . Auth::user()->prikazVloge() . ')' }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/geslo') }}"><i class="fa fa-btn fa-sign-out"></i>Sprememba gesla</a></li>
                                <li><a href="{{ url('/odjava') }}"><i class="fa fa-btn fa-sign-out"></i>Odjava</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                @if (Auth::check())
                    <p class="navbar-text navbar-right">Zadnja prijava: {{ date('d. m. Y H:i:s', strtotime(Auth::user()->zadnja_prijava)) }}</p>
                @endif

            </div>

            @if (Auth::check())
                @if (Auth::user()->vloga == 'skrbnik')
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{ action('HomeController@index') }}">Domov</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Študijski programi<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ action('StudijskiProgrami\StudijskiProgramiController@urediPrograme') }}">Uredi študijski program</a></li>
                                    <li><a href="{{ action('StudijskiProgrami\StudijskiProgramiController@novProgram') }}">Dodaj nov študijski program</a></li>
                                    <li><a href="{{ action('StudijskiProgrami\SeznamController@seznamProgramov') }}">Seznam študijskih programov</a></li>
                                    <li><a href="{{ action('StudijskiProgrami\StudijskiProgramiController@izpisPodatkov') }}">Podatki o študijskih programih</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="{{ action('SifrantiController@index')}}">Vzdrževanje šifrantov</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Matura<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ action('Matura\MaturaController@uvoziPodatke') }}">Uvoz podatkov o maturi</a></li>
                                    <li><a href="{{ action('Matura\PoklicnaMaturaController@uvoziPodatke') }}">Uvoz podatkov o poklicni maturi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endif
                @if (Auth::user()->vloga == 'admin')
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Domov</a></li>
                            <li class=""><a href="{{ action('AddEmployeeController@loadPage')}}">Ustvari račun za zaposlene</a></li>
                        </ul>
                    </div>
                @endif
            @endif


        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
</body>
</html>
