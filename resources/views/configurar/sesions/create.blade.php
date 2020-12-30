{{-- 'sesions.create' --}}
@extends('layouts.app')

@section('tablas')
        @php
          use App\Models\Sesion;
          $sesiones = Sesion::get();
          $num_sesiones= $sesiones->count();
        @endphp
      <p id="id_sesion"><p>          
  <div>
    @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">Introducir horario de sesión {{ $num_sesiones+1}}</h3>
      </div>
      <form class="px-6" method="post" action="{{ route('sesions.store') }}">
        @csrf
        <div class="hidden"><!-- User_name -->
          <label for="user_id">user</label>
          <input type="text" name="user_id" 
           value={{ auth()->user()->id }} readonly />
        </div>
        <div class="pb-6 grid grid-cols-2 justify-between">
          <div class="mr-1">
            <label for="inicio"><b>Empieza:</b></label>
            <input type="time" id="inicio" value="{{ old('inicio') }}" name="inicio" class="d_block" >
            @error('inicio')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="ml-1">
            <label for="fin"><b>Acaba: </b></label>
            <input type="time" id="fin" value="{{ old('fin') }}" name="fin" class="d_block" >
            @error('fin')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
        </div>
        <div>
          <button type="submit" class="boton mt-6 d_block blue">Guardar</button>
        </div>
      </form>
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="{{route('sesions.index')}}" class="boton d_inline danger" title="Cancelar y volver al índice">Cancelar </a>
      </div>
    </div>
  </div>

@endsection