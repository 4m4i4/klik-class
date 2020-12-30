{{-- mesas.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">
      <!-- Información de los cambios que se han producido en el sistema al enviar el formulario-->
      @if(session()->get('success'))
        <div class = "alert alert-info">
          {{ session()->get('success') }}  
        </div>
      @endif

    <div class = "">

      <div class="caja">  <!--CABECERA aulas-->
        <div class = "caja-header">
          <div class = "grid grid-cols-4-fr items-center">
              @php
                  $user = auth()->user();  
              @endphp            
            <h2  class="ml-2" >Mis mesas</h2>

            <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Atrás: grupos"  class="mx-1 btn blue"><span class="ico-shadow"> 👈</span>  Atrás
                    </button> 
            </form>
            <a href="{{route('mesas.create')}}" title= "Añadir Mesa" class="btn warning"> ✚ {{ __('Add')}}</a>            
            <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Siguiente"  class="mx-1 btn blue">✅ </span> Siguiente  <span class="ico-shadow">👉 </span>  
                    </button> 
            </form> 
          </div>
        </div>
      </div>      <!-- fin de CABECERA aulas-->

      <div class="caja">  <!--body-TABLA aulas-->

          <div class = "caja-body py-2">
            <table class = "tabla table-responsive mx-auto">
              <caption>
              Haz click en <strong>Editar</strong> para actualizar los datos-<br> 
              </caption>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Columna</th>
                  <th>Fila</th>
                  <th>Ocupada</th>
                  <th>Aula</th>
                  <th>Clase</th>
                  <th>Estudiante</th>
                  <th class="bts_handleAction" colspan = "3">Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $mesas as $mesa)
                  <tr>
                    <td><!-- Mesa-id -->
                        {{ $mesa->id }}
                    </td>
                    <td>
                        {{ $mesa->columna }}
                    </td>
                    <td>
                        {{ $mesa->fila }}
                    </td>
                    <td>
                        {{ $mesa->is_ocupada }}
                    </td>
                    <td>
                        {{ $mesa->aula->aula_name }}
                    </td>
                    <td>
                        {{ $mesa->clase->sesion_id }}; {{ $mesa->clase->dia }}
                    </td>

                    <td>
                        {{ $mesa->estudiante->nombre }}
                    </td>
                    <td>
                      <a href = "{{ route('mesas.edit', $mesa->id) }}" title = "Editar" class = "btn naranja mx-1"><span class="ico-shadow"> 📝 </span><span class="bt-text-hide">Editar </a>
                    </td>
                    <td>
                      <form action="{{ route('mesas.destroy', $mesa->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn fucsia mx-1" title = "Borrar mesa id= {{ $mesa->id }}"><span class="ico-shadow"> ❌ </span><span class="bt-text-hide">{{ __('Delete') }}</span></button>
                      </form>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        
      </div>      <!-- fin de body-TABLA aulas-->
    </div>
  </div>
        
@endsection