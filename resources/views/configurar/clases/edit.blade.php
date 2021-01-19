{{-- clases.edit --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formWindow')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Cambiar la materia de esta clase</h3>
    </div>
    
    <form class="px-6" action="{{route('clases.update', $clase->id) }}" method="POST" >
      @csrf
      @method('PUT')
          <div class="hidden"><!-- User_id -->
            <label for="user_id"></label>
            <input type="text" name="user_id" value="{{ auth()->user()->id }}" readonly />
          </div>  
          <p id="ver_id"></p>
          @php
            use App\Models\Materia;
            $mat = Materia::where('user_id',auth()->user()->id )->get();
            $n_mat= $mat->count();
            use App\Models\Aula;
            $aula = Aula::where('user_id',auth()->user()->id )->get();
            $n_aula= $aula->count();
          @endphp 
        <div class="hidden grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="dia"></label>
            <input type="hidden" id="edit_dia" class="d_block" name="dia" readonly value="{{ $clase->dia }}">
            @error('dia')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  
          </div>
          <div class="ml-1">
            <label for="sesion_id"></label>
            <input type="hidden" id="edit_sesion_id" class="d_block" name="sesion_id" readonly value="{{ $clase->sesion_id}}">
            @error('sesion_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror   
          </div>
        </div>        
        
        <div class="pb-2">
          <label for="materia_id">Materia</label>
          <select id="materia_id" name="materia_id" value="{{$clase->materia_id}}" class="d_block" >
            @for ($i = 1; $i < $n_mat+1; $i++)
              <option value={{$i}}{{$i ==$mat[$i-1]->id? ' selected' : ''}}>{{$mat[$i-1]->materia_name}}</option>
            @endfor
          </select>
          @error('materia_id')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror   
        </div>

        <div class="py-2">  
            <label for="aula_id">Aula</label>
            <select id="aula_id" name="aula_id" value="{{ $clase->aula_id  }}" class="d_block" onchange="getSelected('aula_id')">
              @for ($j = 1; $j < $n_aula+1; $j++)
                <option value={{$j}}{{$j ==$aula[$j-1]->id? ' selected' : ''}}>{{$aula[$j-1]->aula_name}}</option>
              @endfor
            </select>
            @error('aula_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
        <div>
          <button type="submit" 
          title="Actualizar clase" 
          class="bt_xxl mt-6 enviar">Actualizar</button>
      </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('clases.index')}}" title="Cancelar y volver al índice" 
      class="cancelar">Cancelar</a>
    </div>

  </div>
</div>
  

  
  <script>
    function getSelected(xx){
      var x = document.getElementById(xx).value;
       document.getElementById(xx).value =x;
    }
  </script>

@endsection     
  
 