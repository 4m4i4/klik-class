@extends('configurar.aulas.show') 

@section('content')
{{-- <div id="ver_modal" class="modal"> --}}
{{-- <div id="edit_vacias" class="modal"> --}}
<div class="nomodal">
  @include('include.formBanner')
    <div>
      <div class="px-6 caja-header text-center">
        <h3>Cambiar mesas del aula</h3>
      </div>
      <form class="px-6" method="POST" action="{{route('aulas.updateMesasVacias', $aula->id) }}" method="POST" >
      @csrf 
      @method('PUT')  
      <div class="">
        <div class="mb-2"><!-- $clase->user_id  -->
            {{-- <p>Usuari@: {{auth()->user()->name}}</p> --}}
          <p class="text-center"> {{$materia_name}}</p>
          <p class="ejemplo">
            <strong>{{$aula->num_columnas}}</strong> columnas y 
            <strong>{{$aula->num_filas}}</strong> filas;<br> 
            <strong>{{count($ids_estudiante)}}</strong> estudiantes y 
            <strong>{{$vacias->count()}}</strong> mesas vacías.
          </p> 
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
                        @endforeach
                  </p>    --}}
                  
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
            <textarea name="cambiarMesasVacias" id="cambiarMesasVacias" class="d_block" rows="1" placeholder="1_3,3_2"></textarea>
          </div> 
          <div class="mt-1">
            <small class="ejemplo"><strong>Esquema: columna_fila</strong> donde 1 es la primera columna de la izquierda y 3 es la tercera fila desde delante.</small>
          </div>
        </details>
        <details class="mt-2">
          <summary>Mover estudiantes de mesa</summary>
          <div class="mt-2"><!-- Mover estudiantes de mesa  -->
            <label class="d_inline" for="sentarEstudiantes"></label>
            <textarea name="sentarEstudiantes" id="sentarEstudiantes" class="d_block" rows="1" placeholder="1,2,3,4,5,6,7,8,9"></textarea>
          </div>
          <div class="mt-1 px-2">
            <small class="ejemplo">Ordena tus estudiantes escribiendo los números del <strong>1 </strong> al <strong> {{count($ids_estudiante)}} </strong></small><small> <strong>separados por comas</strong></small>
          </div>

          <div class= "mt-2"><!-- Ayuda  -->
            <details class="mt-2">
           {{--  <summary>Ver más:</summary> --}}
            <p class="mt-2"></p>
            <div class="destacado text-center py-2">
              <p class="py-2 ">
                @for($i = 1; $i <= count($ids_estudiante); $i++)
                  @if($i<10) {{$i='0'.$i}}
                  @else {{$i=''.$i}}
                  @endif 
                    <kbd> ,</kbd>&nbsp;
                  @if($i%$aula->num_columnas == 0)<br>
                  @endif 
                @endfor
              </p>
            </div>  
            <small class="mt-2">Ordenados <strong>por lista</strong> se verían así <strong>desde la pizarra</strong> .</small>
            <details class="mt-2">
              <summary>Copia y pega esta lista</summary>
              {{-- <p class="mt-2 px-2">:</p> --}}
              <div class="mt-1 px-2">
              <small class="mt-2 text-center">{{count($ids_estudiante)}}
                @for($i = count($ids_estudiante)-1; $i > 0; $i--), {{$i}}@endfor
              </small>
              </div>
            </details>
          {{-- </details> --}}
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