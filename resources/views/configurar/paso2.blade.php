
@section('paso2')


  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:hsl(204, 45%, 95%)">
    <div class="flex items-center">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{ __('First step') }}</p>
        <h3 class="pasos-title">📚 {{ __('My Subjects') }} </h3>
      </div>
    </div>
    <div class="ml-1">
      <div class="mt-2">
        <a href="{{route('materias.index')}}" class="bt_pasos boton bt_xxl secondary-reves">✅ {{ __('Show') }} {{ __('My Subjects') }} </a>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"  style="background-color:hsl(61, 86%, 77%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class=" text-gray-800 dark:text-white">{{ __('Second step') }} </p>
        <h3 class="pasos-title">📅 {{ __('My Timetable')}}</h3>
      </div>
    </div>

    <div class="ml-1">
      <div class="mt-2">
        <a class="bt_pasos boton bt_xxl secondary-reves" href="{{route('clases.index')}}">{{ __('Add') }} {{ __('Timetable') }}</a>
      </div>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"  style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class=" text-gray-800 dark:text-white">{{__('Third step')}}</p>
        <h3 class="pasos-title">😶  {{ __('My Groups') }} </h3>
      </div>
    </div>
    <div class="ml-1">
      <div class="mt-2">
        <button id="datos3" class="bt_pasos boton disabled bt_xxl" disabled >{{ __('Add') }} {{ __('Group') }}</button>
      </div>
    </div>
  </div>


{{-- 
  <div id="crear_materia" class="modal">
    @include('configurar/materias/create')
  </div> --}}

@show