
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
<body class="bg-white" onload="fFecha(6)">
    <div id="app">
                <!--HEADER: La navegación -->
      <header class="main-header clase-header items-center">
        <div class="flex flex-row items-center"> 
          <a href="/home" title= "home">
            <svg class="mx-2 mt-1 d_inline f_left" width="32px" height="32px" viewBox="0 0 128 128">
             <g id="logo_quad_128">
              <path id="fondo" fill="#363636" d="M0 0l128 0 0 128 -128 0 0 -128zm108 12l20 0 0 40 -20 0 0 -40zm-28 38l30 17 -19 7 17 28 0 -22 20 0 0 40 -20 0 0 -15c0,0 0,1 -1,1l-6 4c-2,1 -4,1 -4,-1l-17 -27 0 38 -66 0 0 -40 48 0 -3 -28 -45 0 0 -40 66 0 0 38z"/>
              <path id="mesa1" fill="#FFEE00" d="M14 12l66 0 0 38 -22 -13 1 15 -45 0 0 -40z"/>
              <path id="mesa2" fill="#00AACC" d="M14 80l48 0 2 17 15 -15 1 1 0 37 -66 0 0 -40z"/>
              <path id="mesa3" fill="#00EEEE" d="M108 12l20 0 0 40 -20 0 0 -40z"/>
              <path id="mesa4" fill="#00AACC" d="M108 80l20 0 0 40 -20 0 0 -15c1,-1 1,-2 0,-3l0 0 0 -22z"/>
              <path id="flecha" fill="#FF0066" d="M58 37l52 30 -19 7 17 28c1,1 0,3 -1,4l-6 4c-2,1 -4,1 -4,-1l-18 -27 -15 15 -6 -60z"/>
             </g>
            </svg>
          </a>
          <span class="bt-clase-header f_left ml-2 primary-reves">{{$aula->aula_name}}</span>
          <a href="{{route("mesas.index")}}" class="bt-clase-header f_left px-1 mx-2 editar">Mesas</a>
          {{-- <button class="bt-clase-header f_left blue" onclick="crearMesas( {{$aula->num_columnas}}, {{$aula->num_filas}})">Crear aula</button> --}}
          <span id="khora" class="bt-clase-header f_left primary-reves reloj"></span>   
          <span id="kdiaes" class="bt-clase-header f_right oscuro-reves reloj mr-2  text-overflow"></span>
          <a href="{{ url()->previous()}}" class="bt-clase-header f_left px-1 mx-2 atras">Atrás</a>
        </div> 
      </header>
                <!--FIN: Header -->
        @php
          use App\Models\Estudiante;
          use App\Models\Mesa;
          $mesas=Mesa::all();
          $aula_name=$aula->aula_name;
          $n_col=$aula->num_columnas;
          $n_fila=$aula->num_filas;
          // dd($n_col.' , '.$n_fila);
          $user=auth()->user()->id;
          $aula_hasMesas=$mesas->where('aula_id',$aula->id)->first();
            if($aula_hasMesas==null)echo "Si no hay mesas en el aula las añadimos";
              use App\Models\Materia;
              $materia=Materia::where('user_id',$user)->where('grupo',$aula->aula_name)->first();
                // $num_materias=$materia->count();
              $index=0;
              $estudiantes=$materia->estudiantes;
              $n_student=$estudiantes->count();
        @endphp

      

        <main >
            
          <div class="bg-white">
              @yield('content')
            <div class="grid grid-cols-{{$n_col}}">
              @if($aula_hasMesas==null)
                @for ($i =$n_fila;  $i>0; $i--) 
                {{-- @for ($i = 0; $i<$n_fila; $i++)  --}}
                {{-- @for ($i = 1; $i <= $aula->num_columnas; $i++) --}}
                   @for ($ii = 1; $ii <= $n_col; $ii++)
                    @php
                      $mesa = new Mesa;
                      $mesa->columna = $ii;
                      $mesa->fila = $i;
                      $mesa->is_ocupada = $index<($n_student) ? true : false;
                      $mesa->aula_id = $aula->id;
                      $mesa->clase_id = $aula->clase->id;
                      $mesa->estudiante_id = $index < $n_student ? $estudiantes [$index]->id : null;
                      if($index < $aula->num_mesas) {
                        $mesa->save();
                        $mesa->refresh();
                      }
                      $index++;
                    @endphp
                  @endfor
                @endfor
              @endif
              {{-- @for ($i = $aula->num_columnas; $i >= 0; $i--)
                @for ($ii = 1; $ii <= $aula->num_filas; $ii++) --}}
                  
                     @php
                      // $estaMesa=Mesa::where('aula_id',$aula->id)->where('columna',$ii)->where('fila',$i)->first();
                      // if($estaMesa->estudiante==null){
                      //   "0";
                      //   "vacío";
                      // }
                      $estaMesa=Mesa::where('aula_id',$aula->id)->get();
                    @endphp
                    {{-- <div class="mesa" id=>
                    <button class="bt_mesa propiedad_A">A</button>
                    <button class="bt_mesa propiedad_B f_right">B</button>
                      fila={{$estaMesa->fila}} | col= {{$estaMesa->columna}} | id= {{$estaMesa->id}} 

                      @if(!$estaMesa->estudiante==null){{$estaMesa->estudiante->nombre}} | id={{ $estaMesa->estudiante_id}}
                      @endif
                  </div>
                @endfor
              @endfor --}}
            </div>
            <div id="clase" class="container"></div>
              <div class="py-8">
                <p class="text-center pb-4">
                  {{-- Cuantos estudiantes={{$n_student}}
                  otro:  {{$aula->clase->materia->estudiantes->count()}}
                  Columnas= {{$n_col}}; 
                  Filas=  {{$n_fila}}. 
                  Mesas= {{$aula->num_mesas}}
                  Clase_id: {{$aula->clase->id}}. 
                  Aula_id= {{$aula->id}} --}}
                  {{-- Mesa: {{$aula->mesas[3]}} --}}
                  @php
                    $estudiantes=$aula->clase->materia->estudiantes;
                      // $nombreEstudiante=$estudiantes[0]->nombre;
                    $contador=0;
                  @endphp
                  {{-- nombre= {{$nombreEstudiante}} --}}
                </p>
              </div>
              <div class="grid grid-cols-{{$n_col}}">
              @foreach ($estudiantes as $estudiante)
                <div class="mesa text-center" id="{{$estaMesa[$contador]->id}}">
                  <div>
                    <button id="bt_A"{{$estaMesa[$contador]->id}} class="bt_mesa propiedad_A" title="bt_A{{$estaMesa[$contador]->id}}">A</button>
                    <button id="bt_B"{{$estaMesa[$contador]->id}} class="bt_mesa propiedad_B f_right" title="bt_B{{$estaMesa[$contador]->id}}">B</button>
                  </div>
                  
                  <div class="nombre_mesa">
                   {{$contador}}. {{ Str::limit($estudiante->nombre,9) }} <br>
                  </div>
                  <span> col= {{$estaMesa[$contador]->columna}} | fila={{$estaMesa[$contador]->fila}}</span>
                 
                  @php
                  $contador++
                  @endphp
                </div>
              @endforeach
            </div>

          </div>
              

        </main>
                <!--FIN: Main -->

                <!--FOOTER: Sin desarrollar)-->
        {{-- <footer>{{$aula->clase->materia->materia_name}} 
        

        </footer> --}}

    </div>



    <!--FIN: App -->
        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>



<script>

      var aula = document.getElementById("clase");
   

</script>
</body>
</html>