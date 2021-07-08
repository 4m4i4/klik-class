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
                  $num_sesiones = $sesiones->count();
                @endphp
            <h2 class="title text-overflow">Sesión: Inicio y final</h2>

            <a href="{{route('sesions.create')}}" 
              title="Crear sesión" 
              class= "btn px-4 crear" 
              autofocus>
              <p class="">{{ __('Add') }} 
                <span class="ico-shadow"> ⌚ </span>
              </p>
            </a>              
            <form method="POST" action="{{route('home.updatePasoMas',$user)}}">
               @csrf
                @method("PUT")
                  <button type="submit" 
                    title="Horario completado: Ir a poner Clases"
                    class="ml-1 btn continuar">
                    <span class="ico-shadow">✅&nbsp </span> 
                    <span class="">{{ __('Next')}}</span>
                    <span class="ico-shadow">👉 </span>
                  </button>
            </form>
          </div>
        </div>
      </div>      <!-- fin de CABECERA sesiones-->

      <div class="caja">  <!--body-TABLA sesiones-->
        <div class = "caja-body">
          <table id="tabla-config-sesion" class = "tabla table-responsive mx-auto">
            <caption>
              Para <strong>Crear</strong> una sesión haz click en <strong>Añadir</strong>, o pulsa <kbd>+</kbd> en tu teclado.<br>
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
                  <tr id={{$sesion->id}} class="">
                    <th class="flex justify-center">
                      <a href="{{route('sesions.edit', $sesion->id)}} "title="Cambiar el horario" class="editar h-8 sans-serif flex justify-center items-center">
                        <span class="ico-shadow"> 📝 &nbsp</span> {{date_format(date_create($sesion->inicio), "H:i")}} |  
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
      <div class="h-8"></div>
    </div> {{-- fin div --}}
  </div> {{-- fin container --}}
@endsection
@section('script')
<script>
  window.onload = function() { 
    document.onkeyup =abrirFormulario; 
  }

  function  abrirFormulario(evObject) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST',`{{route('sesions.index')}}`,true);
    xhr.setRequestHeader('Content-Type','application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    var tecla = evObject.keyCode;
      console.log(tecla);
    if(tecla == 171 ){
      window.open("/configurar/sesions/create", '_self');
    }
  }
</script>
@endsection