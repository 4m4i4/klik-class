{{-- materias.show --}}
@extends('layouts.app')

  @section('etapaUso')

    <div class="bg-666 w-100 h-100 mx-auto  ">  

      <div class="grid grid-rows-{{$aula->num_filas}} h-90 content-center justify-between grid-cols-{{$aula->num_columnas}}">
        @foreach ($mesas->where('user_id', auth()->user()->id)->where('aula_id', $aula->id) as $mesa)
          <div id={{$mesa->id}}
           class="mesa text-center " 
           title="mesa{{$mesa->id}} Columna{{$mesa->columna}} Fila{{$mesa->fila}}">
            @if($mesa->is_ocupada == true)
              <div>       
                <button id="bt_izq_{{$mesa->id}}" 
                    class="bt_mesa bg-amarillo text-gray-900"
                    {{-- title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}" --}}
                    onclick="sino(bt_izq_{{$mesa->id}})">No</button>
                <button id="bt_dcha_{{$mesa->id}}" 
                    class="bt_mesa bg-gradual1 f_right" 
                    {{-- title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}" --}}
                    onmousedown="lee('bt_dcha_{{$mesa->id}}')"
                    {{-- onmouseup="suma(bt_dcha_{{$mesa->id}},10)"  --}}
                    >0</button>
              </div>
              <div>
                <button id="name_{{$mesa->id}}"
                    class="nombre_mesa d_block py-0" 
                    title="Estudiante id: {{$mesa->estudiante_id}}"
                    onclick= "desabilita({{$mesa->id}})">
                    {{$mesa->estudiante->nombre}} {{Str::limit($mesa->estudiante->apellidos, 1)}}
                    </button>
              </div> 
            @else
              <div>       
                <button id="bt_izq_{{$mesa->id}}" 
                    class="bt_mesa bt_mesaIzq" 
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    disabled>0</button>
                <button id="bt_dcha_{{$mesa->id}}" 
                    class="bt_mesa bt_mesaDcha f_right" 
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    disabled>0</button>
              </div>
              <div>
                <button class="bt_mesa d_block py-0" 
                    title=" disabled mesa id: {{$mesa->id}}" 
                    disabled>-- --</button>
              </div>
            @endif
          </div>    
        @endforeach
      </div> 
    </div>
  </div>

  @endsection