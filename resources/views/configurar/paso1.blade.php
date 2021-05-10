
{{-- @section('paso1') --}}
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:#ffee00;">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{ __('First step') }}</p>
        <h3 class="pasos-title-2">📚 {{ __('My') }} {{ __('Subjects') }}  </h3>
      </div>
    </div>

    <div class="ml-1 mt-2">
        @if($user->modo=="novel")
          <a href="{{route('materias.create')}}" class="bt_pasos boton bt_xxl secondary-reves">{{ __('Add') }} {{ __('Subject') }}</a>
        @elseif($user->modo=="avanzado")
          <a href="{{route('materias.createall')}}" class="bt_pasos boton bt_xxl secondary-reves" >{{ __('Add all') }} </a>
        @endif
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" style="background-color:  hsl(204,45%,95%)" >
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
       <p class="text-gray-800 dark:text-white"> {{ __('Second step') }} </p>
       <h3 class="pasos-title-2">📅  {{ __('My')}} {{ __('Timetable')}}</h3>
      </div>
    </div>

    <div class="ml-1 mt-2">
        <button class="bt_pasos boton disabled bt_xxl" disabled>{{ __('Add') }} {{ __('Timetable') }}</button>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700  md:border-t-0 md:border-l  " style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class=" text-gray-800 dark:text-white">{{__('Third step')}}:</p>
        <h3 class="pasos-title-2">😶 {{ __('My') }} {{ __('Groups') }}</h3>
      </div>
    </div>

    <div class="ml-1 mt-2">
        <button class="bt_pasos boton disabled bt_xxl" disabled >{{ __('Add') }} {{ __('Groups') }}</button>

    </div>
  </div>
{{-- @show --}}






