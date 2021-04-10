
@extends('configurar.aulas.show') 
@section('content')
{{-- <div id="ver_modal" class="modal"> --}}
{{-- <div id="edit_vacias" class="modal"> --}}
<div class="nomodal">
  @include('include.formBanner')
    <div>
      <div class="px-6 caja-header text-center">
        <h3>Cambiar mesas del aula<br></h3>
      </div>
      <form class="px-6" method="POST" action="{{route('aulas.updateMesasVacias', $aula->id) }}" method="POST" >
      @csrf 
      @method('PUT')  
        <!--*MOdal: La función claseModal(this.id) recoge la id del botón que hace la llamada (formada por los valores 'dia'_'sesion_id'), hace un innerHTML a los input y quita el display:none de la ventana modal-->
      <div class="">
        <div class="mb-2"><!-- $clase->user_id  -->
          @php $id=[]; @endphp 
            {{-- <p>Usuari@: {{auth()->user()->name}}</p> --}}
            {{-- <p>Aula: {{$aula->aula_name}}</p> --}}
          <p class="ejemplo">{{$materia}}: <strong>{{$aula->num_columnas}}</strong> columnas y <strong>{{$aula->num_filas}}</strong> filas;<br> <strong>{{$estudiantes->count()}}</strong> estudiantes y <strong>{{$vacias->count()}}</strong> mesas vacías.</p> 
                  {{-- <p>
                    @foreach ($estudiantes as $estudiante)
                      {{$estudiante->id}}: {{$estudiante->apellidos}},{{$estudiante->nombre}};<br> 
                    @endforeach
                      </p> --}}
                      {{-- <p>
                        Mesas: {{$mesas->count()}}<br>
                        @foreach ($mesas as $mesa)
                          {{$mesa->id}}: {{$mesa->estudiante_id}},
                            @php
                              array_push( $id,$mesa->estudiante_id);
                              $i = 0;
                            @endphp
                            ;<br> 
                        @endforeach
                      </p> --}}
                        {{-- ids: {{count($id)}} --}}
                      {{-- <p>
                        @foreach ($estudiantes as $estudiante)
                          {{ $id[$i]}};
                          @php $i++; @endphp
                        @endforeach</p>    --}}
                  
          <div class="ml-8 mt-2">
            <small>
              @foreach ($vacias as $vacia)
                {{$vacia->id}}: está vacía;<br> 
              @endforeach 
            </small>
          </div>
        </div>
        <details class="mt-2">
          <summary>Cambiar mesas vacías</summary>
          <div class=""><!-- Cambiar mesas vacías  -->
            <label class="d_inline" for="cambiarMesasVacias">Columna, fila</label>
            <textarea name="cambiarMesasVacias" id="sencambiarMesasVacias" class="d_block" rows="1" placeholder="1,3;3,2"></textarea>
          </div> 
          <div class="mt-1">
            <small class="ejemplo"><strong>Esquema: columna, fila</strong> donde 1 es la columna 1 de la izquierda y 3 es la fila 3 desde atrás</small>
          </div>
        </details>
        <details class="mt-2">
          <summary>Mover estudiantes de mesa</summary>
          <div class="mt-2"><!-- Mover estudiantes de mesa  -->
            <label class="d_inline" for="sentarEstudiantes"></label>
            <textarea name="sentarEstudiantes" id="sentarEstudiantes" class="d_block" rows="1" placeholder="1,2,3,4,5,6,7,8,9"></textarea>
          </div>
          <div class="mt-1">
            <small class="ejemplo">Cada estudiante es un número del <strong>1 </strong> al <strong> {{$estudiantes->count()}} </strong><strong>Escribe una lista de números separados por comas.</strong></small>
          </div>

          <div class= "mt-4"><!-- Ayuda  -->
            <details class="mt-2">
            <summary>Ver más:</summary>
            <p class="mt-2"></p>
            <div class="destacado py-2">
              <p class="py-2 text-left">@for($i = 1; $i <= $estudiantes->count(); $i++)Nº <kbd>coma</kbd>@if($i%$aula->num_columnas == 0)<br>@endif @endfor</p>
            </div>  
            <p class="mt-2">en este plano del aula visto <strong>desde la pizarra</strong>.</p>
            <details class="mt-2">
              <summary>¿Más?</summary>
              <p class="mt-2">Copia y pega esta lista:</p>
              <p class="mt-2 text-center">{{$estudiantes->count()}}@for($i = $estudiantes->count()-1; $i > 0; $i--),{{$i}}@endfor</p>
            </details>
          </details>
        </div>

      </div>
      <div>
        <button type="submit" 
          title="Guardar clase" 
          class="bt_xxl mt-6 enviar">Guardar</button>
      </div>
    </form>
  </div>  
  <div class="px-6 py-4 mt-6 light-grey">
    <a href="{{url()->previous()}}"title="Cancelar y volver al índice" class="boton d_inline cancelar">Cancelar</a>
  </div>
</div>  {{--  fin modal-content --}}
        {{-- </div>  fin modal --}}
@endsection