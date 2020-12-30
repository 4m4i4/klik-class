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
        <div class = "grid grid-cols-3-fr items-center justify-center">
            @php
              $user = Auth::user();
            @endphp
          @if($user->paso == 2)
              <h2 class="ml-4">Añadir mis horarios</h2>
              <a href="{{route('sesions.index')}}" 
                  title="Poner las hora de comienzo y final de las sesiones" 
                  class="boton blue-reves mr-2">Poner horario
              </a>
              <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Ir a paso 3: horario completado" class="ml-2 btn  warning-reves"><span class="ico-shadow">✅</span> Siguiente </button>
              </form>
          @endif
          @if($user->paso == 3)
              <h2 class="ml-4">Añadir mis clases</h2>
              <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Ir a paso 2: Cambiar horas de inicio y final"  class="mx-2 btn blue-reves"><span class="ico-shadow"> 👈 </span> Atrás <span class="ico-shadow"> ⌚</span></button> 
              </form>
              <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Tabla de clases completada" class="ml-1 self-end btn warning-reves"><span class="ico-shadow">✅ </span> Siguiente <span class="ico-shadow">👉 </span>  </button>
              </form>
          @endif
          @if($user->paso == 4)
              <h2 class="ml-4">Horario de clases</h2>
              <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                    @csrf
                    @method("PUT")
                      <button type="submit" title= "Ir a paso 3: clases" class="ml-2 btn blue-reves"><span class="ico-shadow"> 👈 </span>Cambiar  <span class="ico-shadow"> ⌚</span> </button>
              </form>
              <a href="{{route('home')}}" 
                  title="a home" 
                  class="boton warning-reves mr-2">Volver  <span class="ico-shadow">👉 </span> 
              </a>
          @endif
        </div>   <!-- fin de grid -->
      </div>  <!-- fin de caja-header -->
      
    </div>       <!-- fin de CABECERA clases  -->

    <div class="caja">   <!-- body-TABLA clases -->
      <div class="caja-body py-2">
        <table class="tabla table-responsive mx-auto">
          <caption>Para <strong>Añadir</strong> una clase haz click en la celda correspondiente. <br>Para <strong>modificarla</strong> haz click sobre ella</caption>
            @php
              $dias = ['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];
              $count = count($dias);
              use App\Models\Sesion;
              use App\Models\Clase;
              $user = auth()->user()->id;
              // dd($user);
              $sesiones = Sesion::get();
              $num_sesiones = count($sesiones);
              // dd($num_sesiones);
              $clases = Clase::where('user_id',$user)
                              ->with('user','materia','aula','sesion')->get();
            @endphp
          <thead>  <!-- cabecera: DÍAS DE LA SEMANA -->
            <tr>
              @for ($i = 0; $i < $count; $i++)
                <th id={{$dias[$i]}}>
                  {{$dias[$i]}}
                </th>
              @endfor
            </tr>
          </thead>  <!-- fin de cabecera -->
          <tbody> <!-- filas: SESIONES -->

            @foreach ($sesiones as $sesion)
              <tr id={{$sesion->id}}>

                <th class="text-center">
                  {{date_format(date_create($sesion->inicio), "H:i")}}
                  <br>
                  {{date_format(date_create($sesion->fin), "H:i")}}
                </th>
                  @for ($ii = 1; $ii < $count; $ii++)
                    <td id={{$sesion->id}}{{$dias[$ii]}}>
                      @php
                        $estasesion = $sesion->id;
                        $estedia = $dias[$ii];
                        $clase = $clases->where('sesion_id',$sesion->id)
                          ->where('dia', $dias[$ii])
                          ->first();                          
                      @endphp

                        @if ($clase !== null)
                              @php
                                $id = $clase->id;
                                //  $clase = Clase::get();
                              @endphp
                          <a id="{{$estasesion}}_{{$estedia}}" href="{{ route('clases.edit', $clase) }}" title="Editar clase id={{ $clase->id }}" class="btn naranja mr-1">
                              @php
                                $registro = $clase->materia->materia_name;
                                $materiaName = Str::of($registro)->upper();
                                $materia_grupo= Str::of($materiaName)->explode(" ");
                                $materia_name=$materia_grupo[0];
                                $materia_name=Str::beforeLast($materia_grupo[0]," ");
                                $grupo=$materia_grupo[1]." ".$materia_grupo[2];
                              @endphp
                            <span class="text-sm">{{ $materia_name}}</span>
                          </a>
                          <span class="text-sm">{{$grupo}}</span>
                        @elseif($clase == null)
                          <button class="btn blue" id={{$dias[$ii].'_'.$sesion->id}} onclick="claseModal(this.id)">Añadir</button>
                        @endif

                    </td>
                  @endfor
                    
              </tr>
            @endforeach
          </tbody>
        </table>

          <div id="ver_modal" class="modal">
            <div class="modal-content animate-zoom">
              <div class= "text-center">
                {{-- <span onclick="document.getElementById('ver_modal').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span> --}}
                {{-- <div class= "text-center mb-4"> --}}
                  <svg width="358px" height="107px" viewBox="0 0 512 152">
                    <g id="form_top">
                      <rect id="fondo" fill="#363636" width="512" height="152"/>
                      <path id="mesa_az" fill="#00ABD6" d="M124 94l65 0 0 38 -65 0 0 -38zm184 0l64 0 0 38 -64 0 0 -38zm-92 0l65 0 0 38 -65 0 0 -38z"/>
                      <path id="mesa_tur" fill="#00F7FF" d="M216 28l65 0 0 38 -65 0 0 -38zm92 0l64 0 0 38 -64 0 0 -38z"/>
                      <path id="mesa_am" fill="#FFEE00" d="M400 28l64 0 0 38 -64 0 0 -38zm-276 0l65 0 0 38 -65 0 0 -38zm-91 66l64 0 0 38 -64 0 0 -38z"/>
                      <path id="flecha" fill="#FF0066" d="M168 52l51 30 -19 7 18 27c0,1 0,3 -1,4l-7 4c-1,1 -3,0 -4,-1l-17 -27 -15 15 -6 -59z"/>
                    </g>
                  </svg>
                {{-- </div> --}}
              </div>
              <div class="px-6 caja-header text-center">
                <h3>Introducir materia:<br><span id="ver_id"></span></h3>
              </div>
              <form class="px-6" method="POST" action="{{ route('clases.store') }}">
                @csrf 
                    <!--MO: recoge el valor de -136- claseModal(this.id) que llama a la modal-->
                  <div class="hidden grid grid-cols-3-auto">
                    <div class="d_inline w-5"><!-- $clase->user_id  -->
                      <label class="d_inline" for="user_id"></label>
                      <input type="text" name="user_id" value={{ auth()->user()->id }} readonly class="w-5" />
                    </div>
                    <div class="d_inline w-5"><!-- $clase->sesion_id (MO) -->
                      <label  class="d_inline" for="sesion_id"></label>
                      <input type="text" id="sesion_id" name="sesion_id" readonly class="w-5" value="{{ old('sesion_id') }}" >
                    </div>
                    <div class="d_inline w-5"><!-- $clase->dia (MO) -->
                      <label  class="d_inline" for="dia"></label>
                      <input type="text" id="dia" name="dia" readonly required class="w-5" value="{{ old('dia') }}" >
                    </div>
                  </div>
                  <div class=""><!-- $clase->materia_id -->
                      <label for="materia_id">Materia</label>
                      <select  class="d_block" name="materia_id" value="{{ old('materia_id') }}" id="materia_id">
                        <option value=0>"Selecciona la materia"</option>
                          @foreach ($materias as $materia)
                            <option value={{$materia->id}}>{{$materia->materia_name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="mt-4"><!-- $clase->aula_id -->
                      <label for="aula_id">Aula</label> 
                      {{-- <input type="text" class="d_block" name="aula_id" id="aula_id" value=""/> --}}
                      <select  class="d_block" name="aula_id" value="{{ old('aula_id') }}" id="aula_id" onchange="getSelected('aula_id')">
                        <option value=0>"Selecciona el aula"</option>
                          @foreach ($aulas as $aula)
                            <option value={{$aula->id}}>{{$aula->aula_name}}</option>
                          @endforeach
                      </select>
                  </div>
                
                  <div>
                      <button type="submit" class="boton mt-6 d_block blue">Guardar</button>
                  </div>
              </form>
              
              <div class="px-6 py-4 mt-6 light-grey">
                <button onclick="document.getElementById('ver_modal').style.display='none'" type="button" class=" boton danger">Cancel</button>
              </div>
            </div>  {{--  fin modal-content --}}
          </div> {{--  fin modal --}}

      </div>  {{--  fin caja-body --}}
      
    </div>        <!-- fin de body-TABLA clases -->
  </div>  <!-- fin de div -->
</div>  <!-- fin de container -->

<script>
              function claseModal(valor_id){
                let ar_id = valor_id.split('_');
                let dia_semana = ar_id[0];
                let num_sesion = ar_id[1];
                document.getElementById("ver_id").innerHTML = dia_semana+", sesión "+num_sesion ;
                document.getElementById("dia").value = dia_semana;
                document.getElementById("sesion_id").value = num_sesion;
                document.getElementById('ver_modal').style.display = 'block';
              }

              function sesionDia(valor_id){
                let ar_id = valor_id.split('_');
                let num_sesion = ar_id[0];
                let dia_semana = ar_id[1];
                document.getElementById("edit_dia").value = dia_semana;
                document.getElementById("edit_sesion_id").value = num_sesion;
              }
 
 
  function getSelected(xx){
    var x = document.getElementById(xx).value;
    // document.getElementById('aula_id').value =  x;
  }
</script>
@endsection