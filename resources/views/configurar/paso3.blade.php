
{{-- @section('paso3') --}}

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center" style="background-color:#00AACC">
      <div class=" ml-1 my-2 text-gray-200 text-lg font-semibold">
        <p class="pasos-title-3">{{ __('First step')}}<span class="ico-shadow"> ✅ </span></p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📚 </span>{{ __('Subjects') }}  </h3>
      </div>
      <div class="ml-1 my-2">
        <a href="{{route('materias.index')}}"  class="mx-auto  bt_pasos oscuro-reves"><span class="ico-shadow">👀  </span>Ver Materias</a>
      </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center"  style="background-color:#00AACC">
      <div class="ml-1 my-2 text-gray-200 text-lg font-semibold">
        <p class="pasos-title-3">{{ __('Second step') }}<span class="ico-shadow"> ✅  </span></p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📅 </span>{{ __('Timetable')}}</h3>
      </div>
      <div class="ml-1 my-2">
        <a href="{{route('horario')}}"  class="mx-auto  bt_pasos oscuro-reves"><span class="ico-shadow">👀  </span>Ver Horario</a>
      </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center" style="background-color: #ffee00">
      <div class="ml-1 my-2 text-lg font-semibold">
        <p class="pasos-title-3">{{__('Third step')}}</p>
          @if(auth()->user()->paso==4)
            <h3 class="pasos-title-2"><span class="ico-shadow">😶 </span>{{ __('My Groups') }}</h3>
          @endif
          @if(auth()->user()->paso==5)
            <h3 class="pasos-title-2"><span class="ico-shadow">😶 </span>{{ __('My') }} {{ __('Classrooms') }}</h3>
          @endif
      </div>

    <div class="ml-1 mt-2">
        @if(auth()->user()->paso==4)
          <a class="bt_pasos boton oscuro" href="{{route('materias.index')}}">{{ __('Add') }} {{ __('Groups') }}</a>
        @endif
        @if(auth()->user()->paso==5)
          <a class="bt_pasos boton oscuro" href="{{route('aulas.index')}}">{{ __('Configure') }} {{ __('Classrooms') }}</a>
        @endif
    </div>
  </div>

{{-- @show --}}
