
{{-- @extends('layouts.app')

@section('tablas') --}}


@extends('configurar.aulas.show') 

@section('content')
{{-- <div id="ver_modal" class="modal"> --}}
{{-- <div id="edit_vacias" class="modal"> --}}
<div class="nomodal">
          @include('include.formBanner')
            
              <div class="px-6 caja-header text-center">
                <h3>Cambiar Mesas Vacías<br></h3>
              </div>
              <form class="px-6" method="POST" action="" method="POST" >
              {{-- <form class="px-6" method="POST" action="{{route('aulas.updateMesasVacias', $aula) }}" method="POST" > --}}
                @csrf 
                    <!--*MOdal: La función claseModal(this.id) recoge la id del botón que hace la llamada (formada por los valores 'dia'_'sesion_id'), hace un innerHTML a los input y quita el display:none de la ventana modal-->
                  <div class=" grid grid-cols-3-auto">
                    <div class="d_inline w-5"><!-- $clase->user_id  -->
                      <label class="d_inline" for="user_id">User</label>
                      <input type="text" name="user_id" value={{ auth()->user()->id }} readonly class="w-5" />
                    </div>
                    <div class="d_inline w-5"><!-- $clase->user_id  -->
                      <label class="d_inline" for="user_id">User</label>
                      <input type="text" name="user_id" value={{ auth()->user()->id }} readonly class="w-5" />
                    </div>
                    <div class="d_inline w-5"><!-- $clase->user_id  -->
                      <label class="d_inline" for="user_id">User</label>
                      <input type="text" name="user_id" value={{ auth()->user()->id }} readonly class="w-5" />
                    </div>
                    </div>
                  <div>
                    <button type="submit" 
                     title="Guardar clase" 
                     class="bt_xxl mt-6 enviar">Guardar</button>
                  </div>
              </form>
              
              <div class="px-6 py-4 mt-6 light-grey">
                                {{-- <button onclick="document.getElementById('ver_modal').style.display='none'" 
                type="button" 
                title="Cancelar y volver al índice"  --}}
                 {{-- class="boton d_inline cancelar">Cancelar</button> --}}
                 <a href="{{url()->previous()}}"title="Cancelar y volver al índice" 
                 class="boton d_inline cancelar">Cancelar</a>
                {{-- <button onclick="document.getElementById('ver_modal').style.display='none'" 
                type="button" 
                title="Cancelar y volver al índice" 
                 class="boton d_inline cancelar">Cancelar</button> --}}
              </div>
          </div>  {{--  fin modal-content --}}
        {{-- </div>  fin modal --}}
        {{-- @show --}}
        @endsection