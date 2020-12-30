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
                    <h2 class="ml-4"> {{ __('My')}} {{ __('Subjects')}}</h2>

                    <a class="ml-1 btn inline warning-reves"  title= "crear materia" href="{{route('materias.create')}}">  {{ __('Add')}} <span class="ico-shadow"> 📚</span></a>
                    <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" title="Ir al siguiente paso: Lista de materias completada" class="ml-1 btn warning-reves"><span class="ico-shadow">✅ </span> Finalizar <span class="ico-shadow">👉 </span>  </button>
                    </form>
                  @endif
                  @if($user->paso == 2)
                  <!--bucle crear sesiones.  -->
                    <h2 class="ml-4">{{ __('My')}} {{ __('Subjects')}}</h2>

                    <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" title="Volver al primer paso" class="mx-6 btn blue-reves"> Atrás
                        </button> 
                    </form>
                    <a href="{{route('home')}}" class="ml-2 btn warning-reves"><span class="ico-shadow">✅ </span> Finalizar <span class="ico-shadow">👉 </span></a>

                  @endif
                  @if($user->paso == 3)
                    <h2 class="ml-4">{{ __('My Subjects')}}</h2>

                    <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" title= "Ir a paso 4" class="ml-2 btn blue-reves"><span class="ico-shadow">✅ </span> Finalizar <span class="ico-shadow">👉 </span>  </button>
                    </form>
                    <a href="{{ route('home') }}" class=" btn warning-reves">✅ {{ __('Go to') }} {{ __('Step') }} 4</a>
                  @endif
                  @if($user->paso == 4)
                    <h2 class="ml-4">{{ __('My Groups')}}</h2>
                      
                      <a href="{{ route('estudiantes.index') }}" class=" btn blue-reves"> Ver listas <span class="ico-shadow"> 📜</span></a>
                      <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                        @csrf
                        @method("PUT")
                        <button type="submit" title= "Ir a paso 5" class="ml-2 btn warning-reves"><span class="ico-shadow">✅ </span> Finalizar <span class="ico-shadow">👉 </span></button>
                      </form>
                  @endif
            </div>
          </div>
        </div>       <!--fin de CABECERA control-->

        <div class="caja">  <!--body-TABLA control-->
          <div class = "caja-body py-2">
            <table class = "tabla table-responsive mx-auto">
              @if($user->paso < 4)
                <caption>
                  Puedes <strong>Añadir </strong>, <strong>Editar</strong>, y <strong>Borrar</strong>  las materias. <br>Pulsa <strong>Finalizar </strong> cuando hayas acabado
                </caption>
              @endif
              @if($user->paso == 4)
                <caption>Pulsa <strong>Añadir Estudiantes</strong> para introducir cada grupo. <br>Pulsa <strong>Finalizar </strong> cuando hayas acabado.</caption>
              @endif
              <thead>
                <tr>
                  <th>Id</th>
                  <th>{{ __('Subject') }}</th>
                  <th>{{ __('Groups') }}</th>
                  <th>{{ __('Classrooms') }}</th>
                  @if($user->paso == 1)
                    <th class="bts_handleAction" colspan = "2">{{ __('Action') }}</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ( $materias as $materia)
                  <tr>
                        <td>   <!-- -id -->
                          {{ $materia->id }}
                        </td>
                        <td>   <!-- Nombre de Materia -->
                          {{ Str::before($materia->materia_name," ") }}
                        </td>
                        <td>   <!-- Grupo -->

                    @if($user->paso == '4')
                          {{-- se comprueba si los estudiantes de esa materia están ya registrados --}}
                          @php
                            $isStudent= $materia->estudiantes()->where('materia_id', $materia->id)->first();
                          @endphp
                          {{-- si no lo están, enlaza el formulario para crear el grupo de estudiantes --}}
                      @if($isStudent==null)
                          <a href="#" id="{{$materia->grupo}}_{{$materia->id}}" class="btn naranja"  onclick="estudiantesModal(this.id)"><span class="ico-shadow"> ✚ </span>{{ __('Add')}} {{ __('Students to')}} {{ $materia->grupo }}</a>
                        </td>
                        <td>    <!-- Aula -->
                            {{ $materia->grupo}}
                        </td>
                      @elseif($isStudent!==null)
                          {{-- si existen se marca como hecho y se enlaza el formulario para actualizar el aula --}}
                          @php
                            $countStudents=$materia->estudiantes()->where('materia_id', $materia->id)->count();
                            $aula=DB::table('aulas')->where('aula_name',$materia->grupo)->first();
                          @endphp
                            ✅ <a href="{{ route('estudiantes.porMateria', $materia->id) }}" class="btn default"  title = "ver lista de estudiantes de= {{ $materia->id }}"><span class="ico-shadow">👀 </span>{{ $materia->grupo }}</a>: {{ $countStudents}} estudiantes
                        </td>
                        <td>    <!-- Aula -->
                        <a href="{{ route('aulas.edit', $aula->id) }}" class = "btn naranja"> <span class="ico-shadow"> 📝 </span>{{$aula->aula_name}}</a>
                         ....

                        </td>
                      @endif
                    @endif
                    @if($user->paso !== '4')
                            {{ $materia->grupo }}
                        <td>   <!-- Aula -->
                            {{ $materia->grupo}}
                        </td>
                    @endif
                      
                   
                    @if($user->paso == '1')   <!-- botones EDIT DELETE -->
                        <td>
                          <a href = "{{ route('materias.edit', $materia->id) }}" title = "Editar materia id= {{ $materia->id }}" class = "btn naranja">
                            <span class="ico-shadow"> 📝 </span>
                            <span class="bt-text-hide">{{ __('Edit') }}</span> 
                          </a>
                        </td>
                        <td>
                          <form action="{{ route('materias.destroy', $materia->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            {{-- @php
                            DB::table('aulas')->where('aula_name',$materia->grupo)->delete();
                            @endphp --}}
                            <button type="submit" class="btn fucsia" title = "Borrar materia id= {{ $materia->id }}">
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
        </div>       <!--fin de body-TABLA control-->
      </div>

      <script>
          function estudiantesModal(valor_id){
            let ar_id = valor_id.split('_');
            let grupo = ar_id[0];
            let materia_id = ar_id[1];
            document.getElementById("ver_materia_id").innerHTML = grupo ;
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