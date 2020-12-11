@extends('layouts.app')

@section('content')

{{-- @section('aulas.edit') --}}



  <div class="modal-content animate-zoom" style="max-width:320px">
    <div class= "center py-4">
      {{-- <span onclick="document.getElementById('editar_aula').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span> --}}
      <a href="{{route('materias.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
    </div>
    <div class="px-6 my-2 caja-header text-center">
      <h3>
        <strong>Columnas, filas y mesas: Cantidad real </strong>
      </h3>
    </div>
    <form class="px-6" method="POST" action="{{ route('aulas.update', $aula->id) }}">
      @csrf
      @method('PUT')
        <div class="py-6">
          <label for="aula_name"><b>Aula</b></label>
          <input class="d_block" autofocus type="text" name="aula_name" required value="{{ $aula->aula_name }}">
          @error('aula_name')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
          <small><strong>Ejemplo:</strong> 2a bach, 3c eso</small>
          <div class="grid grid-cols-3-auto py-4 ">
            <div class="d_block mr-1">
              <label class="d_block" for="num_columnas"><b>Columnas</b></label>
              <input type="number" class="mb-1" name="num_columnas" min="1" max="9" autofocus required value="{{ $aula->num_columnas }}">
            </div>
            <div class="d_block mr-1 ml-1">
              <label class="d_block" for="num_filas"><b>Filas</b></label>
              <input type="number" class="mb-1 d_block" name="num_filas"  min="1" max="9" autofocus required value="{{ $aula->num_filas }}">
            </div>
            <div class="d_block ml-1">
              <label class="d_block" for="num_mesas"><b>Mesas</b></label>
              <input type="number" class=" mb-1"  name="num_mesas"  min="1" max="30" autofocus required value="{{ $aula->num_mesas }}">
            </div>
          </div>
          <div class="py-4 my-2">
            <button type="submit" class="boton d_block primary">Guardar</button>
          </div>
        </div>
    </form>

    <div class="px-6 py-2 mt-4 light-grey">
      <a href="{{route('materias.index')}}" class="boton d_inline danger" title="volver">Cancelar </a>
      {{-- <button onclick="document.getElementById('editar_aula').style.display='none'" type="button" class=" boton danger">Cancel</button> --}}
    </div>

  </div>

@endsection   
{{-- @show --}}