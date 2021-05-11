<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/customApp.css') }}" type="text/css"  rel="stylesheet">

        <style>
            body {
                height:100%;
                font-family: 'Nunito';
            }
            .botones{
                border:2px solid hsl(0, 0%, 75%);
                border-radius: 5px;
                padding: .4rem 1rem;font-variant: small-caps;
                text-align: center;
            }
            .botones:hover{
                background-color:#444444;
                color:#ffee00;
                transition: all,1s;
            }
            .max-w-6xl{
                max-width: {max-width:72rem};
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="grid justify-center items-center min-h-screen max-w-6xl mx-auto bg-gray-100">

            <div class="pt-8 grid justify-center items-end">
                <svg class="logoMenu mx-auto" width="156px" height="156px" viewBox="0 0 512 512">
                    @include('include.logoCircle')
                </svg>

                <div class="py-4 text-center font-semibold ">
                    <h2>my Klik-Class</h2>

                </div>
                
                @if (Route::has('login'))
                    @auth
                        <div class="text-center mb-4 h-12">
                            <a href="{{ url('/home') }}" class="d_block text-lg botones ">Home</a>
                        </div>
                    @else
                        <div class="text-center mt-2 mb-4 h-12">
                            
                            <a href="{{ route('login') }}" class="text-lg  botones">{{ __('Login') }}</a></div>
                
                            @if (Route::has('register'))
                                <div class="text-center h-12">
                                    <a href="{{ route('register') }}" class="text-lg botones ">{{ __('Register') }}</a>
                                </div>
                            @endif
                        </div>    
                    @endif
                @endif
            </div>
        </div>
    </body>
</html>
