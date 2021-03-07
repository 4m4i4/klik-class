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
          <div class = "grid grid-cols-3-fr items-center">
                @php
                  $user = auth()->user()->id;
                  use App\Models\Materia;
                  $materia = Materia::where('user_id', $user)->get();
                  // dd($materia);
                  $materia_id = '0';
                @endphp
            <h2>{{ __('My')}} {{ __('Students')}}</h2>
            <a href="{{route('materias.index')}}" title="Volver a la página anterior " class="btn atras">
              <span class="ico-shadow"> 👈 </span>Atrás
            </a>
            <select id="materia_id" name="materia_id" value="{{ $materia_id }}" class="d_block" onchange="seleccionaMateria(materia_id)" >
                {{-- <option value={{$materia->id}} {{$materia->id == $materia_id? 'selected' : ''}}>Todas las materias</option> --}}
              @for($index = 0; $index < count($materia); $index++)
                <option value={{$materia[$index]->id}} {{$materia[$index]->id == $materia_id? 'selected' : ''}}>{{$materia[$index]->materia_name}}</option>
              @endfor
            </select>
          </div>
        </div>
      </div>       <!-- fin de CABECERA estudiantes -->
      <div class="caja">  <!--body-TABLA estudiantes -->
        <div class = "caja-body">
          <table class = "tabla table-responsive mx-auto">
            <thead>
              <tr>
                  <th>Id</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Surnames') }}</th>
                  {{-- <th>{{ __('Full name') }}</th> --}}
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
                        class= "btn editar" 
                        title= "Editar estudiante id= {{ $estudiante->id }}">
                      <span class="ico-shadow"> 📝 </span>
                      <span class="bt-text-hide">{{ __('Edit') }}</span> 
                    </a>
                  </td>
                  <td>    <!-- Borrar -->
                    <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST">
                      @csrf
                      @method('delete')
                        <button type="submit" 
                            class="btn borrar" 
                            title="Borrar estudiante id= {{ $estudiante->id }}">
                          <span class="ico-shadow"> ❌ </span>
                          <span class="bt-text-hide">{{ __('Delete') }}</span>
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
      return value_materia_id;
      // let ipPuerto = location.host;
      // let ruta = location.pathname;
      // let protocolo = location.protocol;
      // // console.log(protocolo);
      // rutaArr = ruta.split('/');
      // // console.log("ruta :"+ rutaArr);
    
      // let nuevaRuta = protocolo+"://"+ipPuerto+"/"+rutaArr[1]+"/"+rutaArr[2]+"/"+value_materia_id;
      // console.log("Nueva ruta :"+ nuevaRuta);
      // fetch('nuevaRuta', {
      // headers:{
      //    'Content-Type': 'application/json',
      //    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      // },
      // method:'POST',
      // body: JSON.stringify(value_materia_id)
      // })
      // .then(response => response.json())
      // .then(function(result){
      //     alert(result.message);
      // })
      // .catch(function (error) {
      //   console.log(error);
      // });
// }
      // location.replace(nuevaRuta);

      // console.log("direc1 :"+ ipPuerto);
      
    }


  </script>
@endsection