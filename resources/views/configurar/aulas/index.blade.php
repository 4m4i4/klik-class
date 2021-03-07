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
            <h2 class="title" >Mis Aulas</h2>
            <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit" 
                      title= "Atrás: grupos"  
                      class="ml-1 btn atras">
                      <span class="ico-shadow"> 👈</span>
                      <span>  Atrás</span>
                    </button> 
            </form>
            <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                  @csrf
                  @method("PUT")
                    <button type="submit"
                      title="Ir a introducir horas de sesión" 
                      class="ml-1 btn continuar">
                      <span class="ico-shadow">✅ </span> Continuar 
                      <span class="ico-shadow"> 👉 </span>
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
              </caption>
              <thead>
                <tr>
                  <th class="id">Id</th>
                  <th title="Nombre del aula">Aula</th>
                  <th title="Columnas/Filas">Cols/Filas</th>
                  <th title="Mesas/Estudiantes">Mesas/Pers</th>
                  <th title="Configurar aula">Editar</th>
                  <th title="Ver mesas y aula">Ver Aula</th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $aulas as $aula)
                
                  <tr>
                    <td class="id"><!-- Aula-id -->
                        {{ $aula->id }}
                    </td>
                    <td>
                        {{ $aula->aula_name }}
                    </td>
                    <td>
                        {{ $aula->num_columnas }}/{{$aula->num_filas }}
                    </td>
                    <td>
                        {{ $aula->num_mesas }}/
                         @php $clase = $aula->clase;@endphp
                          {{-- {{$aula->clase.'materia_id'}} --}}
                          {{-- {{$aula->clase()->materia_id}} --}}
                          {{-- /{{$aula->mesas->estudiantes->count()}} --}}
                          {{-- /{{$aula->clase->materia->estudiantes->count()}} --}}
                    </td>
                    <td>
                      <a href="{{ route('aulas.edit', $aula) }}" 
                        title= "Editar aula {{ $aula->aula_name }}" 
                        class="btn editar">
                        <span class="ico-shadow"> 📝 </span>
                        <span class="bt-text-hide">Editar </span>
                      </a>
                    </td>
                    <td>
                      <a href="{{ route('aulas.show', $aula) }}" 
                        title = "Ver aula {{ $aula->aula_name }}"
                        class="btn ver" >
                        <span class="ico-shadow">👀 </span>
                        <span class="bt-text-hide">{{ __('Show')}} </span>
                      </a>
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