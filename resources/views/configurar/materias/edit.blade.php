{{-- materias.edit --}}
@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">Modificar materia</h3>
      </div>

      <form class="px-6" action="{{route('materias.update', $materia) }}" method="POST" >
       @csrf
       @method('PUT')

        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" value="{{ auth()->user()->id }}" readonly />
        </div>
        
        <div class="pb-6">
          <label for="materia_name">{{__('Subject')}}</label>
          <input type="text" class="d_block" name="materia_name" autofocus value="{{ $materia->materia_name }}" required>
          @error('materia_name')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror            
          <small><strong>Ejemplo:</strong> ingles 3c eso</small>
        </div>

        <div class="mt-4">
          <details class="mt-2">
            <summary>Ayuda formato:</summary>
            <p class="mt-2">
              Usa solo <strong>Números </strong> y <strong>Letras sin tilde </strong>
            </p>
            <div class="py-2">
              <p class="py-2">Materia <kbd>space</kbd> NºLetra <kbd>space</kbd> Etapa</p>
            </div>  
            <p class="mt-2">Las letras se guardarán en MAYÚSCULA aunque escribas minúsculas </p>
          </details>
        </div>

        <div>   
          <button type="submit" 
          title="Actualizar materia" 
          class="bt_xxl mt-6 enviar">Actualizar</button>
        </div>
        
      </form>

      <div class="px-6 py-4 mt-6 light-grey">
         <a href="{{route('materias.index')}}" 
         title="Cancelar y volver al índice" 
         class="cancelar">Cancelar</a>
      </div>

    </div>
  </div>

@endsection