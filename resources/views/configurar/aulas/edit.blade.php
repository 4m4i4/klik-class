@section('aulas.edit')


      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          <span onclick="document.getElementById('editar_aula').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>
        <form class="p_x15" method="POST" action="{{ route('aulas.update', $aula->id) }}">
        @csrf
        @method('PUT')
        <div class="p_y15">
            <label for="nombre"><b>Aula</b></label>
            <input class="d_block m_b" autofocus type="text" name="nombre" required value="{{ $aula->nombre }}">
           
            <label for="num_columnas"><b>Columnas</b></label>
            <input type="number" class="m_b20"  name="num_columnas" min="1" max="9" autofocus required value="{{ $aula->num_columnas }}">
            <label for="num_filas"><b>Filas</b></label>
            <input type="number" class="m_b20"  name="num_filas"  min="1" max="9" autofocus required value="{{ $aula->num_filas }}">
            <label for="num_mesas"><b>Mesas</b></label>
            <input type="number" class=" m_b20"  name="num_mesas"  min="1" max="30" autofocus required value="{{ $aula->num_mesas }}">
            <button class="boton d_block blue" type="submit">Actualizar</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          <button onclick="document.getElementById('editar_aula').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show