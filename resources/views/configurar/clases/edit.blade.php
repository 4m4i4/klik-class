{{-- clases.edit --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Cambiar la materia de esta clase</h3>
    </div>
    
    <form class="px-6 mb-4" action="{{route('clases.update', $clase) }}" method="POST" >
      @csrf
      @method('PUT')
        <div class="hidden"><!-- User_id -->
            <label for="user_id"></label>
            <input type="text" name="user_id" value="{{ auth()->user()->id }}" readonly />
        </div>  
        <p id="ver_id"></p>
          {{-- @php
            // use App\Models\Materia;
            // $mat = Materia::where('user_id',auth()->user()->id )->get();
            // $n_mat= $mat->count();
            // use App\Models\Aula;
            // $aula = Aula::where('user_id',auth()->user()->id )->get();
            // json_encode($aula);
            // $n_aula= $aula->count();
          @endphp  --}}
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
          <select id="materia_id" 
            name="materia_id" 
            value="{{$clase->materia_id}}" 
            class="d_block" >
            @foreach ($materias as $materia)
              <option value={{$materia->id}} {{$materia->id == $clase->materia_id? 'selected' : ''}}>
                {{$materia->materia_name}}
              </option>
            @endforeach
          </select>
          @error('materia_id')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror   
        </div>
        <div>
          <button type="submit" 
          title="Actualizar clase" 
          class="bt_xxl mt-6 enviar">Actualizar</button>
        </div>
    </form>

    <div class="px-6 caja-header text-center">
      <h3 class="form-title">¿Quieres borrar la clase?</h3>
    </div>

    <form class="px-6" action="{{route('clases.destroy', $clase) }}" method="POST" >
      @csrf
      @method('DELETE')


        {{-- <div class="hidden"><!-- User_id -->
            <label for="user_id"></label>
            <input type="text" name="user_id" value="{{ auth()->user()->id }}" readonly />
        </div>   --}}
        
        <div>
          <label> {{ $clase->dia }}: {{date_format(date_create( $clase->sesion->inicio), "H:i")}} -  {{date_format(date_create( $clase->sesion->fin), "H:i")}}</label>
          <button type="submit" 
          title="Vaciar la sesión del {{ $clase->dia }}: {{date_format(date_create( $clase->sesion->inicio), "H:i")}} -  {{date_format(date_create( $clase->sesion->fin), "H:i")}}" 
          class="bt_xxl borrarLarge my-0">Borrar</button>
          <small class="condensed" >Vaciar la celda <strong>registrada por error</strong></small>
        </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('clases.index')}}" title="Cancelar y volver al índice" 
      class="cancelar">Cancelar</a>
    </div>

  </div>
</div>
@endsection

