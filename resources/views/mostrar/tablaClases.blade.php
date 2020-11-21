@extends('layouts.app')

@section('content')

  <div class="container">
    <div class = "col-sm-12">
      @if(session()->get('info'))
        <div class = "alert alert-info">
          {{ session()->get('info') }}  
        </div>
      @endif
    </div>
    <div class = "row">

      <div class = "col-md-12">
        <div class = "caja">
          <div class = "caja-header d-flex justify-content-between">
            <h2>Tabla de Clases </h2>
          </div>
          <div class = "caja-body">
            <table  class = "tabla table-responsive-sm" id="configurar_horario">
              <caption>Introducir el horario y las sesiones(Materia, grupo y aula)</caption>
              @php
                  $dias=['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];
                  $count=count($dias);
                  use  App\Models\Sesion;
                  $sesiones = Sesion::get();
              @endphp
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
                <th>{{$sesion->inicio}}<br>{{$sesion->fin}}</th>
                  @for ($ii = 1; $ii < $count; $ii++)
                      <td id={{$sesion->id}}{{$dias[$ii]}}> {{$sesion->id}}{{$dias[$ii]}}</td>
                  @endfor
                @endforeach


                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection