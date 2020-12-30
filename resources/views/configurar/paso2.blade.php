
{{-- @section('paso2') --}}

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{ __('First step')}} ✅ </p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📚  </span>{{ __('Subjects') }}  </h3>
      </div>
    </div>
    <div class="ml-1 mt-2">
        {{-- <a href="{{route('materias.index')}}" class="bt_pasos boton bt_xxl secondary">👀 {{ __('Show') }} {{ __('My') }} {{ __('Subjects') }}  </a>} --}}
                <a href="{{route('materias.index')}}" class="bt_pasos w-24 mx-auto boton circle secondary"><span class="ico-shadow">👀  </span> </a>
    </div>
  </div>
{{-- style="background-color:hsl(61, 86%, 77%)"> --}}
  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"  style="background-color:#ffee00;">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class=" text-gray-800 dark:text-white">{{ __('Second step') }} </p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📅 </span>{{ __('Timetable')}}</h3>
      </div>
    </div>

    <div class="ml-1 mt-2">
        <a class="bt_pasos boton  secondary-reves" href="{{route('sesions.index')}}">{{ __('Add') }} {{ __('Timetable') }}</a>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l"  style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{__('Third step')}}</p>
        <h3 class="pasos-title-2"><span class="ico-shadow">😶  </span>{{ __('Groups') }} </h3>
      </div>
    </div>
    <div class="ml-1 mt-2">
        <button class="bt_pasos boton disabled d_block" disabled >{{ __('Add') }} {{ __('Group') }}</button>
    </div>
  </div>


{{-- @show --}}