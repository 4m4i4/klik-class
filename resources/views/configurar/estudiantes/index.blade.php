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
            <div class = "grid grid-cols4 w-100 items-center">
              <h2>{{$materia->materia_name}}: {{$num_estudiantes}} {{ __('Students')}}</h2>
              <a href="{{route('materias.index')}}"
                title="Volver a la página anterior" 
                class="btn atras">
                <span class="ico-shadow"> 👈 </span>
                {{__('Previous')}}
              </a>
              <form action="{{ route('estudiantes.borrarGrupo', $materia_id) }}" method="POST">
                @csrf
                @method('delete')
                  <button type="submit" 
                    class="btn borrar" 
                    title="Borrar grupo">
                    <span class="ico-shadow"> ❌ </span>
                    <span class="bt-text-hide">{{ __('Delete') }} {{ __('Group') }}</span>
                  </button>
              </form>
            </div>
          @endif
          @if (request()->is('configurar/estudiantes/*'))
            <div class = "grid grid-cols-3-fr w-100 items-center">
              <h2>{{ __('My')}} {{ __('Students')}}</h2>
              <a href="{{route('materias.index')}}" 
                title="Volver a la página anterior" 
                class="btn atras">
                <span class="ico-shadow"> 👈 </span>
                {{__('Previous')}}
              </a>
              <select id="materia_id" 
                name = "materia_id" 
                value = "{{ $materia_id }}" 
                class = "d_block" 
                onchange = "seleccionaMateria(materia_id)">
                @foreach ($materias as $laMateria)
                  <option value = {{$laMateria->id}} {{$laMateria->id== $materia_id? 'selected' : ''}}>{{$laMateria->materia_name}}</option>
                @endforeach
              </select>
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
            </tbody>
          </table>
        </div>
        {{-- <div class="center">{{ $estudiantes->links() }}</div> --}}
         
      </div>      <!-- fin de body-TABLA estudiantes -->
      <div class="h-8"></div>
    </div>

  </div>
@endsection
@section('script')
  <script>
    var value_materia_id = '';
    function seleccionaMateria(materia_id){
      let x = document.getElementById('materia_id');
      value_materia_id = x.value;
      console.log("valor: "+value_materia_id);
      document.getElementById('materia_id').value = value_materia_id;
      var theObject = new XMLHttpRequest();
      theObject.open('POST',`{{route('materias.index')}}`,true);
      theObject.setRequestHeader('Content-Type','application/json');
      theObject.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      // theObject.onreadystatechange = function(){
      //   document.getElementById('respuesta').innerHTML = theObject.responseText;
      // }
      theObject.send(location.replace(value_materia_id));
      // fetch(`${value_materia_id}`, {
      //   headers:{
      //    'Content-Type': 'application/json',
      //    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      //    'allow':'405'
      //   },
      //   method:'POST',
      //   body: JSON.stringify(value_materia_id)
      //   })
      //   .then(response => response.json())
      //   .then(function(result){alert(result.message);})
      //   .catch(function (error){console.log("error");});
      //
    }
  </script>
@endsection