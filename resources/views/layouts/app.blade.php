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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/customApp.css') }}" type="text/css"  rel="stylesheet">

</head>
<body>
    <div id="app">
                <!--HEADER: La navegación -->
        <header class="main-header page-header">
            @include('include/pageHeader')
        </header>
                <!--FIN: Header -->

                <!--MAIN: El contenido -->

        <main class="main pb-4">
            @yield('tablas')
            
            <div class="container mb-8">
                <div>
                    <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden ashadow sm:rounded-lg">
                        @yield('content')
                        @yield('pasitos')
                        
                    </div>
                </div>
            </div>
        </main>
                <!--FIN: Main -->

                <!--FOOTER: Sin desarrollar)-->
        <footer>
        
            <div class="page-footer">
                @include('include/pageFooter')
            </div>
        </footer>

    </div>
    <!--FIN: App -->
        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>


{{-- <button onclick="clearInterval(myVar)">Stop time</button> --}}

<script>

</script>
</body>
</html>
