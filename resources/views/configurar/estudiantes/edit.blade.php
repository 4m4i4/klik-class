{{-- @section('estudiantes.edit') MODAL --}}

@extends('layouts.app')

@section('tablas')
<div>
  @include('include.formBanner')
    <div class="px-6 caja-header text-center">
      <h3 class="form-title">Editar estudiante <span id="ver_grupo"></span>
      </h3>
    </div>

    <form class="px-6" action="{{route('estudiantes.update', $estudiante->id) }}" method="POST" >
      @csrf
      @method('PUT')  
          <div class= "mt-4">
            <label for="materia_id">materia-</label>
            <input type="text" id="materia_id" name="materia_id" value="{{ $estudiante->materia_id }}" >
          </div>
          <div class="mt-4">
            <label for="nombre">Nombre del estudiante</label>
            <input type="text" class="d_block" autofocus name="nombre" value="{{ $estudiante->nombre }}"/>

            <small class="ejemplo"><strong>Patrón:</strong> Ainara;</small>
            @error('nombre')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror            
          </div>
          <div class="mt-4">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="d_block" autofocus name="apellidos" value="{{ $estudiante->apellidos }}"/>

            <small class="ejemplo">Puede ser un solo apellido</small>
            @error('apellidos')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror            

            <button type="submit" 
             title="Actualizar datos del estudiante" 
             class="bt_xxl mt-6 enviar">Actualizar</button>
          </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('materias.index')}}" 
         title="Cancelar y volver al índice" 
         class="boton d_inline cancelar">Cancelar</a>
    </div>

</div>
@endsection
{{-- @show --}}