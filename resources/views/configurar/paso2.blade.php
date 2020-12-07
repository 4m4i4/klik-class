
@section('paso2')


  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:hsl(204, 45%, 95%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class="text-gray-900 dark:text-white">{{ __('First step') }}<br>{{ __('My subjects') }} </a>
      </div>
    </div>
    <div class="ml-1">
      <div class="mt-2">
        <a href="{{route('materias.index')}}" class="boton bt_xxl secondary-reves">✅ {{ __('Show') }} {{ __('My subjects') }} </a>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"  style="background-color:hsl(61, 86%, 77%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <a href="#" class=" text-gray-900 dark:text-white">{{ __('Second step') }} <br>{{ __('My timetable')}}</a>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <a class="boton bt_xxl secondary-reves" href="{{route('clases.index')}}">{{ __('Add') }} {{ __('Timetable') }}</a>
        {{-- <a class="boton bt_xxl secondary" href="{{route('clases.create')}}">Crear clase</a> --}}
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"  style="background-color:hsl(204, 45%, 95%)">
    <div class="flex items-center">
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
    @include('configurar/materias/create')
  </div>
@show


