{{-- sesions.index --}}
@extends('layouts.app')

@section('tablas')

  <div class="container">
      <!-- Información de los cambios que se han producido en el sistema al enviar el formulario-->
    @if(session()->get('info'))
      <div class = "text-center alert alert-info">
        {{ session()->get('info') }}  
      </div>
    @endif

    <div class = "">

      <div class="caja">  <!--CABECERA sesiones-->
        <div class = "caja-header">
          <div class = "grid grid-cols-3-fr items-center">
                @php
                  $user = auth()->user()->id;
                  $dias=['Horario','Lu','Ma','Mi','Ju','Vi'];
                  $count = count($dias);
                  use  App\Models\Sesion;
                  $sesiones = Sesion::where('user_id',$user)->get();
                  $num_sesiones= $sesiones->count();
                @endphp
            <h2 class="title">Sesión: Inicio y final</h2>
            <a href="{{route('sesions.create')}}" title="Crear sesión" class= "btn crear" autofocus>{{ __('Add') }} <span class="ico-shadow"> ⌚ </span></a>              
            <form method="POST" action="{{route('home.updatePasoMas',$user)}}">
               @csrf
                @method("PUT")
                  <button type="submit" title="Horario completado: Ir a rellenar Horario" class="ml-1 btn continuar"><span class="ico-shadow">✅ </span> Continuar <span class="ico-shadow">👉 </span></button>
            </form>
          </div>
        </div>
      </div>      <!-- fin de CABECERA sesiones-->

      <div class="caja">  <!--body-TABLA sesiones-->
        <div class = "caja-body">
          <table  class = "tabla table-responsive mx-auto">
            <caption>
              Haz click en <strong>Añadir</strong> para crear una sesión.<br>
              Para <strong>Cambiar </strong> un horario haz click sobre él. <br> Si tienes todas las sesiones pulsa <strong>Continuar</strong>.
            </caption>
            <thead>
                <tr>
                  @for ($i = 0; $i < $count; $i++)
                    <th id={{$dias[$i]}}> {{$dias[$i]}}</th>
                  @endfor
                </tr>
            </thead>
            <tbody>
              @foreach ($sesions as $sesion)
                  <tr id={{$sesion->id}}>
                    <th class="text-center">
                      <a href="{{route('sesions.edit', $sesion->id)}}" title="Cambiar el horario" class="boton d_inline editar nja px-1">
                        <span class="ico-shadow"> 📝 </span> {{date_format(date_create($sesion->inicio), "H:i")}} |  
                        {{date_format(date_create($sesion->fin), "H:i")}}
                      </a>
                    </th>
                    @for ($ii = 1; $ii < $count; $ii++)
                      <td id = {{$sesion->id}}{{$dias[$ii]}}></td>
                    @endfor
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div> {{-- fin caja-body --}}
      </div>      <!-- fin de body-TABLA sesiones -->
    </div> {{-- fin div --}}
  </div> {{-- fin container --}}
@endsection