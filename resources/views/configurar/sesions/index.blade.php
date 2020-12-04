@extends('layouts.app')

@section('content')

  <div class="container">
    <div class = "col-sm-12">
      @if(session()->get('info'))
        <div class = "alert alert-info">
          {{ session()->get('info') }}  
        </div>
      @endif
    </div> {{-- fin col-sm-12 --}}
    <div class = "row">

      <div class = "col-md-12">
        <div class = "caja">
          <div class = "caja-header grid grid-cols-2 justify-between items-center">
              @php
                $dias=['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];
                $count = count($dias);
                use  App\Models\Sesion;
                $sesiones = Sesion::get();
                $num_sesiones= $sesiones->count();
              @endphp
            <h2>Hora inicio y hora final</h2>
            <div class= "grid grid-cols-2">
              {{-- <a href="{{route('sesions.create')}}" class="boton warning-reves" >{{ __('Add') }} sesión ✚</a>               --}}
              <a href="#" class="mr-2 boton warning-reves" onclick="document.getElementById('crear_sesiones').style.display='block'">{{ __('Add') }} sesión ✚</a>
              <a href="{{ route('home') }}" class="ml-2 boton secondary" class = "boton secondary">✅ ¡He acabado! </a>
            </div>
          </div>
          <div class = "caja-body">
            <table  class = "tabla table-responsive-sm" id="configurar_horario">
              <caption>¿A qué hora empieza y a qué hora acaba cada clase? (sin recreos).</br> </caption>
            
              <thead>
                <tr>
                  @for ($i = 0; $i < $count; $i++)
                    <th id={{$dias[$i]}}> {{$dias[$i]}}</th>
                  @endfor
                </tr>
              </thead>
              <tbody id="cuerpo">
                @foreach ($sesiones as $sesion)
                <tr id={{$sesion->id}}>
                  <th class="text-center">
                    <a href="{{route('sesions.edit',$sesion->id)}}" style="background-color:rgb(195, 226, 253)">
                      {{date_format(date_create($sesion->inicio), "H:i")}}
                       |  
                      {{date_format(date_create($sesion->fin), "H:i")}}
                    </a>
                  </th>
                  @for ($ii = 1; $ii < $count; $ii++)
                    <td id = {{$sesion->id}}{{$dias[$ii]}}>
                      
                    </td>
                  @endfor
                </tr>
                @endforeach
                {{-- </tr> --}}
              </tbody>
            </table>
          </div> {{-- fin caja-body --}}
        </div> {{-- fin caja --}}
      </div> {{-- fin col-sm-12 --}}
    </div>
  </div> {{-- fin container --}}

  <div id="crear_sesiones" class="modal">
    <div class="modal-content p_x15 animate-zoom" style="max-width:320px">
    <div class= "center p_y p_right">

      <span onclick="document.getElementById('crear_sesiones').style.display='none'" class="boton xlarge danger d_topright" title="Cerrar">&times; </span>
      <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle m_t">
    </div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form class="p_x15" method="post" action="{{ route('sesions.store') }}">
      @csrf
        <p id="id_sesion"><p>
        <div class="p_y" >
          <h3>Crear Sesión {{ $num_sesiones+1}}</h3>
        </div>
        <div class="grid grid-cols-2 justify-between">
          <div>
            <label for="inicio"><b>Empieza:</b></label>
            <input type="time" id="inicio"  name="inicio" class="d_block m_b" >
          </div>
          <div>
            <label for="fin"><b>Acaba: </b></label>
            <input type="time" id="fin" name="fin" class="d_block m_b" >
          </div>
        </div>
        <button class="boton d_block blue" type="submit">Guardar</button>
    </form>
    <div class=" p_x15 p_y light-grey">
      <button onclick="document.getElementById('crear_sesiones').style.display='none'" type="button" class=" boton danger">Cancel</button>
    </div>
  </div>

  @endsection