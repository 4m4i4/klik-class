{{-- aulas.index --}}
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
          <div class = "grid grid-cols-3-fr items-center">
              @php
                  $user = auth()->user();  
              @endphp            
            <h2>Mis Aulas</h2>
            <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Atrás: grupos"  class="mx-6 btn blue"><span class="ico-shadow"> 👈</span>  Atrás
                    </button> 
            </form>
            <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" title= "Siguiente"  class="mx-6 btn blue">✅ </span> Siguiente  <span class="ico-shadow">👉 </span>  
                    </button> 
            </form> 
          </div>
        </div>
      </div>      <!-- fin de CABECERA aulas-->

      <div class="caja">  <!--body-TABLA aulas-->

          <div class = "caja-body py-2">
            <table class = "tabla table-responsive mx-auto">
              <caption>
              Haz click en <strong>Editar</strong> para actualizar los datos del aula-<br> 
              Para <strong>Cambiar </strong> un horario haz click sobre él
              </caption>
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Aula</th>
                  <th>Número de columnas</th>
                  <th>Número de filas</th>
                  <th>Número de mesas</th>
                  <th class="bts_handleAction" colspan = "2">Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $aulas as $aula)
                  <tr>
                    <td><!-- Aula-id -->
                        {{ $aula->id }}
                    </td>
                    <td>
                        {{ $aula->aula_name }}
                    </td>
                    <td>
                        {{ $aula->num_columnas }}
                    </td>
                    <td>
                        {{ $aula->num_filas }}
                    </td>
                    <td>
                        {{ $aula->num_mesas }}
                    </td>
                    <td>
                      <a href = "{{ route('aulas.edit', $aula->id) }}" title = "Editar" class = "btn naranja"><span class="ico-shadow"> 📝 </span><span class="bt-text-hide">Editar </a>
                    </td>
                    <td>
                      <form action="{{ route('aulas.destroy', $aula->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn fucsia" title = "Borrar aula id= {{ $aula->id }}"><span class="ico-shadow"> ❌ </span><span class="bt-text-hide">{{ __('Delete') }}</span></button>
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