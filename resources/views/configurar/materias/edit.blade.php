@extends('layouts.app')

@section('content')
  <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
    <div class= "center p_y p_right">
      <a href="{{route('materias.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
    </div>
    <form class="p_x15" action="{{route('materias.update', $materia->id) }}" method="POST" >
      @csrf
      @method('PUT')
        <div class="p_y15">
          <label for="materia_name"><b>Materia</b></label>
          <input type="text" class="d_block m_b" name="materia_name" autofocus value="{{ $materia->materia_name }}" required>
          
          <details>
            <summary>Ayuda Formato:</summary>
            <p><strong>Ejemplo:</strong> Arte 2A Bach</p>
            <p><strong>El esquema es:</strong><br> Materia <code>[espacio]</code> CursoLetra <code>[espacio]</code> Etapa.<br>No uses más espacios que [espacio].</p>
          </details>
            
          <button type="submit" class=" m_t boton d_block blue" >Actualizar</button>
        </div>
    </form>

    <div class=" p_x15 p_y light-grey">
         <a href="{{route('materias.index')}}"  title="Cancelar y volver al índice" class=" boton danger">Cancelar</a>
    </div>

  </div>

@endsection   

