{{-- @section('aulas.edit') --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Establecer el número de mesas, columnas y filas</h3>
    </div>

    <form class="px-6" method="POST" action="{{ route('aulas.update', $aula) }}">
      @csrf
      @method('PUT')
        <div class="text-center">
          <label for="aula_name">Aula {{ $aula->aula_name }}:</label>
          <input class="d_block" type="hidden" name="aula_name" required value="{{ $aula->aula_name }}">
          <label for="num_estudiantes">{{$num_estudiantes}} estudiantes</label>
          <input type="hidden" name="num_estudiantes" value={{$num_estudiantes}}> 
        </div>
        
        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" value={{ auth()->user()->id }} readonly />
        </div>         

        <div class="pb-6">  
          <div class="grid grid-cols-3-auto">
            <div class="d_block mr-1">
              <label class="d_block" for="num_columnas">Columnas</label>
              <input type="number" class="mb-1" id="num_columnas" name="num_columnas" min="1" max="9" autofocus required value="{{ $aula->num_columnas }}">
            </div>
            <div class="d_block mr-1 ml-1">
              <label class="d_block" for="num_filas">Filas</label>
              <input type="number" class="mb-1 d_block" id="num_filas" name="num_filas" min="1" max="9" autofocus required value="{{ $aula->num_filas }}">
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="num_mesas">Mesas</label>
              <input type="number" class=" mb-1" name="num_mesas"  min="1" max="30" autofocus required value="{{ $aula->num_mesas }}">
            </div>
          </div>
          @error('num_columnas')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
          @error('num_filas')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
          @error('num_mesas')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
        </div>
        <div>
          <button type="submit" 
            title="Actualizar aula" 
            class="bt_xxl mt-6 enviar">Guardar</button>
        </div>
    </form>

    <div class="px-6 py-2 mt-4 light-grey">
      <a href="{{route('materias.index')}}" 
        title="cancelar y volver"
        class="btn cancelar">Cancelar </a>
    </div>
</div>
@endsection
