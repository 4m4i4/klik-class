{{-- @section('estudiantes.create') MODAL --}}
  @include('include.formBanner')

        <div class="px-6 caja-header text-center">
          <h3 class="form-title">Introducir grupo: <span id="ver_grupo"></span>
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
              <textarea class="d_block" placeholder="Picasso, Pablo; Garcia Lorca, Federico; De Cervantes Saavedra, Miguel" rows="4" required autofocus name="lista_completa"></textarea>
              <small class="ejemplo"><strong>Patrón:</strong> Apellido -coma-, Nombre -punto y Coma-;</small>
              @error('nombre_completo')
                <small class="t_red">* {{ $message }}</small><br>
              @enderror            
          </div>
          <div class= "mt-4">
            <details class="mt-2">
              <summary>Ayuda formato:</summary>
               <p class="mt-2">
                Usa solo <strong>Números </strong> y <strong>Letras</strong>
              </p>
              <div class="destacado py-2">
                <p class="py-2">Apellido <kbd>space</kbd> Apellido  <kbd>coma</kbd>,  Nombre <kbd> ;</kbd></p>
              </div>  
              <p class="mt-2">Apellidos a la izquierda de <kbd>coma</kbd>, Nombre a la derecha; <kbd>punto y coma</kbd> para añadir el siguiente</p>
            </details>
          </div>
          <div>
            <button type="submit" 
             title="Guardar grupo de estudiantes" 
             class="bt_xxl mt-6 enviar">Guardar</button>
          </div>
        </form>

        <div class="px-6 py-4 mt-6 light-grey">
          <button onclick="document.getElementById('crear_estudiantes').style.display='none'" 
          type="button" 
          title="Cancelar y volver al índice" 
          class="cancelar">Cancelar</button>
        </div>

      </div>

{{-- @show --}}