{{-- clases.index --}}
@extends('layouts.app')

@section('tablas')
      <!-- Información de los cambios que se han producido en el sistema al enviar el formulario-->
<div class="container">
  @if(session()->get('info'))
    <div class = "alert alert-info text-center">
      {{ session()->get('info') }}  
    </div>
  @endif

  <div class = "">

    <div class="caja">  <!-- CABECERA clases -->
      <div class = "caja-header">
        <div class = "grid grid-cols-3-fr items-center w-100">
            @php
              $user = Auth::user();
            @endphp
          @if($user->paso == 2){{--   NO ocurre nunca --}}
              <h2 class="title">Añadir mis horarios</h2>
              <a href="{{route('sesions.index')}}" 
                  title="Poner las horas de comienzo y final de las sesiones" 
                  class="boton blue-reves mr-1">Poner horario
              </a>
              <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit"
                      title="Horario completado: Empezar a poner clases"
                      class="ml-1 btn continuar">
                      <span class="ico-shadow">✅ </span>
                      <span class="bt-text-hide">{{ __('Next')}}</span>
                      <span class="ico-shadow">👉 </span>
                    </button>
              </form>
          @endif
          @if($user->paso == 3)
              <h2 class="title">Añadir mis Clases</h2>
              <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" 
                      title="Ir a cambiar horas de inicio y final" 
                      class="ml-1 btn atras">
                      <span class="ico-shadow"> 👈 </span> {{__('Previous')}}
                      <span class="ico-shadow"> ⌚ </span>
                    </button> 
              </form>
              <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" 
                      title= "Tabla de clases completada"
                      class="ml-1 btn continuar">
                      <span class="ico-shadow">✅ </span> 
                      <span class="bt-text-hide">{{ __('Next')}}</span>
                      <span class="ico-shadow">👉 </span>
                    </button>
              </form>
          @endif
          @if($user->paso >= 4)
              <h2 class="title">Horario de clases</h2>
              <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                @csrf
                @method("PUT")
                  <button type="submit" 
                    title="Ir a cambiar horarios" 
                    class="ml-1 btn atras">
                    <span class="ico-shadow"> 👈 </span>Atrás
                    <span class="ico-shadow"> ⌚</span> 
                  </button>
              </form>
              <a href="{{route('home')}}" 
                title="a home" 
                class="ml-1 btn continuar">
                <span class="ico-shadow">✅ </span> 
                <span class="bt-text-hide">{{ __('Next')}}</span>
                <span class="ico-shadow">👉 </span>
              </a>
          @endif
        </div>   <!-- fin de grid -->
      </div>  <!-- fin de caja-header -->
    </div>       <!-- fin de CABECERA clases  -->

    <div class="caja">   <!-- body-TABLA clases -->
      <div class="caja-body">
        
        <table id="tabla-config-horario" class="tabla table-responsive mx-auto">
          <caption>Para <strong>Añadir</strong> una clase haz click en su celda. <br>Para <strong>modificarla</strong> haz click sobre ella.<br>Cuando tengas todas las clases pulsa <strong>Continuar</strong>.</caption>
            @php
              $user = auth()->user()->id;
              $dias = ['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];
              $num_dias = count($dias);
              use App\Models\Sesion;
              $sesiones = Sesion::where('user_id',$user)->get();
              // dd($sesiones);
              $num_sesiones = count($sesiones);
              use App\Models\Clase;
              $clases = Clase::where('user_id',$user)
                              ->with('user','materia','sesion')->get();
            @endphp
          <thead>  <!-- pintar PRIMERA FILA -cabecera: array dias-->
            <tr>
              @for($i = 0; $i < $num_dias; $i++)
                <th id={{$dias[$i]}}>{{substr($dias[$i],0,3)}}
                </th>
              @endfor
            </tr>
          </thead>
          <tbody><!-- pintar RESTO DE FILAS -->
            @for ($fila = 0; $fila < $num_sesiones; $fila++)
              <tr id={{$sesiones[$fila]->id}}>
                @for ($col = 0; $col < $num_dias; $col++)
                  @if ($col == 0)  <!-- PRIMERA COLUMNA: HORARIO (sesiones de inicio y final)-->
                    <th class="text-center">
                      {{date_format(date_create($sesiones[$fila]->inicio), "H:i")}}
                        <br>
                      {{date_format(date_create($sesiones[$fila]->fin), "H:i")}}
                    </th>
                  @endif
                  @if ($col > 0)  <!-- RESTO DE COLUMNAS: CLASES (materia y aula) por día de la semana-->
                    <td id ={{$fila + 1}}{{$dias[$col]}} class="">
                      @php
                        $estasesion = $sesiones[$fila]->id;  // obtener el número de sesión (su id)
                        $estedia = $dias[$col];  // obtener el día de la semana
                        // consulta $clase: obtener el valor para este user, esta sesión y este día
                        $clase = $clases->where('user_id',$user)->where('sesion_id', $estasesion)
                          ->where('dia', $estedia)
                          ->first();                          
                      @endphp
                        <!-- Si $clase tiene UN VALOR, se enlaza el formulario para EDITAR la clase -->
                        @if ($clase !== null)
                          <a href="{{ route('clases.edit', $clase) }}"
                            id="{{$estasesion}}_{{$estedia}}"
                            class="d_block editar flex-column justify-center items-center"
                            title="Editar clase {{ $clase->materia->grupo }}">
                            {{$clase->materia->grupo}}<br>
                            <small>{{ Str::before($clase->materia->materia_name," ") }}</small>
                          </a>
                          <!-- Si $clase es NULL, se enlaza el formulario para CREAR la clase -->
                        @elseif($clase == null)
                          <button id = {{$estedia.'_'.$estasesion.'_'.$fila}}
                            onclick="claseModal(this.id)"
                            title="Añadir clase"
                            class="d_block flex-column justify-center items-center  crear">{{__('Add')}}
                          </button>
                        @endif
                    </td>
                  @endif
                @endfor
              </tr>
            @endfor

          </tbody>

        </table>
          @include('include.claseModal')


      </div>  {{--  fin caja-body --}}
      
    </div>        <!-- fin de body-TABLA clases -->
    <div class="h-8"></div>
  </div>  <!-- fin de div -->
</div>  <!-- fin de container -->

<script>
  function claseModal(valor_id){
    let ar_id = valor_id.split('_');
    let dia_semana = ar_id[0];
    let id_sesion = ar_id[1];   // id de sesión
    let hora_sesion = ar_id[2]; // nº de sesión para mostrar en el formulario
    hora_sesion = parseInt(hora_sesion)+1;
    document.getElementById("ver_id").innerHTML = dia_semana+", sesión "+hora_sesion;
    document.getElementById("dia").value = dia_semana;
    document.getElementById("sesion_id").value = id_sesion;
    document.getElementById('ver_modal').style.display = 'block';
  }
  // no se usa
  function getSelected(xx){
    var x = document.getElementById(xx).value;
  }
</script>
@endsection