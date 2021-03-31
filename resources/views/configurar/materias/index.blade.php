{{-- materias.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">
      <!-- Información de los cambios que se han producido en el sistema al enviar el formulario-->
    @if(session()->get('success'))
        <div class = "text-center alert alert-info">
          {{ session()->get('success') }}  
        </div>
    @endif

    <div class = "">
          
        <div class="caja">  <!--CABECERA control-->
          <div class = "caja-header">
            <div class = "grid grid-cols-3-fr items-center">
            
              @php
                $user = auth()->user();  
              @endphp

                  <!--cabeceras según paso -->
                  @if($user->paso == 1)  <!--bucle crear materias -->
                    <h2 class="title"> {{ __('My')}} {{ __('Subjects')}}</h2>

                    <a href="{{route('materias.create')}}"
                     title="Crear materia" 
                     class="btn crear">
                      {{ __('Add')}} 
                      <span class="ico-shadow"> 📚</span>
                    </a>
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
                  @endif
                  @if($user->paso == 2)
                    <h2 class="title">{{ __('My')}} {{ __('Subjects')}}</h2>

                    <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" title="Ir a introducir materias" class="ml-1 btn atras"><span class="ico-shadow"> 👈 </span> Atrás </button>
                    </form>
                    <a href="{{route('home')}}" 
                    title="Ir a home" 
                    class="ml-1 btn atras">
                      <span class="ico-shadow">✅ </span> 
                      Volver 
                      <span class="ico-shadow"> 👉 </span>
                    </a>

                  @endif
                  @if($user->paso == 3)
                    <h2 class="title"> {{ __('My')}} {{ __('Subjects')}}</h2>
                    <a href="{{ route('home') }}" title= "Volver a home" class="btn atras">Volver</a>
                    <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" 
                        title= "Ir a introducir grupos" 
                        class="ml-1 btn continuar">
                          <span class="ico-shadow">✅ </span> 
                          Continuar 
                          <span class="ico-shadow"> 👉 </span>
                        </button>
                    </form>

                  @endif
                  @if($user->paso >= 4)
                    <h2 class="title">{{ __('My Groups')}}</h2>
                      
                      <a href="{{ route('estudiantes.index') }}" class=" btn ver p-0"><p class="mt--1"><span class="ico-shadow">👀 </span> Ver listas <span class="ico-shadow"> 📜</span></p></a>
                      <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" 
                        title="Ir a configurar aulas"  
                        class="ml-1 btn continuar">
                          <span class="ico-shadow"> ✅ </span>
                           Continuar 
                          <span class="ico-shadow"> 👉 </span>
                        </button>
                      </form>
                  @endif
            </div>
          </div>
        </div>       <!--fin de CABECERA control-->

        <div class="caja">  <!--body-TABLA control-->
          <div class = "caja-body">
            <table class = "tabla table-responsive mx-auto">
                  <!--caption según paso -->
                @if($user->paso < 4)
                  <caption>
                    Puedes <strong>Añadir </strong>, <strong>Editar</strong>, y <strong>Borrar</strong>  las materias. <br> Pulsa <strong>Continuar </strong> cuando hayas registrado todas tus materias.
                  </caption>
                @endif
                @if($user->paso >= 4)
                <caption>Pulsa <strong>Añadir Estudiantes</strong> para introducir el grupo. Después, configura el <strong>aula</strong> pulsando el botón recién creado. Por último pulsa el botón <strong>Ver</strong> para sentar a los estudiantes.<br> Cuando los hayas registrado todos, pulsa <strong>Continuar</strong>.
                @endif

              <thead>
                <!-- Títulos de las columnas -->
                <tr>
                  <th class="id">Id</th>
                  <th>{{ __('Subject') }}</th>
                  <th>{{ __('Groups') }}</th>
                  <th>{{ __('Classrooms') }}</th>
                  @if($user->paso == 1)
                    <th>{{ __('Edit') }}</th>
                    <th>{{ __('Delete') }}</th>
                  @endif
                  @if($user->paso >= 4)
                    <th>Mesas</th>
                  @endif
                </tr>
              </thead>


              <tbody>
                @foreach ( $materias as $materia)
                  <tr>
                    <td class="id">   <!-- -id -->
                          {{ $materia->id }}
                    </td>
                    <td>   <!-- Nombre de Materia -->
                          {{ Str::before($materia->materia_name," ") }}
                    </td>
                      
                    @if($user->paso < 4)
                      <td>   <!-- Grupo -->
                          {{ $materia->grupo }}
                      </td>
                    @endif
                    @if($user->paso == 1) 
                      <td>  <!-- Aula -->
                          {{ $materia->grupo }}
                      </td>
                    @endif
                    @if($user->paso >= 4)
                          {{-- se comprueba si los estudiantes de esa materia están ya registrados --}}
                      @php
                        $isStudent = $materia->estudiantes()->where('materia_id', $materia->id)->first();
                      @endphp
                          {{-- si no lo están, se enlaza el formulario para crear el grupo de estudiantes --}}
                      @if($isStudent == null)
                        <td class="pt-03 mt-0">   <!-- Grupo -->  
                          <a href="#" id="{{$materia->grupo}}_{{$materia->id}}" title="Añadir estudiantes de {{$materia->grupo }}" class="d_block editar" onclick="estudiantesModal(this.id)">
                              {{-- Añadir Estudiantes a 
                             </a><p class="l-height mb-1"> {{ $materia->grupo }}</p> --}}
                             {{ $materia->grupo }} Añadir 
                          </a>
                        </td>
                        <td  class="pt-03 mt-0">        <!-- Aula -->
                            {{ $materia->grupo}}
                        </td>
                      @elseif($isStudent !== null)
                          {{-- si existen se marca como hecho y se enlaza el formulario para actualizar el aula --}}
                        @php
                          $countStudents = $materia->estudiantes()->where('materia_id', $materia->id)->count();
                          $aula = DB::table('aulas')->where('user_id',$user->id)->where('aula_name',$materia->grupo)->first();
                        @endphp
                                     <!-- Ver lista de estudiantes por materia -->
                                     {{-- <a href="{{ route('estudiantes.porMateria', $materia->id) }}" 
                            title="Ver lista de estudiantes de {{ $materia->grupo }}" class="d_block ver"
                            >
                              <span class="ico-shadow"> 👀 </span>
                              <span>{{ $materia->grupo }}</span>
                            </a><p class="l-height mb-1"> {{ $countStudents}} estudiantes ✅ </p> --}}
                        <td class="pt-2">   <!-- Grupo -->  
                          <a href="{{ route('estudiantes.porMateria', $materia->id) }}" 
                                title="Ver lista de estudiantes de {{ $materia->grupo }}" 
                                class="d_block ver pt-03">
                            <span class="ico-shadow"> 👀 </span>
                            <span>{{ $materia->grupo }} -  {{ $countStudents}}</span>
                          </a>
                               {{-- <p class="l-height mb-1"> {{ $countStudents}} estudiantes ✅ </p> --}}
                        </td>
                        <td class="pt-2">         <!-- Editar Aula -->
                          <a href="{{ route('aulas.edit', $aula->id) }}" 
                            class= "d_block editar pt-03" 
                            title="editar aula de {{$aula->aula_name}}">
                            <span class="ico-shadow"> 📝 </span>
                            <span>{{$aula->aula_name}}</span>
                          </a>
                        </td>
                        <td class="">        <!-- Mostrar la disposición de mesas en el aula -->
                          <a href="{{ route('aulas.show', $aula->id) }}" 
                            id="verMesasAula{{ $aula->id }}" 
                            class="d_block ver pt-03" 
                            title ="Ver mesas aula id= {{ $aula->id }}">
                              <span class="ico-shadow"> 👀 </span>
                              <span class="bt-text-hide">{{ __('Show')}} </span>
                          </a>
                        </td>
                      @endif
                    @endif
                    @if($user->paso !== 4)
                          
                        {{-- <td>   <!-- Aula -->
                            {{ $materia->grupo}}
                        </td> --}}
                    @endif
                      
                   
                    @if($user->paso == '1')   <!-- botones EDIT DELETE -->
                        <td>   <!-- Editar -->
                          <a href="{{ route('materias.edit', $materia) }}" 
                          class= "btn editar" 
                          title= "Editar materia id= {{ $materia->id}}">
                            <span class="ico-shadow"> 📝 </span>
                            <span class="bt-text-hide">{{ __('Edit') }}</span> 
                          </a>
                        </td>
                        <td>    <!-- Borrar -->
                          <form action="{{ route('materias.destroy', $materia) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" 
                            class="btn borrar" 
                            title="Borrar materia id= {{ $materia->id }}">
                              <span class="ico-shadow"> ❌ </span>
                              <span class="bt-text-hide">{{ __('Delete') }}</span>
                            </button>
                          </form>
                        </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>

            </table>

          </div>
        </div>   
        
            <!--fin de body-TABLA control-->
                <div class="h-8"></div>
      </div>

      <script>
          function estudiantesModal(valor_id){
            let ar_id = valor_id.split('_');
            let grupo = ar_id[0];
            let materia_id = ar_id[1];
            document.getElementById("ver_grupo").innerHTML = grupo ;
            document.getElementById("materia_id").value = materia_id;
            document.getElementById('crear_estudiantes').style.display = 'block';
          }
      </script>


      <div id="crear_estudiantes" class="modal">
        @include('configurar/estudiantes/create')
      </div>



    </div>  <!--fin de div-->
  </div>   <!--fin de container-->
        
@endsection
{{-- @show --}}