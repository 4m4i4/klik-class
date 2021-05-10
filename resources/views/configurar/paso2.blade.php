
{{-- @section('paso2') --}}

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center" style="background-color:#00AACC">
      <div class=" ml-1 my-2 text-gray-200 text-lg font-semibold">
        <p class="pasos-title-3 ">{{ __('First step')}} ✅ </p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📚  </span>{{ __('Subjects') }}  </h3>
      </div>

    <div class="ml-1 mt-2">
        <a href="{{route('materias.index')}}" title="Ver materias" class="mx-auto  bt_pasos oscuro-reves"><span class="ico-shadow">👀  </span>Ver </a>
    </div>
  </div>
{{-- style="background-color:hsl(61, 86%, 77%)"> --}}
  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center"  style="background-color:#ffee00">
      <div class=" ml-1 my-2 text-lg font-semibold">
        <p class="pasos-title-3">{{ __('Second step') }} </p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📅 </span>{{ __('Timetable')}}</h3>
      </div>


    <div class="ml-1 mt-2">
      @if(auth()->user()->paso==2)
        <a href="{{route('sesions.index')}}" title="Añadir horarios" class="bt_pasos boton oscuro">{{ __('Add') }} {{ __('Timetable') }}</a>
      @endif
      @if(auth()->user()->paso==3)
        <a href="{{route('clases.index')}}" title="Añadir clases" class="bt_pasos boton oscuro">Añadir Clases</a>
      @endif
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center"    style="background-color:  hsl(182, 64%, 91%)">
      <div class=" ml-1 my-2 text-lg font-semibold">
        <p class="pasos-title-3">{{__('Third step')}}</p>
        <h3 class="pasos-title-2"><span class="ico-shadow">😶  </span>{{ __('Groups') }} </h3>
      </div>
    <div class="ml-1 mt-2">
        <button class="mx-auto  bt_pasos oscuro d_block disabled" disabled >{{ __('Add') }} {{ __('Group') }}</button>
    </div>
  </div>