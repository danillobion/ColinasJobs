
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Colinas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" media="screen" href="css/buttons.css"/>

    <!-- Fonts Google -->
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="buttons.css">



</head>
<body>
    <div id="app" style="position: absolute; width:100%;">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="position: absolute; width:100%;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Colinas Jobs
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @php
                                        $nome = explode(' ',Auth::user()->name);
                                        echo($nome[0]);
                                    @endphp
                                     <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(!is_null( Auth::user()->candidato))
                                        <a class="dropdown-item" href="{{ route('abrir_painel_curriculum') }}">
                                            <div class="btn-group">
                                                <div style="padding-left: 2%"><img src="icon/curriculum.png" alt="curriculum" width="17px" height="20px"></div>
                                                <div style="margin-left:6px; margin-top:3px;">{{ __('Meu Currículo') }}</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('listarMeuInteresse') }}">
                                            <div class="btn-group">
                                                <div style="padding-left: 2%"></div>
                                                <div style="margin-left:6px; margin-top:3px;">{{ __('Tenho Interesse') }}</div>
                                            </div>
                                        </a>
                                    <hr>
                                    @elseif(!is_null( Auth::user()->empresa))
                                        <a class="dropdown-item" href="{{ route('vaga') }}">
                                            <div class="btn-group">
                                                <div style="margin-left:6px; margin-top:3px;">{{ __('Criar Vaga') }}</div>
                                            </div>
                                        </a>
                                    <hr>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
