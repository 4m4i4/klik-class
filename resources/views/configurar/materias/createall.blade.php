@section('materias.createall')

      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center py-4">
          <span onclick="document.getElementById('crear_materiaAll').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
        </div>
        <div class="px-6 caja-header text-center"><h3><strong>Introduce todas las materias </strong></h3></div>
        <form class="px-6" method="POST" action="{{ route('materias.storeall') }}">
        @csrf
          <div class="py-6">
            <label for= "createall"><b></b></label>
            <textarea class="d_block" placeholder="ingles 1c bach,etica 2c eso,etc" autofocus  name="createall"  required></textarea>
            @error('createall')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
            <small><strong>Ejemplo: </strong>ingles 2a bach,etica 1c eso,etc</small>
            <details class="mt-2">
              <summary>Ayuda formato:</summary>
               <p class="pt-1 text-center"><strong>Esquema</strong></p>              
                <div class="py-2">
                  <p class="py-2">materia <kbd>space</kbd> cursoLetra <kbd>space</kbd> etapa <kbd>coma</kbd> otraMateria<kbd>space</kbd> cursoLetra...</p>
                </div>
                <p class="pt-1"><strong>Letras</strong> (A-Z, a-z) y <strong>Números</strong>(0-9) <br><strong>Sin tildes </strong> ni caracteres especiales </p>
              </details>
            </div>
          <div class="py-4 my-4">
            <button class="boton d_block blue" type="submit">Guardar todas</button>
          </div>
        </form>

        <div class="px-6 py-4 mt-4 light-grey">
          <button onclick="document.getElementById('crear_materiaAll').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show