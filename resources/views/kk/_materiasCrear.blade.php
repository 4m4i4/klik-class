@section('_materiasCrear')

      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          <span onclick="document.getElementById('crear_materia').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>


        <form class="p_x15" method="POST" action="{{ route('configurar.materias') }}">
        @csrf
          <div class="p_y15">
            <label for="nombre"><b>Materia</b></label>
            <input class="d_block m_b" autofocus type="text" name="nombre" placeholder="Nombre de materia" required>
           
            <label for="grupo"><b>Grupo</b></label>

            <details>
              <summary>ESO_3A (Ayuda formato)</summary>
              <p><em>Etapa</em> (ESO, BACH...) <strong> Guión bajo sin espacios</strong> <em>CursoLetra</em> (1A, 2D, 4C)</p>
            </details>

            <input type="text" class="d_block m_b" placeholder="BACH_1A, ESO_3C" name="grupo" autofocus required>

            <label for="aula"><b>¿Se da en el aula del grupo?</label><br>
            <input type="radio" id="Si" name="aula" value="Sí">
            <label for="Si">Sí</label>
            <input type="radio" id="No" name="aula" class="m_left" checked value="No">
            <label for="No">No</label><br>
            <button class="boton d_block blue" type="submit">Guardar</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          <button onclick="document.getElementById('crear_materia').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show