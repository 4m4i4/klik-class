
@section('paso1')

  <div class="p-6 m-1" style="background-color:hsl(61, 86%, 77%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class="text-gray-900 dark:text-white">{{ __('First step') }}<br>{{ __('My subjects') }}  </a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        <button id="datos1" class="boton bt_xxl secondary-reves" onclick="document.getElementById('crear_materia').style.display='block'">{{ __('Add') }} {{ __('Subject') }}</button>
                                    
        <button id="datos1all" class="boton bt_xxl secondary-reves" onclick="document.getElementById('crear_materiaAll').style.display='block'">{{ __('Add all') }} {{ __('My subjects') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l  m-1" style="background-color:hsl(204, 45%, 95%)" >
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        {{ __('Second step') }} <br>{{ __('My timetable')}}</a></a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        <button id="datos2" class="boton disabled bt_xxl" disabled onclick="document.getElementById('crear_horario').style.display='block'">{{ __('Add') }} {{ __('Timetable') }}</button>
      </div>
    </div>
  </div>

  <div class="p-6 border-t border-gray-200 dark:border-gray-700  md:border-t-0 md:border-l  m-1" style="background-color:hsl(204, 45%, 95%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class=" text-gray-900 dark:text-white">{{__('Third step')}}:<br>{{ __('My groups') }}</a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
        <button id="datos3" class="boton disabled bt_xxl" disabled >{{ __('Sit down students') }}</button>
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



@show



