{{-- botones.cloneAsistencia --}}

  @php
    use App\Models\Boton;
    $plantilla = Boton::find(3);
  @endphp
  <details>
    <summary class="bg-yellow">Configuración avanzada</summary>
    <form id="asistencia_btform" class="mx-2" method="POST" action="{{ route('botones.store') }}">
      @csrf
        <input type="hidden" name="user_id" value={{ auth()->user()->id }}/>
        <input type="hidden" name="tipoBt_id" value=3 />
        <input type="hidden" name="default" value=0 />
        <label class= "d_block mt-2" for="bt_name"><strong>Nombre del botón</strong></label>
        <input id="asistencia_bt_name" class="d_block" type="text" name="bt_name" value="{{ $plantilla->bt_name }}" />
        @error('bt_name')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror

        <label class= "d_block mt-2" for="descripcion"><strong>Descripción</strong></label>
        <input id="asistencia_descripcion" class="d_block" type="text" name="descripcion" value="{{ $plantilla->descripcion }}" />
        @error('descripcion')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror
        <label class= "d_block mt-2" for="pasos"><strong>Pasos</strong></label>
        <input id="asistencia_pasos" class="d_block" type="text" name="pasos" value= {{$plantilla->pasos}} />
        @error('pasos')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror
        <input type="hidden" name="v_last" value={{(integer)$plantilla->pasos - 1}} />
        <label class= "d_block mt-2" for="items"><strong>Valores</strong></label>
        <input id="asistencia_items" class="d_block" type="text" name="default" value= "{{$plantilla->items}}" />
        @error('items')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror

      <div>
        <button type="submit" 
            title="clonar asistencia" 
            class="bt_xxl mt-6 enviar">Guardar</button>
      </div>
    </form>
  </details>