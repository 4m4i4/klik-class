
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
    {{-- <link href="{{ asset('css/estilo.css') }}" type="text/css"  rel="stylesheet">     --}}
    <style>
      :root {

        }
      </style>

</head>
<body onload="fFecha(6)">
    <div id="app">
                <!--HEADER: La navegación -->
        <header class="main-header clase-header items-center">
          
          <span class="bt-clase-header ml-2 f_left">{{$aula->aula_name}}</span>
          <button class="bt-clase-header f_left h-6 py-0 px-1 mx-2 warning">Poner mesas</button>
          <button class="bt-clase-header f_left blue" onclick="crearMesas( {{$aula->num_columnas}}, {{$aula->num_filas}})">Crear aula</button>
          <span class="bt-clase-header f_left reloj" id="khoraes"></span>   
          <span class=" bt-clase-header mr-2 f_right reloj" id="kdiaes"></span>
        </header>
                <!--FIN: Header -->
            @php
                use App\Models\Mesa;
                $mesas=Mesa::all();
                $sta=$mesas->where('aula_id',$aula->id)->first();
                if($sta==null)echo "estupendo";
                
                $estudiantes=$aula->clase->materia->estudiantes;
                $n_student=$estudiantes->count();
                $index=0;
            @endphp
      <div class="grid grid grid-cols-{{$aula->num_columnas}}-auto">
        @if($sta==null)
            @for ($i = 1; $i <= $aula->num_columnas; $i++)
              @for ($ii = 1; $ii <= $aula->num_filas; $ii++)
                
                  @php
                    $mesa = new Mesa;
                    $mesa->columna = $ii;
                    $mesa->fila = $i;
                    $mesa->is_ocupada = $index < $aula->num_mesas? true : false;
                    $mesa->aula_id = $aula->id;
                    $mesa->clase_id = $aula->clase->id;
                    $mesa->estudiante_id = $index < $n_student ? $estudiantes [$index]->id : null;
                    if($index < $aula->num_mesas) {
                      $mesa->save();
                    }
                    $index++;
                  @endphp
                <div class="mesa"></div>

              @endfor
            @endfor
          @endif    
          </div>
              <!--MAIN: El contenido -->
                {{-- <script>
function crearMesas(columnas, filas) {
let clase= document.getElementById("clase");
clase.setAttribute("class","grid grid-cols-"+columnas+"-auto");
  let index = 0;
  for (let i = 0; i < columnas; i++) {
    for (let ii = 0; ii < filas; ii++) {
      let mesa = document.createElement("DIV");
      mesa.setAttribute("class", "mesa mesa-"+columnas);
      let id = index + "";  // recoger el valor actual del index
      // atribuir identificador a cada elemento mesa
      mesa.setAttribute('id', id + "mesa");
      crearBoton(mesa, "A", index);
      crearBoton(mesa, "B", index);
      aula.appendChild(mesa);
      index++;
    }
  }
}
</script> --}}
        <main >
            
            <div class="bg-white dark:bg-gray-800">
                @yield('content')

                <div id="clase" class="container"></div>
                <div class="py-8">
                  <p class="text-center pb-4">
                    Cuantos estudiantes={{$n_student}}
                   otro:  {{$aula->clase->materia->estudiantes->count()}}
                   Columnas= {{$aula->num_columnas}}; 
                   Filas=  {{$aula->num_filas}}. 
                   Mesas= {{$aula->num_mesas}}
                   Clase_id: {{$aula->clase->id}}. 
                   Aula_id= {{$aula->id}}
                  {{-- Mesa: {{$mesas->$aula->id}} --}}
                   @php
                       $estudiantes=$aula->clase->materia->estudiantes;
                       $este=$estudiantes[0]->nombre;
                   @endphp
Este= {{$este}}
                   </p>

                   @foreach ($estudiantes as $estudiante)
                       <p>{{$estudiante->nombre}}</p>
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