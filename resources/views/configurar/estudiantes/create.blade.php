{{-- @section('estudiantes.create') MODAL --}}

      <div class="modal-content animate-zoom">
        <div class= "text-center mb-4">
          <svg width="358px" height="107px" viewBox="0 0 512 152">
            <g id="form_top">
              <rect id="fondo" fill="#363636" width="512" height="152"/>
              <path id="mesa_az" fill="#00ABD6" d="M124 94l65 0 0 38 -65 0 0 -38zm184 0l64 0 0 38 -64 0 0 -38zm-92 0l65 0 0 38 -65 0 0 -38z"/>
              <path id="mesa_tur" fill="#00F7FF" d="M216 28l65 0 0 38 -65 0 0 -38zm92 0l64 0 0 38 -64 0 0 -38z"/>
              <path id="mesa_am" fill="#FFEE00" d="M400 28l64 0 0 38 -64 0 0 -38zm-276 0l65 0 0 38 -65 0 0 -38zm-91 66l64 0 0 38 -64 0 0 -38z"/>
              <path id="flecha" fill="#FF0066" d="M168 52l51 30 -19 7 18 27c0,1 0,3 -1,4l-7 4c-1,1 -3,0 -4,-1l-17 -27 -15 15 -6 -59z"/>
            </g>
          </svg>
        </div>
        <div class="px-6 caja-header text-center">
          <h3>Introducir grupo de <span id="ver_materia_id"></span>
          </h3>
        </div>
        <form class="px-6" method="POST" action="{{ route('estudiantes.store') }}">
          @csrf
          
          <div class= "hidden">
              <label for="materia_id"></label>
              <input type="hidden" id="materia_id" name="materia_id" value="{{ old('materia_id') }}" >
          </div>
          <div class="mt-4">
              <label for="lista_completa">Lista de estudiantes</label>
              <textarea class="d_block" placeholder="Picasso, Pablo; Garcia Lorca, Federico; De Cervantes Saavedra, Miguel" rows="6" autofocus name="lista_completa"></textarea>
              <small class="ejemplo">Patrón: Apellido -coma-, Nombre -puntoYComa-;</small>
              @error('nombre_completo')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror            
          </div>
          <div class= "mt-4">
            <details class="mt-2">
              <summary>Ayuda formato:</summary>
               <p class="mt-2">
                Usa solo <strong>Números </strong> y <strong>Letras sin tilde </strong>
              </p>
              <div class="destacado py-2">
                <p class="py-2">Apellido <kbd>space</kbd> Apellido  <kbd>coma</kbd>,  Nombre <kbd> ;</kbd></p>
              </div>  
              <p class="mt-2">Apellidos a la izquierda de <kbd>coma</kbd>, Nombre a la derecha; <kbd>punto y coma</kbd> para añadir el siguiente</p>
            </details>
          </div>
          <div>
            <button type="submit" class="boton mt-6 d_block blue">Guardar</button>
          </div>
        </form>

        <div class="px-6 py-4 mt-6 light-grey">
          <button onclick="document.getElementById('crear_estudiantes').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

{{-- @show --}}