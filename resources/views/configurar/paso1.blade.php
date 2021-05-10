
{{-- @section('paso1') --}}
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center" style="background-color:#ffee00;">
  
      <div class="ml-1 mt text-lg font-semibold">
        <p class="pasos-title-3">{{ __('First step') }}</p>
        <h3 class="pasos-title-2"><span class="ico-shadow">📚 </span>{{ __('My') }} {{ __('Subjects') }}  </h3>
      </div>

    <div class="ml-1 mt-2">
        @if($user->modo=="novel")
          <a href="{{route('materias.create')}}" title="Añadir Materia" class="bt_pasos boton oscuro">{{ __('Add') }} {{ __('Subject') }}</a>
        @elseif($user->modo=="avanzado")
          <a href="{{route('materias.createall')}}"  title="Añadir todas las materias" class="bt_pasos boton oscuro">{{ __('Add all') }} </a>
        @endif
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center" style="background-color:  hsl(182, 63%, 91%)" >

      <div class="ml-1 text-lg font-semibold">
       <p class="pasos-title-3"> {{ __('Second step') }} </p>
       <h3 class="pasos-title-2"><span class="ico-shadow">📅  </span>{{ __('My')}} {{ __('Timetable')}}</span></h3>
      </div>


    <div class="ml-1 mt-2">
        <button class="mx-auto  bt_pasos oscuro d_block disabled" disabled>{{ __('Add') }} {{ __('Timetable') }}</button>
    </div>
  </div>

  <div class="p-6 m-1 grid sm:grid-cols-2 md:grid-cols-1 items-center justify-center"  style="background-color:hsl(182, 63%, 91%)">

      <div class="ml-1 text-lg leading-7 font-semibold">
        <p class="pasos-title-3">{{__('Third step')}}:</p>
        <h3 class="pasos-title-2"><span class="ico-shadow">😶 </span>{{ __('My') }} {{ __('Groups') }}</h3>
      </div>


    <div class="ml-1 mt-2">
        <button class="mx-auto  bt_pasos oscuro d_block disabled" disabled >{{ __('Add') }} {{ __('Groups') }}</button>
    </div>
  </div>
<div class="h-8"></div>
