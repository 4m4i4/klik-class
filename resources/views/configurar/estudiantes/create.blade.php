@section('estudiantes.create')

      <div class="modal-content animate-zoom" style="max-width:320px">
        <div class= "center py-4">
          <span onclick="document.getElementById('crear_estudiantes').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
        </div>
        <form class="px-4" method="POST" action="{{ route('estudiantes.store') }}">
        @csrf
          <div class="py-6">
            <p id="ver_materia_id"></p>
            <label for="lista_completa"><b>Lista de estudiantes</b></label>
            <textarea class="d_block" placeholder="nombre" autofocus name="lista_completa"></textarea>
            <label for="materia_id"><b>Materia_id</b></label>
            <input type="text" class="d_block" id="materia_id" name="materia_id">
            @error('nombre_completo')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror            
            <small><strong>Ejemplo:</strong> arte 2a bach, ingles 3c eso.</small>

            <details class="mt-2">
              <summary>Ayuda formato:</summary>
                <p class="pt-1"><strong>Esquema: </strong></p>              
              <div class="py-2">
                <p class="py-2">Materia <kbd>space</kbd> CursoLetra <kbd>space</kbd> Etapa</p>
              </div>  
                <p class="pt-1"><strong>Letras</strong> (A-Z, a-z) y <strong>Números</strong>(0-9) <br><strong>Sin tildes </strong> ni caracteres especiales </p>
            </details>
          </div>
          <div class="py-4">
            <button type="submit" class="boton d_block primary">Guardar</button>
          </div>
        </form>

        <div class="px-4 py-3 light-grey">
          <button onclick="document.getElementById('crear_estudiantes').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

@show