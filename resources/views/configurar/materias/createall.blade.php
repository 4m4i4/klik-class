{{-- @section('materias.createall') --}}

@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">Introduce todas las materias</h3>
      </div>
      <form class="px-6" method="POST" action="{{ route('materias.storeall') }}">
        @csrf
          <div class="hidden"><!-- User_name -->
            <label for="user_id">user</label>
            <input type="text" name="user_id" 
            value={{ auth()->user()->id }} readonly />
          </div>
          <div class="pb-6">
            <label for= "createall">Todas</label>
            <textarea class="d_block" 
            placeholder="ingles 1c bach,etica 2c eso,etc" 
             pattern="([a-zA-Z]{3,16}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10})+"
            autofocus  
            name="createall" required></textarea>
            @error('createall')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
            <small class="ejemplo"><strong>Ejemplo:</strong> ingles 2a bach,etica 1c eso,etc</small>
          </div>
          <div class="mt-4">
            <details class="mt-2">
              <summary>Ayuda formato:</summary>
              <p class="mt-2">
                  Usa solo <strong>Números </strong> y <strong>Letras sin tilde </strong>
              </p>
              <div class="destacado py-2">
                <p class="py-2">materia <kbd>space</kbd> NºLetra <kbd>space</kbd> etapa <kbd>coma</kbd> otraMateria <kbd>space</kbd> NºLetra...</p>
              </div>  
              <p class="mt-2">Las letras se guardarán en MAYÚSCULA aunque escribas minúsculas </p>
            </details>        
          </div>

          <div>
            <button type="submit" 
             title="Guardar materias" 
             class="bt_xxl mt-6 enviar">Guardar</button>
          </div>
      </form>

      <div class="px-6 py-4 mt-6 light-grey">
        <a href="{{route('materias.index')}}" 
        title="Cancelar y volver al índice" 
        class="cancelar">Cancelar </a>
      </div>
    </div>

  </div>
@endsection