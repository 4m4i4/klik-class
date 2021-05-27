  @php
    use App\Models\Boton;
    $plantilla = Boton::find(2);
  @endphp
  <details>
    <summary>Formulario</summary>
    <form class="mx-2" method="POST" action="{{ route('botones.store') }}">
      @csrf
        <input type="hidden" name="user_id" value={{ auth()->user()->id }}/>
        <input type="hidden" name="tipoBt_id" value=2 />
        <input type="hidden" name="items" value=null />

        
        
        <label class= "d_block mt-2" for="bt_name"><strong>Nombre del botón</strong></label>
        <input  class="d_block" type="text" name="bt_name" value="{{ $plantilla->bt_name }}" />
        @error('bt_name')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror

        <label class= "d_block mt-2" for="descripcion"><strong>Descripción</strong></label>
        <input class="d_block" type="text" name="descripcion" value="{{ $plantilla->descripcion }}" />
        @error('descripcion')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror
        <div class="grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label class= "d_block mt-2" for="default"><strong>Valor inicial</strong></label>
            <input class="d_block" type="text" name="default" value= {{$plantilla->default}} />
            @error('default')
                <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div>
            <label class= "d_block mt-2" for="v_last"><strong>Valor final</strong></label>
            <input class="d_block" type="text" name="v_last" value= {{$plantilla->v_last}} />
            @error('v_last')
                <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
        </div>
        <label class= "d_block mt-2" for="pasos"><strong>Pasos</strong></label>
        <input class="d_block" type="text" name="pasos" value= {{$plantilla->pasos}} />
        @error('pasos')
            <small class="t_red">* {{ $message }}</small><br>
        @enderror
      {{-- </div> --}}
      <div>
        <button type="submit" 
            title="clonar booleano" 
            class="bt_xxl mt-6 default">Guardar</button>
        </div>
    </form>
    </details>