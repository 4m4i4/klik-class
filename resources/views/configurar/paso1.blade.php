
@section('paso1')

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:hsl(61, 69%, 84%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class="text-gray-900 dark:text-white">{{ __('First step') }}<br>{{ __('My subjects') }}  </a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <button class="boton bt_xxl secondary-reves" onclick="document.getElementById('crear_materia').style.display='block'">{{ __('Add') }} {{ __('Subject') }}</button>
                                    
        <button id="datos1all" class="boton bt_xxl secondary-reves" onclick="document.getElementById('crear_materiaAll').style.display='block'">{{ __('Add all') }} {{ __('My subjects') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" style="background-color:  hsl(204,45%,95%)" >
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        {{ __('Second step') }} <br>{{ __('My timetable')}}</a></a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <button id="datos2" class="boton disabled bt_xxl" disabled onclick="document.getElementById('crear_horario').style.display='block'">{{ __('Add') }} {{ __('Timetable') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700  md:border-t-0 md:border-l  " style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class=" text-gray-900 dark:text-white">{{__('Third step')}}:<br>{{ __('My groups') }}</a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <button id="datos3" class="boton disabled bt_xxl" disabled >{{ __('Add') }} {{ __('Group') }}</button>
      </div>
    </div>
  </div>

  <div id="crear_materia" class="modal">
    {{-- @include('configurar/materias/create') --}}
      <div class="modal-content animate-zoom" style="max-width:320px">
        <div class= "center py-4">
          <span onclick="document.getElementById('crear_materia').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
        </div>
        <form class="px-4" method="POST" action="{{ route('materias.store') }}">
        @csrf
          <div class="py-6">
            <label for="materia_name"><b>Materia</b></label>
            <input type="text" class="d_block" placeholder="materia cursoLetra etapa" autofocus name="materia_name">
            @error('materia_name')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror            
            <small><strong>Ejemplos:</strong> arte 2a bach, ingles 3c eso.</small>

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



