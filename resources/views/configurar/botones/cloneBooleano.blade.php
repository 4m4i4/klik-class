{{-- botones.cloneBooleano --}}

  @php
    use App\Models\Boton;
    $plantilla = Boton::find(1);
  @endphp
  <details>
    <summary>Configuración avanzada</summary>
    <form id="clone_booleano_bt" class="mx-2" method="POST" action="{{ route('botones.store') }}">
      @csrf
        <input type="hidden" name="user_id" value={{ auth()->user()->id }}/>
        <input type="hidden" name="default" value= 0 />
        <input type="hidden" name="v_last" value= 1 />
        <input type="hidden" name="pasos" value= 2 />
        <input type="hidden" name="botontipo_id" value=1 />
        <label class="d_block mt-2" for="bt_name"><strong>Nombre del botón</strong></label>
        <input id="booleano_bt_name" class="d_block" type="text" name="bt_name" value="{{ $plantilla->bt_name }}" />
        @error('bt_name')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror

        <label class= "d_block mt-2" for="descripcion"><strong>Descripción</strong></label>
        <input id="booleano_descripcion" class="d_block" type="text" name="descripcion" value="{{ $plantilla->descripcion }}" />
        @error('descripcion')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror
        <label class= "d_block mt-2" for="items"><strong>Valores</strong></label>
        <input id="booleano_items" class="d_block"  type="text" name="items" value="{{ $plantilla->items }}" />
        @error('valores')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror

      <div>
        <button type="submit" 
            title="clonar booleano" 
            class="bt_xxl mt-6 enviar">Guardar</button>
      </div>
    </form>
  </details>

