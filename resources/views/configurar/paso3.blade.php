
@section('paso3')

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1" style="background-color:hsl(204, 45%, 95%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{ __('First step')}}<span class="ico-shadow"> ✅ </span></p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📚 </span>{{ __('Subjects') }}  </h3>
      </div>
    </div>
    <div class="ml-1 mt-2">
        <a href="{{route('materias.index')}}" class="bt_pasos w-24 mx-auto boton circle secondary"><span class="ico-shadow">👀  </span> </a>
        {{-- <a href="{{route('materias.index')}}" class="bt_pasos boton bt_xxl secondary-reves" >👀 {{ __('Show') }} {{ __('My') }} {{ __('Subjects') }} </a> --}}
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" style="background-color:hsl(204, 45%, 95%)">
     <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="text-gray-800 dark:text-white">{{ __('Second step') }}<span class="ico-shadow"> ✅  </span></p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📅 </span>{{ __('Timetable')}}</h3>
      </div>
    </div>

    <div class="ml-1 mt-2">

        <a href="{{route('clases.index')}}" class="bt_pasos w-24 mx-auto boton circle secondary">👀   </a>

    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l" style="background-color:hsl(61, 86%, 77%)">
    <div class="flex">
      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class=" text-gray-800 dark:text-white">{{__('Third step')}}</p>
        @if(auth()->user()->paso==4)
          <h3 class="pasos-title-2"><span class="ico-shadow">😶 </span>{{ __('My Groups') }}</h3>
        @endif
        @if(auth()->user()->paso==5)
          <h3 class="pasos-title-2"><span class="ico-shadow">😶 </span>{{ __('My') }} {{ __('Classrooms') }}</h3>
        @endif
      </div>
    </div>
    <div class="ml-1 mt-2">
        @if(auth()->user()->paso==4)
          <a class="bt_pasos boton d_block secondary-reves" href="{{route('materias.index')}}">{{ __('Add') }} {{ __('Groups') }}</a>
        @endif
        @if(auth()->user()->paso==5)
          <a class="bt_pasos boton d_block secondary-reves" href="{{route('aulas.index')}}">{{ __('Configure') }} {{ __('Classrooms') }}</a>
        @endif
    </div>
  </div>


@show
