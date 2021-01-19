{{-- @section('mesas.edit') --}}
@extends('layouts.app')

@section('tablas')
<div>
<div class="nomodal">
  @include('include.formWindow')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Editar mesa</h3>
    </div>
    <form class="px-6" action="{{route('mesas.update', $mesa->id) }}" method="POST" >
       @csrf
       @method('PUT')
        <div class="pb-6">
          <div class="grid grid-cols-3-auto mt-4">
            <div class="mr-1">
              <label class="d_block" for="columna">Columna</label>
              <input type="number" class="mb-1" name="columna" min="1" max="9" autofocus  value="{{ $mesa->columna }}">
              @error('columna')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="mr-1 ml-1">
              <label class="d_block" for="fila">Fila</label>
              <input type="number" class="mb-1"  name="fila"  min="1" max="9" autofocus  value="{{ $mesa->fila }}">
              @error('fila')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="is_ocupada">¿Está ocupada?</label>
              <input type="number" class=" mb-1"  name="is_ocupada"  min="0" max="1" autofocus  value="{{ $mesa->is_ocupada }}">
              @error('is_ocupada')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
          </div>

          <div class="grid grid-cols-3-auto mt-4">
            <div class="mr-1">
              <label class="d_block" for="clase_id">Clase_id</label>
              <input type="number" class="mb-1" name="clase_id" autofocus  value="{{ $mesa->clase_id }}">
              @error('clase_id')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="mr-1 ml-1">
              <label class="d_block" for="aula_id">Aula_id</label>
              <input type="number" class="mb-1"  name="aula_id" autofocus  value="{{ $mesa->aula_id }}">
              @error('aula_id')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="estudiante_id">Estudiante_id</label>
              <input type="number" class=" mb-1" name="estudiante_id" autofocus  value="{{ $mesa->estudiante_id }}">
              @error('estudiante_id')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror
            </div>
          </div>

          <div>
            <button type="submit" 
             title="Actualizar mesas" 
             class="bt_xxl mt-6 enviar">Actualizar</button>
          </div>
        </div>
      </form>
    <div class="px-6 py-4 mt-6 light-grey">
       <a href="{{route('mesas.index')}}" 
       title="Cancelar y volver" 
       class="cancelar">Cancelar </a>
    </div>

  </div>
</div>
  
@endsection