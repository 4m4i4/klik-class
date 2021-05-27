{{-- 'sesions.create' --}}
@extends('layouts.app')

@section('tablas')
        @php
        $user=auth()->user()->id;
          use App\Models\Sesion;
          $sesiones = Sesion::where('user_id',$user)->get();
          $num_sesiones= $sesiones->count();
        @endphp
      <p id="id_sesion"><p>          
<div class="nomodal">
  @include('include.formBanner')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">Introducir horario: Sesión {{ $num_sesiones+1}}</h3>
      </div>
      <form class="px-6" method="post" action="{{ route('sesions.store') }}">
        @csrf
        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" 
           value={{ auth()->user()->id }} readonly />
        </div>
        <label for="siguiente"><b></b></label>
            <input type="hidden" id="siguiente" value="{{ $siguiente }}" >
        <div class="pb-6 grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="inicio"><b>Empieza:</b></label>
            @if ($errors->any())
            <input type="time" id="inicio" value="{{ old('inicio') }}" name="inicio" autofocus class="d_block" >
            @else
            <input type="time" id="inicio" value="{{ $siguiente }}" name="inicio" autofocus class="d_block" >
            @endif
          </div>
          <div class="ml-1">
            <label for="fin"><b>Acaba: </b></label>
            <input type="time" id="fin" value="{{ old('fin') }}" name="fin" autofocus class="d_block" >

          </div>
        </div>
        <div>
          @error('inicio')
              <small class="t_red">* {{ $message }}</small><br>
          @enderror
        </div>
        <div>
            @error('fin')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
        </div>
      
        <div class="mt-4">
            <details class="mt-2">
              <summary>Truco:</summary>
              <p class="mt-2">
                Escribe la hora de inicio. Pulsa <kbd>Tab</kbd> (moverá el cursor) y podrás para escribir la hora final.</p>
              <p class="mt-2">
                Pulsa <kbd>Tab</kbd> <strong>2 veces</strong> para seleccionar el botón. </p>
              <p class="mt-2">
                Pulsa <kbd>Enter</kbd> y se guardará.</p>
            </details>
          </div>
        <div>
        <button type="submit" 
          title="Guardar sesión"  
          class="bt_xxl mt-6 enviar">Guardar</button>
        </div>
      </form>
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="{{route('sesions.index')}}"
         title="Cancelar y volver al índice"
         class="boton d_inline cancelar" >Cancelar </a>

      </div>
    </div>
  </div>

@endsection