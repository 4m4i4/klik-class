@extends('configurar.materias.show') 

@section('content')

<div class="nomodal">
  @include('include.formBanner')
  <div>
    <div class="px-6 caja-header text-center">
      <h3>Cambiar mesas del aula</h3>
    </div>
    <form class="px-6" method="POST" action="{{route('materias.updateMesasVacias', $materia->id) }}" method="POST" >
      @csrf 
      @method('PUT')  
      <div class="">
        <div class="mb-2"><!-- $clase->user_id  -->

           <p class="text-center"> {{$materia->materia_name}}</p>
          <p class="ejemplo">
            <strong>{{$aula->num_columnas}}</strong> columnas y 
            <strong>{{$aula->num_filas}}</strong> filas;<br> 
            <strong>{{$total_estudiantes}}</strong> estudiantes y 
            <strong>{{ $aula->num_mesas - $total_estudiantes }}</strong> mesas vacías.
          </p> 
                  
         {{-- <div class="ml-8 mt-2">
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
            <small class="ejemplo">
              <strong>Esquema: columna_fila</strong> donde 1 es la primera columna de la izquierda y 3 es la tercera fila desde delante.
            </small>
          </div>
        </details> --}}


        <details class="mt-2">
          <summary>Mover estudiantes de mesa</summary>
          <div class="mt-2"><!-- Mover estudiantes de mesa  -->
            <label class="d_inline" for="sentarEstudiantes"></label>
            <textarea  name="sentarEstudiantes" id="sentarEstudiantes" class="d_block h-24" rows="1">@php 
            for($i = 1; $i <= $total_estudiantes; $i++){
              // for($i = $total_estudiantes; $i > 0; $i--){
              if($i<10) $i=' '.$i;
              echo $i;
              if($i % $aula->num_columnas > 0 && $i <  $total_estudiantes)echo ", ";
              else if($i % $aula->num_columnas == 0 && $i <  $total_estudiantes)echo ","."\n";
            }
            @endphp
            </textarea>
                 {{-- 7,22,12,8,10,
5,11,null,17,19,
1,3,21,4,16,
6,null,13,20,14,
2,15,null,18,9" --}}
          </div>
          <div class="mt-1 px-2">
            <small class="ejemplo">
              Ordena tus estudiantes escribiendo los números del <strong>1 </strong> al <strong> {{$total_estudiantes}} </strong></small><small> <strong>separados por comas</strong>.

            </small>
            @if( $aula->num_mesas - $total_estudiantes > 0)
            <small class="ejemplo"><br>
            Pon </small><small> <strong>null</strong> <span class="ejemplo"> para las <strong>{{ $aula->num_mesas - $total_estudiantes }} mesas vacías</strong>
            </span>
            @endif
          </div>

          <div class= "mt-2"><!-- Ayuda  -->
            <details class="mt-2">
              <summary>Ver mapa del aula:</summary>
              <p class="mt-2"></p>
              <div class="destacado py-2">
                <p class="px-6 py-2 ">
                  @for($i = 1; $i <= $total_estudiantes; $i++)
                    @if($i<10) {{$i='0'.$i}}
                    @else {{$i=''.$i}}
                    @endif 
                    @if($i < $total_estudiantes)
                      <kbd> ,</kbd>&nbsp;
                    @endif
                    @if($i % $aula->num_columnas == 0)<br>
                    @endif 
                  @endfor
                </p>
              </div>  
              <small class="mt-2">
                Ordenados <strong>por lista</strong> se verían así <strong>desde la pizarra</strong>.
              </small>
            </details>
              <details class="mt-2">
                <summary>Copia y pega esta lista 
                  @if( $aula->num_mesas - $total_estudiantes > 0) (añadiendo los <em>null</em>)
                  @endif
                </summary>
                <div class="mt-1 px-2">
                  <small class="mt-2 text-center">{{$total_estudiantes}}
                    @for($i = $total_estudiantes - 1; $i > 0; $i--), {{$i}}@endfor
                  </small>
                  <p>&nbsp;</p>
                </div>
              </details>
            {{-- </details> --}}
          </div>
        {{-- </details> --}}
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