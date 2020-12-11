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
          <div class = "caja-header grid grid-cols-2-auto  items-center">
            <h2>{{ __('My Subjects')}}</h2>
            
              @php
                $user = auth()->user();  
              @endphp
               <div class= "grid grid-cols-2 justify-right">
                  @if($user->paso == 1)
                    <button class="mx-6 boton warning-reves"  title= "crear materia"  onclick="document.getElementById('crear_materia').style.display='block'">{{ __('Add')}} ✚</button>  
                    <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                      @csrf
                      @method("PUT")
                        <button type="submit" title= "Ir a paso 2: Lista de materias completada" class="ml-2 boton secondary-reves">✅ ¡He acabado! </button>
                    </form>
                  
                  @endif
                  @if($user->paso == 2)

                    <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                      @csrf
                      @method("PUT")
                        <button type="submit" title="Volver al primer paso" class="mx-6 btn warning"> {{ __('Go to') }} {{ __('Step') }} 1
                        </button> 
                    </form>
                    <a href="{{route('home')}}" class="ml-2 btn primary">✅ ¡He acabado! </a>

                  @endif
                  @if($user->paso > '2')
                  <span></span>
                    <a href="{{ route('home') }}" class=" btn primary">✅ ¡He acabado! </a>
                  @endif
                </div>

            </div>
          </div>

          <div class = "caja-body">
            <table class = "tabla table-responsive-sm">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>{{ __('Subject') }}</th>
                 
                  <th>{{ __('Group') }}</th>
                  <th>Aula</th>
                  @if($user->paso == '1')
                    <th class="bts_handleAction" colspan = "2">{{ __('Action') }}</th>
                  @endif
                </tr>
              </thead>
              <tbody>

                @foreach ( $materias as $materia)
                  <tr>
                    <td><!-- -id -->
                        {{ $materia->id }}
                    </td>
                    <td><!-- Materia -->
                        {{ Str::before($materia->materia_name," ") }}
                    </td>
                    <td><!-- Grupo -->
                      @if($user->paso == '3')
                        {{-- se comprueba si los estudiantes están ya registrados --}}
                        @php
                          $isStudent= DB::table('estudiantes')->where('materia_id', $materia->id)->first();
                        @endphp
                          {{-- si no lo están, se enlaza el formulario para introducir el grupo de estudiantes --}}
                        @if ($isStudent==null)
                          <a href="#" id="{{$materia->grupo}}_{{$materia->id}}" class="btn warning-reves"  onclick="estudiantesModal(this.id)">✚ {{ __('Add')}} {{ __('Students to')}} {{ $materia->grupo }}</a>
                          </td>
                          <td><!-- Aula -->
                            {{ $materia->grupo}}
                          </td>
                          
                        
                        @elseif($isStudent!==null)
                          {{-- si existen se marca como hecho y se enlaza el formulario para actualizar el aula --}}
                          @php
                          $countStudents= DB::table('estudiantes')->where('materia_id', $materia->id)->count();
                          @endphp
                            ✅ {{ $materia->grupo }}: {{ $countStudents}} estudiantes
                          @php
                          $esteAula= DB::table('aulas')->where('aula_name',$materia->grupo)->first();
                          @endphp
                          </td>
                          <td><!-- Aula -->
                             <a href="{{ route('aulas.edit', $aula->id) }}" title = "Edita columnas, filas y mesas del aula= {{ $aula->id }}" class = "btn naranja">📝 {{ $aula->aula_name}}</a>
                          </td>
                        @endif
                      @endif
                      @if($user->paso !== '3')
                        {{ $materia->grupo }}
                      <td><!-- Aula -->
                        {{ $materia->grupo}}
                      </td>
                    @endif
                      
                   
                    @if($user->paso == '1')
                      <td>
                        <a href = "{{ route('materias.edit', $materia->id) }}" title = "Editar materia id= {{ $materia->id }}" class = "boton naranja">📝 {{ __('Edit') }} </a>
                      </td>
                      <td>
                        <form action="{{ route('materias.destroy', $materia->id) }}" method="POST">
                          @csrf
                          @method('delete')
                            <button type="submit" class="boton fucsia" title = "Borrar materia id= {{ $materia->id }}" >❌ {{ __('Delete') }}</button>
                        </form>
                      </td>
                    @endif

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <script>
      function estudiantesModal(valor_id){
        let ar_id = valor_id.split('_');
        let grupo = ar_id[0];
        let materia_id = ar_id[1];
        document.getElementById("ver_materia_id").innerHTML = grupo+", materia id: "+materia_id ;
        document.getElementById("materia_id").value = materia_id;
        document.getElementById('crear_estudiantes').style.display = 'block';
      }
      </script>

      <div id="crear_materia" class="modal">
        @include('configurar/materias/create')
      </div>

      <div id="crear_sesiones" class="modal">
        @include('configurar/sesions/create')
      </div>
      <div id="crear_estudiantes" class="modal">
        @include('configurar/estudiantes/create')
      </div>
      {{-- <div id="editar_aula" class="modal">
        @include('configurar/aulas/edit')
      </div> --}}
    </div>
  </div>
        
@endsection