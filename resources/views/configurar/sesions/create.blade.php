{{-- @extends('layouts.app') --}}
@section('sesions.create')
{{-- @section('content') --}}
  <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
    <div class= "center p_y p_right">
       {{-- <a href="{{route('sesions.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a> --}}
      <span onclick="document.getElementById('crear_sesiones').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
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
    @php
      use App\Models\Sesion;
      $sesiones = Sesion::get();
      $num_sesiones= $sesiones->count();
    @endphp
    <form class="p_x15" method="post" action="{{ route('sesions.store') }}">
      @csrf
        <p id="id_sesion"><p>
        <div class="p_y" >
          <h3>Crear Sesión {{ $num_sesiones+1}}</h3>
        </div>
        <div class="p_y  grid grid-cols-2 justify-between">
          <div>
            <label for="inicio"><b>Empieza:</b></label>
            <input type="time" id="inicio"  name="inicio" class="d_block m_b" >
          </div>
          <div>
            <label for="fin"><b>Acaba: </b></label>
            <input type="time" id="fin" name="fin" class="d_block m_b" >
          </div>
        </div>
        <button class="boton d_block blue" type="submit">Guardar</button>
        {{-- <button onsubmit="document.getElementById('crear_sesiones').style.display='block'" class="boton d_block m_b15 blue" type="submit">Guardar</button> --}}
    </form>


      {{-- <a href="{{route('sesions.index')}}" type="button" class=" boton danger">Cancelar</a> --}}
    
    <div class=" p_x15 p_y light-grey">
      <button onclick="document.getElementById('crear_sesiones').style.display='none'" type="button" class=" boton danger">Cancel</button>
    </div>
  </div>
@show
{{-- @endsection --}}