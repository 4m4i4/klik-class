@section('aulas.create')

  <div class="modal-content animate-zoom" style="max-width:320px">
    <div class= "center py-4">
      <span onclick="document.getElementById('crear_aula').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
    </div>

    <form class="px-4" method="POST" action="{{ route('aulas.store') }}">
      @csrf
        <div class="py-6">
          <label for="aula_name"><b>Aula</b></label>
          <input type="text" class="d_block" placeholder="Nombre del aula" autofocus  name="aula_name" required>
          @error('aula_name')
            <small class="t_red">* {{ $message }}</small><br>
          @enderror
          <small><strong>Ejemplo:</strong> 2a bach, 3c eso</small>
          <div class="grid grid-cols-3 py-4">
            <div class="d_block pr-1">
              <label for="num_columnas"><b>Columnas</b></label><br>
              <input type="number" class="m_b20"  name="num_columnas" min="1" max="9" value="5" autofocus required>
            </div>
            <div class="d_block pr-1 pl-1">
              <label for="num_filas"><b>Filas</b></label><br>
              <input type="number" class="m_b20"  name="num_filas"  min="1" max="9" value= "5" autofocus required>
            </div>
            <div class="d_block pl-1">
              <label for="num_mesas"><b>Mesas</b></label><br>
              <input type="number" class=" m_b20"  name="num_mesas"  min="1" max="30" value= "25" autofocus required>
            </div>
          </div>
          
          
        <div class="py-4">
          <button type="submit" class="boton d_block primary">Guardar</button>
        </div>
    </form>

    <div class="px-4 py-3 light-grey">
      <button onclick="document.getElementById('crear_aula').style.display='none'" type="button" class=" boton danger">Cancel</button>
    </div>

  </div>
@show