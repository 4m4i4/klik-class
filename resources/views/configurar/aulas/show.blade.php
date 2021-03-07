
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
<body class="bg-white">
                <!--APP -->
  <div id="app">
                <!--HEADER -->
    <header class="main-header clase-header items-center">
      <div class="flex flex-row items-center"> 
        <a href="/home" title= "home">
          <svg class="mx-2  d_inline f_left" width="32px" height="32px" viewBox="0 0 128 128">
            @include("include.logoQuad")
          </svg>
        </a>
        <span class="bt-clase-header f_left ml-2 primary-reves">{{$aula->aula_name}}</span>
        <a href="{{route("mesas.index")}}" class="bt-clase-header f_left px-1 mx-2 editar">Mesas</a>
        <span id="khora" class="bt-clase-header f_left primary-reves reloj"></span>   
        <span id="kdiaes" class="bt-clase-header f_right oscuro-reves reloj mr-2  text-overflow"></span>
        <a href="{{ url()->previous()}}" class="bt-clase-header f_left px-1 mx-2 atras">Atrás</a>
      </div> 
    </header>
                <!--FIN: Header -->
      @php
        use App\Models\Estudiante;
        use App\Models\Mesa;
        use App\Models\Materia;
        use Illuminate\Support\Arr;          
        $mesas = Mesa::all();
        $n_col = $aula->num_columnas;
        $n_fila = $aula->num_filas;
        $user = auth()->user()->id;
        $aula_hasMesas = $mesas->where('aula_id',$aula->id)->first();
        $materia = Materia::where('user_id', $user)->where('grupo', $aula->aula_name)->first();
        $index = 0;
        $mesasIndex = [];
        $studentIndex=[];
        $estudiantes = $materia->estudiantes;
        // dd($estudiantes);
        $n_student = $estudiantes->count();

        $contador = 0;
            
      @endphp
                <!--MAIN  -->
    <main >
            
      <div class="bg-white">
          @yield('content')
        <div class="grid grid-cols-{{$n_col}}">
          @if($aula_hasMesas == null) Si no hay mesas en el aula las añadimos
            @for ($i = $n_fila;  $i > 0; $i--) 
              @for ($ii = 1; $ii <= $n_col; $ii++)
                @php
                  $mesa = new Mesa;
                  $mesa->columna = $ii;
                  $mesa->fila = $i;
                  $mesa->aula_id = $aula->id;
                  $mesa->clase_id = $aula->clase->id;
                  $mesa->is_ocupada = true;
                  if($index < $aula->num_mesas) {
                    $mesa->save();
                    $mesa->refresh();
                  }
                  $mesasIndex[$index] = $index;
                  $index++;
                @endphp
              @endfor
            @endfor


            @php
              // for ($i = 0; $i < $n_student; $i++) { 
              //   $studentIndex[$i] = $i;
              // }
              // $randomList = Arr::shuffle($studentIndex);
              //   dd($randomList);
              $n_mesas = $aula->num_mesas;
              $dif = $n_mesas - $n_student;
              $estaMesa = Mesa::where('aula_id',$aula->id)->get();
              $firstMesa = $estaMesa[0]->id;
              $lastMesa = $firstMesa + $estaMesa->count();   
              // si hay mesas vacías
              if($dif > 0){
                $mesasIndex = Arr::shuffle($mesasIndex);
                $vacias = Arr::random($mesasIndex, $dif);
                // dd($mesasIndex);
                for ($ii = 0; $ii < count($vacias); $ii++){
                  $indice = $vacias[$ii] + $firstMesa;
                  // asignar null a estudiante_id en las mesas vacías 
                  DB::table('mesas')->where('id',$indice)->update(['is_ocupada'=>false]);
                }  
              }
            
              // dd($firstMesa);
              // dd($mesas);
              // dd($lastMesa);
              // Sentar estudiantes
                for($i = $firstMesa; $i < $lastMesa; $i++){
                  $mesa_id = Mesa::find($i);

                  if($mesa_id->is_ocupada == true  && $contador < $estudiantes->count()){
                    $mesa_id->is_ocupada = true;
                    $mesa_id->estudiante_id = $estudiantes[$contador]->id;
                    $mesa_id->save();
                    $mesa_id->refresh();
                    $contador++;
                  } 
                } 


            @endphp
          @endif
        </div>
              
        <div class="grid grid-cols-{{$n_col}}">
          @foreach ($mesas->where('aula_id', $aula->id) as $mesa)
            <div id={{$mesa->id}} class="mesa text-center" title="mesa_{{$mesa->id}}">
              @if($mesa->is_ocupada == true)
                <div>       
                  <button id="A_bt_{{$mesa->id}}" class="bt_mesa propiedad_A bg-yellow" title="A_bt_{{$mesa->id}}" onclick="this.classList.add('active')">A</button>
                  <button id="B_bt_{{$mesa->id}}" class="bt_mesa propiedad_B bg-sky f_right" title="B_bt_{{$mesa->id}}" onclick="suma(B_bt_{{$mesa->id}},10)">0</button>
                </div>
                <div class="nombre_mesa">
                  <button id="name_{{$mesa->id}}" class="nombre_mesa d_block py-0" title=" id: {{$mesa->estudiante->id}}" onclick= "desabilita({{$mesa->id}})">{{$mesa->estudiante->nombre}} {{Str::limit($mesa->estudiante->apellidos, 1)}}</button>
                </div> 
              @else
                <div>       
                  <button id="A_bt_{{$mesa->id}}" class="bt_mesa propiedad_A " disabled title="A_bt_{{$mesa->id}}"></button>
                  <button id="B_bt_{{$mesa->id}}" class="bt_mesa propiedad_B f_right" disabled title="B_bt_{{$mesa->id}}"></button>
                </div>
                <div class="nombre_mesa" disabled>
                    <button class="nombre_mesa d_block py-0"  title=" disabled: {{$mesa->id}}" disabled>-- --</button>
                </div>
              @endif
            </div>    
          @endforeach


          {{-- @for($i = $firstMesa; $i < $lastMesa; $i++)

            <div class="mesa text-center" title="mesa_{{$i}}">
              <div>       
                <button id="bt_A_{{$i}}" class="bt_mesa propiedad_A" title="bt_A_{{$i}}">A</button>
                <button id="bt_B_{{$i}}" class="bt_mesa propiedad_B f_right" title="bt_B_{{$i}}">B</button>
              </div>
              <div class="nombre_mesa">
                @if($mesas[$i]->is_ocupada == true)  --}}
                
                  {{-- @if($contador < $estudiantes->count()) --}}
                    {{-- @php
                      // $item=$studentIndex[$contador]
                      // $item = $contador
                      $item = $randomList[$contador]
                    @endphp

                    {{$contador}}.  --}}
                    {{-- escribir los nombres de estudiantes--}}
                    {{-- {{ Str::limit($estudiantes[$item]->nombre,9) }} {{ Str::limit($estudiantes[$item]->apellidos,1) }} - id{{$estudiantes[$item]->id}}
                      @php
                        DB::table('mesas')->where('id',$i)->update(['is_ocupada'=>true,'estudiante_id'=>$estudiantes[$item]->id]) ;
                         $contador++;
                      @endphp
                @else
                   ---.
                   @php
                       $contador--;
                   @endphp
                @endif
              </div>
            </div>              
          @endfor --}}

                  {{-- leer los nombres desde la tabla mesas --}}
                    {{-- <strong>{{$mesas[$i -1]->estudiante->nombre}}</strong> {{Str::limit($mesas[$i -1]->estudiante->apellidos, 1)}} id: {{$mesas[$i -1]->estudiante->id}} --}}


        </div>
      </div>
    </main>
                <!--FIN: Main -->
  </div>
                <!--FIN: App -->

    <!-- Scripts -->

  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  <script src="{{ asset('js/custom.js') }}" type="text/js"></script>

</body>
</html>