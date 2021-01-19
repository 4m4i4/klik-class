{{-- @section('mesas.create') --}}
@extends('layouts.app')

@section('tablas')

<div class="nomodal">
  @include('include.formWindow')
    <div class="px-6 caja-header text-center">
        <h3 class="form-title">Introducir mesa</h3>
    </div>

    <form class="px-6" method="POST" action="{{ route('mesas.store') }}">
      @csrf
        <div class="pb-6">
          <div class="grid grid-cols-3-auto mt-4">
            <div class="mr-1">
              <label class="d_block" for="columna">Columna</label>
              <input type="number" class="mb-1" name="columna" min="1" max="9" autofocus  value="{{ old('columna') }}">
              @error('columna')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="mr-1 ml-1">
              <label class="d_block" for="fila">Fila</label>
              <input type="number" class="mb-1"  name="fila"  min="1" max="9" autofocus  value="{{ old('fila') }}">
              @error('fila')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="is_ocupada">¿Está ocupada?</label>
              <input type="number" class=" mb-1"  name="is_ocupada"  min="0" max="1" autofocus  value="{{ old('is_ocupada') }}">
              @error('is_ocupada')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
          </div>
          <div class="grid grid-cols-3-auto mt-4">
            <div class="mr-1">
              <label class="d_block" for="clase_id">Clase_id</label>
              <input type="number" class="mb-1" name="clase_id" autofocus  value="{{ old('clase_id') }}">
              @error('clase_id')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="mr-1 ml-1">
              <label class="d_block" for="aula_id">Aula_id</label>
              <input type="number" class="mb-1" name="aula_id" autofocus  value="{{ old('aula_id') }}">
              @error('aula_id')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="estudiante_id">Estudiante_id</label>
              <input type="number" class=" mb-1" name="estudiante_id" autofocus  value="{{ old('estudiante_id') }}">
              @error('estudiante_id')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
          </div>
        </div>
        <div>
            <button type="submit" 
             title="Guardar mesas" 
             class="bt_xxl mt-6 enviar">Guardar</button>
        </div>
    </form>
    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('mesas.index')}}"
       title="Cancelar y volver al índice"
        class="cancelar">Cancelar</a>
    </div>

  </div>

@endsection