{{-- 'sesions.create' --}}
@extends('layouts.app')

@section('tablas')
  <div class="nomodal">
    <div class="modal-content animate-zoom">
      <div class= "text-center py-4">
        <svg class="logoForm mt-4 mx-auto"
            width="100px" height="100px" 
            viewBox="0 0 512 512">
            <g id="circleLogo">
              <path id="mesa3" fill="#00DFE7" d="M507 208l-77 0 0 -140c39,36 67,85 77,140z"/>
              <path id="fondo" fill="#363636" d="M256 0c67,0 128,26 174,68l0 140 77 0c3,15 5,31 5,48 0,24 -3,48 -10,70l-72 0 0 89 -72 -113 78 -29 -123 -73 0 -155 -203 0c42,-28 92,-45 146,-45zm174 444c-46,42 -107,68 -174,68 -38,0 -75,-8 -107,-24l164 0 0 -153 70 111c3,5 11,7 16,3l28 -18c1,-1 2,-2 3,-3l0 16zm-388 -48c-27,-40 -42,-88 -42,-140 0,-52 15,-100 42,-140l0 92 188 0 11 118 -199 0 0 70z"/>
              <path id="mesa2" fill="#00ABD6" d="M42 326l199 0 6 69 64 -62 2 2 0 154 -164 0c-44,-21 -81,-53 -107,-93l0 -70z"/>
              <path id="mesa1" fill="#FFEE00" d="M110 45l203 0 0 155 -89 -52 6 60 -188 0 0 -92c18,-28 41,-52 68,-71z"/>
              <path id="mesa4" fill="#00ABD6" d="M430 326l72 0c-13,46 -38,86 -72,118l0 -16c2,-4 3,-9 0,-13l0 0 0 -89z"/>
              <path id="flecha" fill="#FF0066" d="M224 148l212 125 -78 29 72 113c3,6 2,13 -3,16l-28 18c-5,4 -13,2 -16,-3l-72 -113 -64 62 -23 -247z"/>
            </g>
        </svg>
      </div>
        @php
          use App\Models\Sesion;
          $sesiones = Sesion::get();
          $num_sesiones= $sesiones->count();
        @endphp
      <p id="id_sesion"><p>     
      <div class="px-6 caja-header text-center">
        <h3>
          <strong>Introducir horario de sesión {{ $num_sesiones+1}}</strong>
        </h3>
      </div>
       {{-- <a href="{{route('sesions.index')}}" class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
        <span onclick="document.getElementById('crear_sesiones').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
         <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4"> --}}

       {{-- @if ($errors->any())
         <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
          </ul>
         </div>
       @endif --}}

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
        {{-- <button onsubmit="document.getElementById('crear_sesiones').style.display='block'" class="boton d_block m_b15 blue" type="submit">Guardar</button> --}}
    

      <div class="px-6 py-4 mt-6 light-grey">
        <a href="{{route('sesions.index')}}" class="boton d_inline danger" title="Cancelar y volver al índice">Cancelar </a>
      </div>

    
       {{-- <div class="px-6 py-3 mt-4 light-grey">
         <button onclick="document.getElementById('crear_sesiones').style.display='none'" type="button" class=" boton danger">Cancel</button>
        </div> --}}
    </div>
  </div>
{{-- @show --}}
@endsection