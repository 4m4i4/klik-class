@extends('layouts.app')

@section('content')
  <div class="modal-content animate-zoom" style="max-width:320px">
    <div class= "center py-4">
      <a href="{{route('materias.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
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
    <div class="px-6 caja-header text-center"><h3><strong>Modificar materia </strong></h3></div>
    <form class="px-6" action="{{route('materias.update', $materia->id) }}" method="POST" >
      @csrf
      @method('PUT')
        <div class="py-6">
          <label for="materia_name"><b>{{__('Subject')}}</b></label>
          <input type="text" class="d_block mb-4" name="materia_name" autofocus value="{{ $materia->materia_name }}" required>
          
          <details>
            <summary>Ayuda Formato:</summary>
            <p><strong>Ejemplo:</strong> Arte 2A Bach</p>
            <p><strong>El esquema es:</strong><br> Materia <code>[espacio]</code> CursoLetra <code>[espacio]</code> Etapa.<br>No uses más espacios que [espacio].</p>
          </details>
         <div class="py-6 my-4">   
            <button type="submit" class=" m_t boton d_block blue" >Actualizar</button>
         </div>
        </div>
    </form>

    <div class="px-6 py-4 mt-4 light-grey">
         <a href="{{route('materias.index')}}"  title="Cancelar y volver al índice" class=" boton danger">Cancelar</a>
    </div>

  </div>

@endsection   

