
@section('paso1')

  <div class="p-6 m-1" style="background-color:hsl(61, 86%, 77%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class="text-gray-900 dark:text-white">{{ __('First step') }}<br>{{ __('Add my subjects') }} </a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        <button id="datos1" class="boton bt_xxl secondary" onclick="document.getElementById('crear_materia').style.display='block'">{{ __('Add subject') }}</button>
                                    
        <button id="datos1all" class="boton bt_xxl secondary" onclick="document.getElementById('crear_materiaAll').style.display='block'">{{ __('Add all subjects') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l  m-1" style="background-color:hsl(204, 45%, 95%)" >
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class=" text-gray-900 dark:text-white">{{ __('Second step') }}<br>Añadir mi horario</a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        <button id="datos2" class="boton disabled bt_xxl" disabled onclick="document.getElementById('crear_horario').style.display='block'">Crear horario semanal</button>
      </div>
    </div>
  </div>

  <div class="p-6 border-t border-gray-200 dark:border-gray-700  md:border-t-0 md:border-l  m-1" style="background-color:hsl(204, 45%, 95%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class=" text-gray-900 dark:text-white">Tercer paso:<br>Añadir mis grupos</a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        <button id="datos3" class="boton disabled bt_xxl" disabled >Sentar estudiantes</button>
      </div>
    </div>
  </div>

  <div id="crear_materia" class="modal">
    @include('configurar/materias/create')
  </div>
  {{-- @if(session()->get('no_success'))
      <div id="crear_materia" class="modal" style={{ session()->get('no_success') }}>
        @include('configurar/materias/create')
      </div>
  @endif --}}
  <div id="crear_materiaAll" class="modal">
    @include('configurar/materias/createall')
  </div>
  <div id="crear_aula" class="modal">
    @include('configurar/aulas/create')
  </div> 

  <div id="crear_horario" class="modal">
    {{-- @include('configuracion/_horario') --}}
  </div>
  
  <div id="poblar_clases" class="modal">
    {{-- @include('configurar/_materias') --}}
  </div>

@show



