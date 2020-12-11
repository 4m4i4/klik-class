@extends('layouts.app')

@section('content')

  <div class="modal-content animate-zoom" style="max-width:320px">
    <div class= "center py-4">
      <a href="{{route('sesions.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
    </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    <div class="px-6 my-4 caja-header text-center"><h3><strong>Modificar horario de la sesión  {{ $sesion->id }}</strong></h3></div>
    <form class="px-6" action="{{route('sesions.update', $sesion->id) }}" method="POST"  >
      @csrf
      @method('PUT')
        {{-- <div class="py-4" >
          <h3>Editar Sesión {{ $sesion->id }}</h3>
        </div> --}}
        <div class="grid grid-cols-2 py-4 my-6 justify-between">
          <div class="mr-1">
            <label for="inicio"><b>Empieza:</b></label>
            <input type="time" id="inicio"  name="inicio" value="{{date_format(date_create($sesion->inicio), "H:i")}}" class="d_block" >
          </div>
          <div class="ml-1">
            <label for="fin"><b>Acaba: </b></label>
            <input type="time" id="fin" name="fin" value="{{date_format(date_create($sesion->fin), "H:i")}}" class="d_block" >
          </div>
        </div>
        <div class="py-6 my-6">
          <button type="submit" class=" mb-4 boton d_block blue" >Actualizar</button>
        </div>
    </form>

    <div class="px-6 py-4 mt-4 light-grey">
      <a href="{{route('sesions.index')}}" title="Cancelar y volver al índice" class="d_inline boton danger">Cancelar</a>
    </div>

  </div>

@endsection   
