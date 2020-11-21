{{-- @section('_materiasEditar')


      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          <span onclick="document.getElementById('editar_materia').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>
        <form class="p_x15" method="POST" action="{{ route('update_materias', $materia->id) }}">
        @csrf
        @method('PUT')
        <div class="p_y15">
            <label for="nombre"><b>Materia</b></label>
            <input class="d_block m_b" autofocus type="text" name="nombre" required value="{{ $materia->nombre }}">
           
            <label for="grupo"><b>Grupo</b></label>
            <details>
              <summary>ESO3-A (Ayuda formato)</summary>
              <p>ESO, Bach..., seguido <strong> sin espacios</strong>:<br>1-A, 2-D, 4C: curso <em><strong> guión </strong></em>grupo.</p>
            </details>
            <input type="text" class="d_block m_b20"  name="grupo"  autofocus required value="{{ $materia->grupo }}">
            <button class="boton d_block blue" type="submit">Actualizar</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          <button onclick="document.getElementById('editar_materia').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show --}}


 @extends('layouts.app')

@section('content')

      <div class=" p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          {{-- <span onclick="document.getElementById('editar_materia').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span> --}}
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>
        <form class="p_x15" method="POST" action={{route('update_materias', $materia->id) }}>
        @csrf
        @method('PUT')
        <div class="p_y15">
            <label for="nombre"><b>Materia</b></label>
            <input class="d_block m_b" autofocus type="text" name="nombre" required value={{ $materia->nombre }}>
           
            <label for="grupo"><b>Grupo</b></label>
            <details>
              <summary>ESO3-A (Ayuda formato)</summary>
              <p>ESO, Bach..., seguido <strong> sin espacios</strong>:<br>1-A, 2-D, 4C: curso <em><strong> guión </strong></em>grupo.</p>
            </details>
            <input type="text" class="d_block m_b20"  name="grupo"  autofocus required value={{ $materia->grupo }}>
            <button class="boton d_block blue" type="submit">Actualizar</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          {{-- <button onclick="document.getElementById('editar_materia').style.display='none'" type="button" class=" boton danger">Cancel</button> --}}
        </div>

      </div>
@endsection    