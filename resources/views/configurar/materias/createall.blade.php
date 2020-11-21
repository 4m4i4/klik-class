@section('materias.createall')

      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          <span onclick="document.getElementById('crear_materiaAll').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>

        <form class="p_x15" method="POST" action="{{ route('materias.storeall') }}">
        @csrf
          <div class="p_y15">
            <label for= "materiasall"><b>Introduce todas tus clases</b></label>
            <textarea class="d_block m_b" autofocus  name="materiasall" placeholder="Mate 1C bach,ética 2c eso," required></textarea>

            <details>
              <summary>Mira cómo: </summary>
              <p><strong>Ejemplo:</strong> Arte 2A Bach,Mate 1c Eso,etc</p>
              <p><strong>El esquema es:</strong><br> Materia [espacio] CursoLetra [espacio] Etapa [coma], y añades la siguiente.<br>No uses más espacios ni comas que [espacio] y [coma].</p>
            </details>

            <button class="m_t boton d_block blue" type="submit">Guardar todas</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          <button onclick="document.getElementById('crear_materiaAll').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show