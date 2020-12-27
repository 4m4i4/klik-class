{{-- @section('aulas.edit') --}}
@extends('layouts.app')

@section('tablas')
  @include('include.formWindow')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Columnas, filas y mesas: Cantidad real</h3>
    </div>

    <form class="px-6" method="POST" action="{{ route('aulas.update', $aula->id) }}">
      @csrf
      @method('PUT')

        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" value={{ auth()->user()->id }} readonly />
        </div>

        <div class="pb-6">
          <label for="aula_name">Aula</label>
          <input class="d_block" autofocus type="text" name="aula_name" required value="{{ $aula->aula_name }}">
          @error('aula_name')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
          <small><strong>Ejemplo:</strong> 2a bach, 3c eso</small>

          <div class="grid grid-cols-3-auto mt-4">
            <div class="d_block mr-1">
              <label class="d_block" for="num_columnas">Columnas</label>
              <input type="number" class="mb-1" name="num_columnas" min="1" max="9" autofocus required value="{{ $aula->num_columnas }}">
            </div>
            <div class="d_block mr-1 ml-1">
              <label class="d_block" for="num_filas">Filas</label>
              <input type="number" class="mb-1 d_block" name="num_filas" min="1" max="9" autofocus required value="{{ $aula->num_filas }}">
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="num_mesas">Mesas</label>
              <input type="number" class=" mb-1" name="num_mesas"  min="1" max="30" autofocus required value="{{ $aula->num_mesas }}">
            </div>
          </div>
          @error('num_mesas')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror

          <div>
            <button type="submit" class="boton mt-6 d_block blue">Actualizar</button>
          </div>

        </div>
    </form>

    <div class="px-6 py-2 mt-4 light-grey">
      <a href="{{route('aulas.index')}}" class="boton d_inline danger" title="cancelar y volver">Cancelar </a>
    </div>

  </div>

@endsection