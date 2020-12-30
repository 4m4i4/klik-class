{{-- sesions.edit --}}
@extends('layouts.app')

@section('tablas')
<div>
    @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">Cambiar horario de la sesión  {{ $sesion->id }}</h3>
    </div>
    <form class="px-6" action="{{route('sesions.update', $sesion->id) }}" method="POST"  >
      @csrf
      @method('PUT')
        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" 
           value={{ auth()->user()->id }} readonly />
        </div>
        <div class="pb-6 grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="inicio">Empieza:</label>
            <input type="time" id="inicio"  name="inicio" value="{{date_format(date_create($sesion->inicio), "H:i")}}" class="d_block" >
            @error('inicio')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="ml-1">
            <label for="fin">Acaba: </label>
            <input type="time" id="fin" name="fin" value="{{date_format(date_create($sesion->fin), "H:i")}}" class="d_block" >
            @error('fin')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
        </div>
        <div>
          <button type="submit" class="boton mt-6 d_block blue">Actualizar</button>
        </div>
    </form>

    <div class="px-6 py-4 mt-6 light-grey">
      <a href="{{route('sesions.index')}}" class="boton d_inline danger" title="Cancelar y volver al índice">Cancelar </a>
    </div>

  </div>
</div>
@endsection   
