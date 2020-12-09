@extends('layouts.app')

@section('content')

<div class="container">
  <div class = "col-sm-12 text-center">
    @if(session()->get('info'))
      <div class = "alert alert-info">
        {{ session()->get('info') }}  
      </div>
    @endif
  </div>
  <div class = "row">

    <div class = "col-sm-12">
      <div class = "caja">
        <div class = "caja-header grid grid-cols-2 justify-between items-center">
          <h2>Mi horario de Clases </h2>
            @php $user = auth()->user(); @endphp
          <form action="{{ route('paso', $user->id) }}" method="POST" class="grid grid-cols-2">
            @csrf
            @method('PUT')
              @if($user->paso == 2)
                <a href="{{route('sesions.index')}}" class="boton warning-reves mr-2">Cambiar horario</a>
                <button type="submit" name="paso" title="Ir a paso 3: horario completado" id="paso3" value=3 class="boton secondary-reves ml-2">✅ ¡He acabado! </button>
              @elseif($user->paso == 3)
                <button type="submit" name="paso" title="Ir a paso 2:cambiar horario" id="paso2" value=2 class="boton secondary-reves mr-2">Al paso 2 👈 ! </button>
                <a href="{{route('home')}}" class="ml-2 boton warning-reves">👉 Al paso 3</a>
              @endif
          </form>
        </div>
      </div>
        <div class="caja-body py-4">
          <table class="tabla table-responsive-sm">
            <caption>Introducir el horario y las sesiones(Materia, grupo y aula)</caption>
              @php
                $dias=['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];
                $count=count($dias);
                use App\Models\Sesion;
                use App\Models\Clase;
                $sesiones = Sesion::get();
                $clases = Clase::get();
              @endphp
              <thead>
                <tr>
                  @for ($i = 0; $i < $count; $i++)
                    <th id={{$dias[$i]}}> {{$dias[$i]}}</th>
                  @endfor
                </tr>
              </thead>
              <tbody>
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
                            $b_clase=$clases->where('sesion_id',$sesion->id)
                              ->where('dia', $dias[$ii])
                              ->first();                          
                          @endphp

                          @if ($b_clase !== null)
                            <a href="{{ route('clases.edit', $b_clase->id) }}" title="Editar clase id={{ $b_clase->id }}" class="btn naranja small mr-2">
                            @php
                               $registro=$b_clase->materia->materia_name;
                               $mat_name= Str::of($registro)->upper();
                               $m_arr= Str::of($mat_name)->explode(" ");
                               $m_name=$m_arr[0];
                               $m_name=Str::beforeLast($m_arr[0]," ");
                               $m_grupo=$m_arr[1]." ".$m_arr[2];
                            @endphp
                            <span class="text-sm">{{ $m_name}}</span>

                            </a> <span class="text-sm">{{$m_grupo}}</span>
                          @elseif($b_clase == null)
                            <button class="btn" id={{$dias[$ii].'_'.$sesion->id}} onclick="claseModal(this.id)">set</button>
                          @endif

                        </td>
                      @endfor
                    
                  </tr>
                @endforeach
              </tbody>
          </table>

          <script>

   
           </script>
        

          <div id="ver_modal" class="modal">
             
            <div class="modal-content animate-zoom" style="max-width:320px">
              <div class= "center py-4">
                <span onclick="document.getElementById('ver_modal').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
                <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-6">
              </div>
              <div class="px-6 my-6 caja-header text-center">
                <h3>
                  <strong>Introducir materia: <span id="ver_id"></span></strong>
                </h3>
              </div>
              <form class="px-6" method="POST" action="{{ route('clases.store') }}">
                @csrf 
                  <div class="">
                    
                    <div class="my-4 grid grid-cols-2 justify-between">
                      <div class="mr-2">
                        <label for="sesion_id">
                          <b>Sesión</b>
                        </label>
                        <input type="text" id="sesion_id" name="sesion_id" readonly class="d_block" >
                      </div>
                      <div class="ml-2">
                        <label for="dia">
                          <b>Día</b>
                        </label>
                        <input type="text" id="dia" name="dia" readonly required class="d_block">
                      </div>
                    </div>
                    <div class="grid grid-cols-1 justify-between">
                      <div class="py-2">{{-- materia_name --}}
                        <label for="materia_id">
                          <b>Materia</b>
                        </label>
                        <select  class="d_block" name="materia_id" value="{{ old('materia_id') }}" id="materia_id" onchange="getSelected()">
                          @foreach ($materias as $materia)
                            <option value={{$materia->id}}>
                              {{$materia->materia_name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="py-2">{{-- aula_name --}}
                        <label for="aula_id">
                          <b>Aula</b>
                        </label> 
                        <input type="text" class="d_block" name="aula_id" id="aula_id" value=""/>
                      </div>
                        

                        {{-- <select class="d_block" name="aula_id" value="{{ old('aula_id') }}" id="aula_id" >
                          @foreach ($aulas as $aula)
                            <option value={{$aula->id}}>{{$aula->aula_name}}
                            </option>
                          @endforeach
                        </select> --}}
                      
                    </div>
                  </div>
                  <div class="py-4 mb-4">
                    <button class="boton d_block blue" type="submit">Guardar</button>
                  </div>
              </form>
              
              <div class="px-6 py-4 mt-4 light-grey">
                <button onclick="document.getElementById('ver_modal').style.display='none'" type="button" class=" boton danger">Cancel</button>
              </div>
            </div>  {{--  fin modal-content --}}
          </div> {{--  fin modal --}}

        </div>  {{--  fin caja-body --}}
      </div> {{--  fin caja --}}
    </div> {{-- fin col-sm-12 --}}
  </div>  {{-- fin row --}}

@endsection
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
  function getSelected(){
    var x = document.getElementById("materia_id").value;
    document.getElementById('aula_id').value =  x;
  }
</script>