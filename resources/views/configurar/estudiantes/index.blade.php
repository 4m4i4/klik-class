{{-- estudiantes.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">

    @if(session()->get('success'))
        <div class = "text-center alert alert-info">
          {{ session()->get('success') }}  
        </div>
    @endif
    <div class = "">
      <div class="caja">  <!-- CABECERA estudiantes -->
        <div class = "caja-header">
          @if (request()->is('mostrar/estudiantes/*'))
            <div class = "grid grid-cols4 w-100 items-center">
              <h2>{{ __('My')}} {{ __('Students')}}: ({{$estudiantes->count()}})</h2>
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

              <form action="{{route('estudiantes.index',$materia_id)}}" method="POST">
                @csrf
                <select id="materia_id" 
                  name="materia_id" 
                  value="{{ $materia_id }}" 
                  class="d_block" 
                  onsubmit="seleccionaMateria(materia_id)">
                  @foreach ($materia as $laMateria)
                    <option value={{$laMateria->id}} {{$laMateria->id == $materia_id? 'selected' : ''}}>{{$laMateria->materia_name}}</option>
                  @endforeach
                </select>
              </form>
            </div>
          @endif
          @if (request()->is('configurar/estudiantes'))
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
                @foreach ($materia as $laMateria)
                  <option value = {{$laMateria->id}} {{$laMateria->id == $materia_id? 'selected' : ''}}>{{$laMateria->materia_name}}</option>
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
                  <th>{{ __('Subject') }}</th>
                  <th>{{ __('Edit') }}</th>
                  <th>{{ __('Delete') }}</th>
              </tr>
            </thead>
            <tbody>

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
                  <td><!-- Materia -->
                    {{$estudiante->materia->materia_name }}
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
        <div class="center">{{ $estudiantes->links() }}</div>
         
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
      // return value_materia_id;
      let ipPuerto = location.host;
      let ruta = location.pathname;
      let protocolo = location.protocol;
      // console.log(protocolo);
      rutaArr = ruta.split('/');
      // console.log("ruta :"+ rutaArr);
      // console.log("direc1 :"+ ipPuerto);
      let nuevaRuta = protocolo+"://"+ipPuerto+"/"+rutaArr[1]+"/"+rutaArr[2]+"/"+value_materia_id;
      console.log("Nueva ruta :"+ nuevaRuta);
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
      //location.replace(nuevaRuta)
    }
  </script>
@endsection