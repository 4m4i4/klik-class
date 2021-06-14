{{-- mesas.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">
      <!-- Información de los cambios que se han producido en el sistema al enviar el formulario-->
      @if(session()->get('info'))
        <div class = "alert alert-info">
          {{ session()->get('info') }}  
        </div>
      @endif

    <div class = "">

      <div class="caja">  <!--CABECERA aulas-->
        <div class = "caja-header">
          <div class = "grid grid-cols-4-fr items-center">
              @php
                  $user = auth()->user();  
              @endphp            
            <h2  class="ml-2 title" >Mis mesas ({{$mesas->count()}})</h2>

            <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Atrás: grupos"  class="btn atras"><span class="ico-shadow"> 👈</span>  Atrás
                    </button> 
            </form>
            <a href="{{route('mesas.create')}}" title= "Añadir Mesa" class="btn crear"> ✚ {{ __('Add')}}</a>            
            <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Siguiente"  class="mx-1 btn continuar">✅ </span> Siguiente  <span class="ico-shadow">👉 </span>  
                    </button> 
            </form> 
          </div>
        </div>
      </div>      <!-- fin de CABECERA aulas-->

      <div class="caja">  <!--body-TABLA aulas-->

          <div class = "caja-body">
            <table class = "tabla table-responsive mx-auto">
              <caption>
              Haz click en <strong>Editar</strong> para actualizar los datos-<br> 
              </caption>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Columna</th>
                  <th>Fila</th>
                  <th>Ocupada</th>
                  <th>Aula</th>
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
                        {{ $mesa->mesa_name }}
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
                        {{!$mesa->estudiante==null ? $mesa->estudiante->id :"---" }}
                    </td>
                    <td>
                      <a href = "{{ route('mesas.edit', $mesa) }}" title = "Editar" class = "btn editar mx-1"><span class="ico-shadow"> 📝 </span><span class="bt-text-hide">Editar </a>
                    </td>
                    <td>
                      <form action="{{ route('mesas.destroy', $mesa) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn borrar mx-1" title = "Borrar mesa id= {{ $mesa->id }}"><span class="ico-shadow"> ❌ </span><span class="bt-text-hide">{{ __('Delete') }}</span></button>
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