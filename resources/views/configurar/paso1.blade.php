
@section('paso1')

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:hsl(61, 86%, 77%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{ __('First step') }}</p>
        <h3 class="pasos-title">📚 {{ __('My Subjects') }}  </h3>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <button class="bt_pasos boton bt_xxl secondary-reves" onclick="document.getElementById('crear_materia').style.display='block'">{{ __('Add') }} {{ __('Subject') }}</button>
                                    
        <button id="datos1all" class="bt_pasos boton bt_xxl secondary-reves" onclick="document.getElementById('crear_materiaAll').style.display='block'">{{ __('Add all') }} {{ __('My Subjects') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" style="background-color:  hsl(204,45%,95%)" >
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
       <p class="text-gray-800 dark:text-white"> {{ __('Second step') }} </p>
       <h3 class="pasos-title">📅  {{ __('My Timetable')}}</h3>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <button id="datos2" class="bt_pasos boton disabled bt_xxl" disabled onclick="document.getElementById('crear_horario').style.display='block'">{{ __('Add') }} {{ __('Timetable') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700  md:border-t-0 md:border-l  " style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class=" text-gray-800 dark:text-white">{{__('Third step')}}:</p>
        <h3 class="pasos-title">😶 {{ __('My Groups') }}</h3>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <button id="datos3" class="bt_pasos boton disabled bt_xxl" disabled >{{ __('Add') }} {{ __('Group') }}</button>
      </div>
    </div>
  </div>

{{-- modal crear_materia--}}

  <div id="crear_materia" class="modal">
    {{-- @include('configurar/materias/create') --}}
      <div class="modal-content animate-zoom" style="max-width:320px">
        <div class= "center py-4">
          <span onclick="document.getElementById('crear_materia').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
        </div>
          <div class="px-6 caja-header text-center">
          <h3>
            <strong>Introducir materia </strong>
          </h3>
        </div>
        <form class="px-6" method="POST" action="{{ route('materias.store') }}">
        @csrf
          <div class="py-6">
            <label for="materia_name"><b>Materia</b></label>
            <input type="text" class="d_block" placeholder="materia cursoLetra etapa" autofocus value="{{ old('materia_name') }}"  name="materia_name">
            @error('materia_name')
              <small class="t_red">* {{ $message }}</small></p>
            @enderror            
            <small><strong>Ejemplos:</strong> arte 2a bach, ingles 3c eso.</small>

            <details class="mt-6">
              <summary class="py-4">Ayuda formato:</summary>
                <p class="mt-2">Utiliza el siguiente <strong>Esquema: </strong></p>              
                <div class="py-2">
                  <p class="py-2">Materia <kbd>space</kbd> CursoLetra <kbd>space</kbd> Etapa</p>
                </div>  
                  <p class="mt-2"><strong>Letras</strong> (A-Z, a-z) y <strong>Números</strong>(0-9). <strong>Sin tildes </strong> ni caracteres especiales </p>
            </details>
          </div>
          <div class="py-4 my-4">
            <button type="submit" class="boton d_block primary">Guardar</button>
          </div>
        </form>

        <div class="px-6 py-4 light-grey">
          <button onclick="document.getElementById('crear_materia').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div>
      </div>
  </div>

  <div id="crear_materiaAll" class="modal">
    @include('configurar/materias/createall')
  </div>


  <div id="crear_aula" class="modal">
    @include('configurar/aulas/create')
  </div> 

@show



