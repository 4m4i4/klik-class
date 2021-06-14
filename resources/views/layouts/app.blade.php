<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/customApp.css') }}" type="text/css"  rel="stylesheet">

</head>
<body onload="screenResize()" onresize="screenResize()">
    <div id="app">
                <!--HEADER: La navegación -->
        @if (str_contains(url()->current(), 'etapaUso'))
            <header class="clase-header items-center">
                @include('include/etapaUsoHeader')
            </header>  
        @else
            <header class="main-header page-header">
                @include('include/pageHeader')
            </header>                     
        @endif

                <!--FIN: Header -->

                <!--MAIN: El contenido -->
        @yield('etapaUso')
        <main class="main">
            @yield('tablas')
            
            <div class="container mb-8 sm:px-0 sm:mx-0">
                <div>
                    <div class="mt-4 bg-white ashadow sm:rounded-lg">
                        @yield('content')
                        @yield('pasos')
                    </div>
                </div>
            </div>
        </main>
                <!--FIN: Main -->

                <!--FOOTER)-->

        @if (!str_contains(url()->current(), 'etapaUso'))
           
            <footer class="footer">
                <div class="page-footer">
                    @include('include/pageFooter')
                </div>
            </footer>   
        @else
            <div class="noFooter"></div> 
            <script>
                var ahora = document.getElementById('khora');
            </script>          
        @endif
    </div>

    @yield('script')
    <!--FIN: App -->
        <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" type="text/js"></script> --}}
    {{-- <script src="{{ asset('js/custom.js') }}" type="text/js"></script> --}}


</body>
</html>
