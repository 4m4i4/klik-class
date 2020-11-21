@section('materias.create')

      <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
        <div class= "center p_y p_right">
          <span onclick="document.getElementById('crear_materia').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
        </div>
       {{-- @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif --}}
        <form class="p_x15" method="post" action="{{ route('materias.store') }}">
        @csrf
          <div class="p_y15">
            <label for="materia_name"><b>Materia</b></label>
            <input type="text" class="d_block m_b " placeholder="Nombre de materia" autofocus name="materia_name">
            @error('materia_name')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <details>
              <summary>Mira el formato:</summary>
              <p><strong>Ejemplo:</strong> Arte 2A Bach</p>
              <p><strong>El esquema es:</strong><br> Materia [espacio] CursoLetra [espacio] Etapa.<br>No uses más espacios que [espacio].</p>

            </details>
            
          </div>
          <div class="p_t">

            <button type="submit" class="boton d_block blue">Guardar</button>
          </div>
        </form>

        <div class=" p_x15 p_y light-grey">
          <button onclick="document.getElementById('crear_materia').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>

      </div>

    @show