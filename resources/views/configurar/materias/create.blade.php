{{-- @section('materias.create') --}}
@extends('layouts.app')

@section('tablas')
<div>
    @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">Introducir materia</h3>
      </div>

      <form class="px-6" method="POST" action="{{ route('materias.store') }}">
        @csrf
          <div class="hidden"><!-- User_id -->
            <label for="user_id">user</label>
            <input type="text" name="user_id" 
            value={{ auth()->user()->id }} readonly />
          </div>

          <div class="pb-6">
            <label for="materia_name">{{__('Subject')}}</label>
            <input type="text" class="d_block" 
            {{-- pattern="([a-zA-Z]{3,10}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10})"  --}}
            placeholder="materia NºLetra etapa" 
            value="{{ old('materia_name') }}"  
            autofocus name="materia_name">
            @error('materia_name')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror            
            <small class="ejemplo"><strong>Ejemplos:</strong> arte 2a bach, ingles 3c eso.</small>
          </div>  

          <div class="mt-4">
            <details class="mt-2">
              <summary>Ayuda formato:</summary>
              <p class="mt-2">
                Usa solo <strong>Números </strong> y <strong>Letras sin tilde </strong>
              </p>
              <div class="destacado py-2">
                <p class="destacado py-2"><strong>Materia </strong><kbd>space</kbd><strong> NºLetra </strong> <kbd>space</kbd><strong> Etapa</strong></p>
              </div>  
              <p class="mt-2 pb-4">Las letras siempre se guardarán en <strong>MAYÚSCULA</strong> aunque escribas <strong>minúsculas</strong> </p>
            </details>
          </div>

          <div>
            <button type="submit" class="boton mt-6 d_block blue">Guardar</button>
          </div>

        </form>

        <div class="px-6 py-4 mt-6 light-grey">
          <a href="{{route('materias.index')}}" class="boton d_inline danger" title="Cancelar y volver al índice">Cancelar </a>
        </div>
    </div>
  </div>
@endsection