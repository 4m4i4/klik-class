@extends('layouts.app')

@section('content')

  <div class="container">
    <div class = "col-sm-12 text-center">
      @if(session()->get('success'))
        <div class = "alert alert-info">
          {{ session()->get('success') }}  
        </div>
      @endif
    </div>
    <div class = "row">

      <div class = "col-sm-12">
        <div class = "caja">
          <div class = "caja-header grid grid-cols-2 justify-between items-center">
            <h2>{{ __('My students')}}</h2>
            <a href="{{route('materias.index')}}" class="btn secondary">Añadir otro grupo</a>
              
            </div>
          </div>

          <div class = "caja-body">
            <table class = "tabla table-responsive-sm">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Surnames') }}</th>
                  <th>{{ __('Full name') }}</th>
                  <th>{{ __('Subject') }}</th>
                  

                </tr>
              </thead>
              <tbody>

                @foreach ( $estudiantes as $estudiante)
                  <tr>
                    <td><!-- -id -->
                        {{ $estudiante->id }}
                    </td>
                    <td><!-- Nombre -->
                        {{$estudiante->nombre }}
                    </td>
                    <td><!-- Apellidos -->
                         {{$estudiante->apellidos }}
                    </td>
                    <td><!-- Nombre completo -->
                      {{$estudiante->nombre_completo }}
                    </td>
                    <td><!-- Materia -->
                      {{$estudiante->materia->materia_name }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{-- <script>
              function estudiantesModal(valor_id){
                let ar_id = valor_id.split('_');
                let grupo = ar_id[0];
                let materia_id = ar_id[1];
                document.getElementById("ver_materia_id").innerHTML = grupo+", materia id: "+materia_id ;
                // document.getElementById("dia").value = dia_semana;
                document.getElementById("materia_id").value = materia_id;
                document.getElementById('crear_estudiantes').style.display = 'block';
              }

    
           </script> --}}

      {{-- <div id="crear_materia" class="modal">
        @include('configurar/materias/create')
      </div>

      <div id="crear_sesiones" class="modal">
        @include('configurar/sesions/create')
      </div>
      <div id="crear_estudiantes" class="modal">
        @include('configurar/estudiantes/create')
      </div> --}}
    </div>
  </div>
        
@endsection