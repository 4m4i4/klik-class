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
        
            <div class="page-footer">
                @php 
                    $meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];                
                    $h= now(); 
                    $date = date_create("$h");
                    $ddia = date_format($date, "d");
                    $dmes = $meses[date_format($date, "n")];
                    $danio = date_format($date, "Y");
                    $fecha =  $ddia." de ". $dmes. " de ".$danio;
                    $diaMes=  $ddia." de ". $dmes;
                    $laHora = date_format($date, "H:i");
                @endphp
              {{-- {{hora($h)}} <a href= "#"> {{fecha($h)}}</a> --}}
              {{$laHora}} ...  <a href= "#"> {{$diaMes}}</a> ...   PASO. @if(auth()->user()!==null) {{auth()->user()->paso}} )@endif
            </div>
        </footer>

    </div>
    <!--FIN: App -->
        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>
</html>
