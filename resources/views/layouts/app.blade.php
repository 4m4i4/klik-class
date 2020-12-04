<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/appCopy.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/customApp.css') }}" type="text/css"  rel="stylesheet">

</head>
<body>
    <div id="app">
                <!--HEADER: La navegación -->
        <header class="page-header">
            @include('include/pageHeader')
        </header>
                <!--FIN: Header -->

                <!--MAIN: El contenido -->

        <main class="py-4">
            @yield('content')
            @yield('pasitos')
        </main>
                <!--FIN: Main -->

                <!--FOOTER: Sin desarrollar)-->
        <footer>
            {{-- @php

                function fecha($fecha){
                    $date = date_create("$fecha");
                    $meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                    $dia = date_format($date, "d");
                    $mes = $meses[date_format($date, "n")];
                    $anio = date_format($date, "Y");
                    return $dia." de ". $mes. " de ".$anio;
                }
                function hora($hora){
                    $date = date_create("$hora");
                    $laHora = date_format($date, "H:i");
                    return $laHora;
                }
            @endphp --}}
            <div class="page-footer">
                @php 
                    $meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];                
                    $h= now(); 
                    $date = date_create("$h");
                    $ddia = date_format($date, "d");
                    $dmes = $meses[date_format($date, "n")];
                    $danio = date_format($date, "Y");
                    $fecha =  $ddia." de ". $dmes. " de ".$danio;
                    $laHora = date_format($date, "H:i");
                @endphp
              {{-- {{hora($h)}} <a href= "#"> {{fecha($h)}}</a> --}}
              {{$laHora}}  <a href= "#"> {{$fecha}}</a>
            </div>
        </footer>

    </div>
        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>
</html>
