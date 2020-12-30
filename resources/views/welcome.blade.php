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

        {{-- <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}
            body{margin:0}
            a{background-color:transparent}
            [hidden]{display:none}
            html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}
            *,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}
            a{color:inherit;text-decoration:inherit}
            svg,video{display:block;vertical-align:middle}
            video{max-width:100%;height:auto}
            .bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}
            .bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}
            .border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}

            /*  */
            .botones{
                border:2px solid hsl(0, 0%, 75%);  border-radius: 5px
            }
            .botones:hover{
                background-color:#6e6e6e;
                color:#fff;
                transition: all,1s;
            }
            .border-t{border-top-width:1px}
            .flex{display:flex}
            .grid{display:grid}
            .hidden{display:none}
            .items-center{align-items:center}
            .justify-center{justify-content:center}
            .justify-between{justify-content:space-between}
            .items-start{align-items:start}
            .items-end{align-items:end}
            .font-semibold{font-weight:600}
            .h-5{height:1.25rem}
            .h-8{height:2rem}
            .h-16{height:4rem}
            .text-sm{font-size:.875rem}
            .text-lg{font-size:1.125rem}
            .text-xl{font-size:2rem}
            .leading-7{line-height:1.75rem}
            .mx-auto{margin-left:auto;margin-right:auto}
            .m-1{margin:.25rem}
            .ml-1{margin-left:.25rem}
            .mt-2{margin-top:.5rem}
            .mr-2{margin-right:.5rem}
            .ml-2{margin-left:.5rem}
            .mt-4{margin-top:1rem}
            .my-4{margin-top:1rem;margin-bottom:1rem}
            .ml-4{margin-left:1rem}
            .m-4{margin:1rem}
            .mt-8{margin-top:2rem}
            .ml-12{margin-left:3rem}
            .-mt-px{margin-top:-1px}
            .max-w-6xl{max-width:72rem}
            .min-h-screen{min-height:100vh}
            .overflow-hidden{overflow:hidden}
            .p-6{padding:1.5rem}
            .py-2{padding-top:.25rem;padding-bottom:.25rem}
            .py-4{padding-top:1rem;padding-bottom:1rem}
            .px-4{padding-left:1rem;padding-right:1rem}
            .px-6{padding-left:1.5rem;padding-right:1.5rem}
            .pt-8{padding-top:2rem}
            .pt-16{padding-top:4rem}
            .fixed{position:fixed}
            .relative{position:relative}
            .top-0{top:0}
            .right-0{right:0}
            .shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}
            .text-center{text-align:center}
            .text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}
            .text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}
            .text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}
            .text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}
            .text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}
            .text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}
            .text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}
            .underline{text-decoration:underline}
            .antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
            .w-5{width:1.25rem}
            .w-8{width:2rem}
            .w-auto{width:auto}
            .d_inline{display:inline}
            .block{display:block}
            .circle {border-radius:50%}
            @media (min-width:640px){
                .sm\:rounded-lg{border-radius:.5rem}
                .sm\:block{display:block}
                .sm\:items-center{align-items:center}
                .sm\:justify-start{justify-content:flex-start}
                .sm\:justify-between{justify-content:space-between}
                .sm\:h-20{height:5rem}
                .sm\:ml-0{margin-left:0}
                .sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}
                .sm\:pt-0{padding-top:0}
                .sm\:text-left{text-align:left}
                .sm\:text-right{text-align:right}
                }
            @media (min-width:768px){
                .md\:border-t-0{border-top-width:0}
                .md\:border-l{border-left-width:1px}
                .md\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}
                }
            @media (min-width:1024px){
                .lg\:px-8{padding-left:2rem;padding-right:2rem}
                }
            @media (prefers-color-scheme:dark){
                .dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}
                .dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}
                .dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}
                .dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}
                .dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}


        </style> --}}

        <style>
            body {
                font-family: 'Nunito';
            }
            .botones{
                border:2px solid hsl(0, 0%, 75%);
                border-radius: 5px;
                padding: .4rem;
                margin-top: 1rem;
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
        <div class="grid justify-center items-center min-h-screen max-w-6xl mx-auto bg-gray-100 dark:bg-gray-900 ">

            <div class="pt-8 grid justify-center items-end">
                <svg class="logoMenu mx-auto" width="128px" height="128px" viewBox="0 0 512 512">
                    <g id="circleLogo">
                        <path id="mesa3" fill="#00DFE7" d="M507 208l-77 0 0 -140c39,36 67,85 77,140z"/>
                        <path id="fondo" fill="#363636" d="M256 0c67,0 128,26 174,68l0 140 77 0c3,15 5,31 5,48 0,24 -3,48 -10,70l-72 0 0 89 -72 -113 78 -29 -123 -73 0 -155 -203 0c42,-28 92,-45 146,-45zm174 444c-46,42 -107,68 -174,68 -38,0 -75,-8 -107,-24l164 0 0 -153 70 111c3,5 11,7 16,3l28 -18c1,-1 2,-2 3,-3l0 16zm-388 -48c-27,-40 -42,-88 -42,-140 0,-52 15,-100 42,-140l0 92 188 0 11 118 -199 0 0 70z"/>
                        <path id="mesa2" fill="#00ABD6" d="M42 326l199 0 6 69 64 -62 2 2 0 154 -164 0c-44,-21 -81,-53 -107,-93l0 -70z"/>
                        <path id="mesa1" fill="#FFEE00" d="M110 45l203 0 0 155 -89 -52 6 60 -188 0 0 -92c18,-28 41,-52 68,-71z"/>
                        <path id="mesa4" fill="#00ABD6" d="M430 326l72 0c-13,46 -38,86 -72,118l0 -16c2,-4 3,-9 0,-13l0 0 0 -89z"/>
                        <path id="flecha" fill="#FF0066" d="M224 148l212 125 -78 29 72 113c3,6 2,13 -3,16l-28 18c-5,4 -13,2 -16,-3l-72 -113 -64 62 -23 -247z"/>
                    </g>
                </svg>

                <div class="py-4 text-center font-semibold "><h2>Klik-Class</h2></div>
                
                @if (Route::has('login'))
                    @auth
                        <div>
                            <a href="{{ url('/home') }}" class="d_block text-lg botones ">Home</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('login') }}" class="d_block text-lg botones">{{ __('Login') }}</a>
                
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="d_block text-lg botones ">{{ __('Register') }}</a>
                            @endif
                        </div>    
                    @endif
                @endif
            </div>
        </div>
    </body>
</html>
