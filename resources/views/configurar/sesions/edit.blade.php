@extends('layouts.app')

@section('content')

  <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
    <div class= "center p_y p_right">
      <a href="{{route('sesions.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
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
    <form action="{{route('sesions.update', $sesion->id) }}" method="POST" class="p_x15" >
      @csrf
      @method('PUT')
        <div class="p_y" >
          <h3>Editar Sesión {{ $sesion->id }}</h3>
        </div>
        <div class="grid grid-cols-2 justify-between">
          <div>
            <label for="inicio"><b>Empieza:</b></label>
            <input type="time" id="inicio"  name="inicio" value="{{date_format(date_create($sesion->inicio), "H:i")}}" class="d_block" >
          </div>
          <div>
            <label for="fin"><b>Acaba: </b></label>
            <input type="time" id="fin" name="fin" value="{{date_format(date_create($sesion->fin), "H:i")}}" class="d_block" >
          </div>
        </div>
        <button type="submit" class=" m_b boton d_block blue" >Actualizar</button>
    </form>

    <div class=" p_x15 p_y light-grey">
      <a href="{{route('sesions.index')}}" title="Cancelar y volver al índice" class=" boton danger">Cancelar</a>
    </div>

  </div>

@endsection   
