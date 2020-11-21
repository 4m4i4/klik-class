@section('_materiasCrearAll')

      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          <span onclick="document.getElementById('crear_materiaAll').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>

        <form class="p_x15" method="POST" action="{{ route('storeall_materias') }}">
        @csrf
          <div class="p_y15">
            <label for= "materiasall">Introduce todas tus clases</label>
            <textarea class="d_block m_b" autofocus  name="materiasall" placeholder="Mate BACH.1C" required></textarea>

            <details>
              <summary>Mira cómo: Ética ESO.3C</summary>
              <p><em>Materia </em><strong> ESPACIO </strong><em> Etapa </em><strong> PUNTO </strong><em> CursoLetra </em><strong> COMA </strong> y añade la siguiente</p>
            </details>

            <button class="boton d_block blue" type="submit">Guardar todas</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          <button onclick="document.getElementById('crear_materiaAll').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show