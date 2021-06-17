{{-- estudiantes.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">

    @if(session()->get('info'))
        <div class = "text-center alert alert-info">
          {{ session()->get('info') }}  
        </div>
    @endif
    <div class = "">
      <div class="caja">  <!-- CABECERA estudiantes -->
        <div class = "caja-header">
          @if (request()->is('mostrar/estudiantes/*'))
            <div class = "grid grid-cols-5-fr w-100 items-center justify-beetween">
              <h2 class="title">{{$num_estudiantes}} {{ __('Students')}}</h2>
              <a href="{{route('materias.index')}}"
                title="Volver a la página anterior" 
                class="btn atras">
                <span class="ico-shadow"> 👈 </span><span class="bt-text-hide">
                {{__('Previous')}}</span>
              </a>
              <select id="materia_id" 
                name = "materia_id" 
                value = "{{ $materia_id }}" 
                class = "d_block" 
                onchange = "seleccionaMateria(this.id)">
                @foreach ($materias as $laMateria)
                  <option value = {{$laMateria->id}} {{$laMateria->id== $materia_id? 'selected' : ''}}>{{$laMateria->materia_name}}</option>
                @endforeach
              </select>
              <a href="#"
                id="{{$materia->materia_name}}_{{$materia->id}}" 
                title="Añadir estudiantes de {{$materia->grupo }}" 
                class="btn crear" 
                onclick="estudiantesModal(this.id)">
                <span class="ico-shadow"> + </span><span class="bt-text-hide">
                {{ $materia->grupo }} {{__('Add')}}</span>
              </a>
              <form action="{{ route('estudiantes.borrarGrupo', $materia_id) }}" method="POST">
                @csrf
                @method('DELETE')
                  <button type="submit" 
                    class="btn borrar" 
                    title="Borrar grupo">
                    <span class="ico-shadow"> ❌ </span>
                    <span class="bt-text-hide">{{ __('Delete') }} {{ __('Group') }}</span>
                  </button>
              </form>
            </div>
          @endif
          @if (request()->is('configurar/estudiantes'))
            <div class = "grid grid-cols-3-fr w-100 items-center">
              <h2 class="title">Estudiantes</h2>
              <a href="{{route('materias.index')}}" 
                title="Volver a la página anterior" 
                class="btn atras">
                <span class="ico-shadow"> 👈 </span>
                {{__('Previous')}}
              </a>
            </div>
          @endif
        </div>
      </div>       <!-- fin de CABECERA estudiantes -->
      <div class="caja ">  <!--body-TABLA estudiantes -->
        <div class = "caja-body">
          <table class = "tabla table-responsive mx-auto">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Surnames') }}</th>
                  <th>{{ __('Edit') }}</th>
                  <th>{{ __('Delete') }}</th>
              </tr>
            </thead>
            <tbody>
              @if (request()->is('configurar/estudiantes'))
                @foreach ($estudiantes as $estudiante)
                 <tr>
                  <td><!-- -id -->
                    {{ $estudiante->id }}
                  </td>
                    <!-- Nombre -->
                  <td title="{{$estudiante->nombre_completo }}">
                    {{$estudiante->nombre }}
                  </td>
                  <td><!-- Apellidos -->
                    {{$estudiante->apellidos }}
                  </td>
                  <td>
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" 
                      class= "editar btn" 
                      title= "Editar estudiante id= {{ $estudiante->id }}">
                      <span class="ico-shadow">📝 </span>
                      <span class="bt-text-hide ">{{ __('Edit') }}</span> 
                    </a>
                  </td>
                  <td>    <!-- Borrar -->
                    <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST">
                      @csrf
                      @method('delete')
                        <button type="submit" 
                          class="borrar btn" 
                          title="Borrar estudiante id= {{ $estudiante->id }}">
                          <span class="ico-shadow">❌ </span>
                          <span class="bt-text-hide text-overflow">{{ __('Delete') }}</span>
                        </button>
                    </form>
                  </td>
                </tr>
              @endforeach
              @endif
              @if (request()->is('mostrar/estudiantes/*'))
              @foreach ($materia->estudiantes as $estudiante)
              
                <tr>
                  <td><!-- -id -->
                    {{ $estudiante->id }}
                  </td>
                    <!-- Nombre -->
                  <td title="{{$estudiante->nombre_completo }}">
                    {{$estudiante->nombre }}
                  </td>
                  <td><!-- Apellidos -->
                    {{$estudiante->apellidos }}
                  </td>
                  <td>
                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}" 
                      class= "editar btn" 
                      title= "Editar estudiante id= {{ $estudiante->id }}">
                      <span class="ico-shadow">📝 </span>
                      <span class="bt-text-hide ">{{ __('Edit') }}</span> 
                    </a>
                  </td>
                  <td>    <!-- Borrar -->
                    <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST">
                      @csrf
                      @method('delete')
                        <button type="submit" 
                          class="borrar btn" 
                          title="Borrar estudiante id= {{ $estudiante->id }}">
                          <span class="ico-shadow">❌ </span>
                          <span class="bt-text-hide text-overflow">{{ __('Delete') }}</span>
                        </button>
                    </form>
                  </td>
                </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
         @if (request()->is('configurar/estudiantes'))
          <div id= "paginar" class=" mx-auto">{{ $estudiantes->links() }}</div>
        @endif
         
      </div>      
      <div class="h-8"></div>
    </div>
    <div id="crear_estudiantes" class="modal">
        @include('configurar/estudiantes/create')
    </div>

  </div>
@endsection
@section('script')
  <script>
    var value_materia_id = '';
    function seleccionaMateria(cadena){
      let x = document.getElementById(cadena);
      value_materia_id = x.value;
      console.log("valor: "+value_materia_id);
      document.getElementById(cadena).value = value_materia_id;
      var xhr = new XMLHttpRequest();
      xhr.open('POST',`{{route('materias.index')}}`,true);
      xhr.setRequestHeader('Content-Type','application/json');
      xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      // xhr.onreadystatechange = function(){
      //   document.getElementById('respuesta').innerHTML = xhr.responseText;
      // }
      xhr.send(location.replace(value_materia_id));
    }

    
          function estudiantesModal(valor_id){
            let ar_id = valor_id.split('_');
            let grupo = ar_id[0];
            let materia_id = ar_id[1];
            document.getElementById("ver_grupo").innerHTML = grupo ;
            document.getElementById("create_materia_id").value = materia_id;
            document.getElementById('crear_estudiantes').style.display = 'block';
          }
      
  </script>
@endsection