{{-- @section('aulas.create') --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
    <div class="px-6 caja-header text-center">
        <h3 class="form-title">Introducir aula</h3>
    </div>

    <form class="px-6" method="POST" action="{{ route('aulas.store') }}">
      @csrf

        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" value={{ auth()->user()->id }} readonly />
        </div>

        <div class="pb-6">

          <label for="aula_name">Aula</label>
          <input type="text" class="d_block" placeholder="Nombre del aula" autofocus  name="aula_name" value="{{ old('aula_name') }}"  required>
          @error('aula_name')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
          <small class="ejemplo"><strong>Ejemplo:</strong> 2a bach</small>

          <div class="grid grid-cols-3-auto mt-4">
            <div class="mr-1">
              <label class="d_block" for="num_columnas">Columnas</label>
              <input type="number" class="mb-1" id=="num_columnas" name="num_columnas" min="1" max="9" value="5" autofocus required>
            </div>
            <div class="mr-1 ml-1">
              <label class="d_block" for="num_filas">Filas</label>
              <input type="number" class="mb-1" id="num_filas" name="num_filas"  min="1" max="9" value= "5" autofocus required>
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="num_mesas">Mesas</label>
              <input type="number" class=" mb-1"  name="num_mesas"  min="1" max="30" value= "25" autofocus required>
            </div>
          </div>
          
          <div>
            <button type="submit" 
             title="Guardar aula" 
             class="bt_xxl mt-6 enviar">Guardar</button>
          </div>

        </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('materias.index')}}" 
       title="Cancelar y volver al índice"
      class="cancelar">Cancelar </a>
    </div>

</div>
@endsection