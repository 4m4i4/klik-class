{{-- clases.index --}}
@extends('layouts.app')

@section('tablas')
<div class="container">
  <div class = "">

    <div class="caja">  <!-- CABECERA clases -->
      <div class = "caja-header">
        <div class = "grid grid-cols-3-fr items-center justify-right">
          
              <h2 class="title">Mi horario de clases</h2>
              <a href="{{route('clases.index')}}" 
                  title=" Ir a la tabla de clases editable" 
                  class="boton warning px-4 mr-1">¿Editar?
              </a>
              <a href="{{route('home')}}" 
                  title="a home" 
                  class="boton continuar px-4 mr-1">Continuar 
                    <span class="ico-shadow">👉 </span> 
              </a>
         
        </div>   <!-- fin de grid -->
      </div>  <!-- fin de caja-header -->
    </div>       <!-- fin de CABECERA clases  -->

    <div class="caja">   <!-- body-TABLA clases -->
      <div class="caja-body">
        <table id="horario" class="tabla table-responsive mx-auto">
          <caption>Esta es la <strong>vista</strong> del horario. Aquí no puedes editar nada. </caption>
            @php
               $dias = ['Horario','Lunes','Martes','Miercoles','Jueves','Viernes'];
            @endphp  
            @php
              $user = auth()->user()->id;
              $num_dias = count($dias);
              use App\Models\Sesion;
              $sesiones = Sesion::where('user_id',$user)->get();
              // dd($sesiones);
              $num_sesiones = count($sesiones);
              use App\Models\Clase;
              $clases = Clase::where('user_id',$user)
                              ->with('user','materia','sesion')->get();
            @endphp
          <thead>  <!-- cabecera: DÍAS DE LA SEMANA -->
            <tr>
              @for($i = 0; $i < $num_dias; $i++)
                <th id={{$dias[$i]}}>{{$dias[$i]}}
                </th>
              @endfor
            </tr>
          </thead>
          <tbody><!-- filas: SESIONES -->
            @for ($fila = 0; $fila < $num_sesiones; $fila++)
              <tr id={{$sesiones[$fila]->id}}>
                @for ($col = 0; $col < $num_dias; $col++)
                  @if ($col == 0)
                    <th class="text-center">
                      {{date_format(date_create($sesiones[$fila]->inicio), "H:i")}}
                        <br>
                      {{date_format(date_create($sesiones[$fila]->fin), "H:i")}}
                    </th>
                  @endif
                      @php
                        $estasesion = $sesiones[$fila]->id;
                        $estedia = $dias[$col];
                        $clase = $clases->where('user_id',$user)->where('sesion_id', $estasesion)
                          ->where('dia', $estedia)
                          ->first();                          
                      @endphp                  
                  @if ($col > 0 && $clase !== null)
                     <!-- Si la consulta $clase devuelve contenido... -->
                    <td id ={{$fila + 1}}{{$dias[$col]}} class="text-center  bg-yellow mx-auto"  >
                            <!-- nombre del grupo y la materia -->
                      <p class="mb-1 l-height">
                            <span>{{ Str::before($clase->materia->materia_name," ") }}</span>
                      </p>
                      <span class="text-gray-600 text-xs">{{$clase->materia->grupo}}                       
                      </span>
                    </td>
                  @elseif($col > 0 && $clase == null)
                    <td id ={{$fila + 1}}{{$dias[$col]}}></td>
                  @endif
                @endfor
              </tr>
            @endfor
          </tbody>
        </table>
      </div>  {{--  fin caja-body --}}
    </div>        <!-- fin de body-TABLA clases -->
  </div>  <!-- fin de div -->
</div>  <!-- fin de container -->
@endsection
