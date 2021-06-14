@extends('configurar.aulas.show') 

@section('content')
{{-- <div id="ver_modal" class="modal"> --}}
{{-- <div id="edit_vacias" class="modal"> --}}
<div class="nomodal">
  @include('include.formBanner')
  <div>
    <div class="px-6 caja-header text-center">
      <h3>Cambiar mesas del aula</h3>
    </div>
    <form class="px-6" method="POST" action="{{route('aulas.updateMesasVacias', $aula->id) }}" method="POST" >
      @csrf 
      @method('PUT')  
      <div class="">
        <div class="mb-2"><!-- $clase->user_id  -->
            {{-- <p>Usuari@: {{auth()->user()->name}}</p> --}}
          <p class="text-center"> {{$materia_name}}</p>
          <p class="ejemplo">
            <strong>{{$aula->num_columnas}}</strong> columnas y 
            <strong>{{$aula->num_filas}}</strong> filas;<br> 
            <strong>{{count($ids_estudiante)}}</strong> estudiantes y 
            <strong>{{$vacias->count()}}</strong> mesas vacías.
          </p> 
                  {{-- <p>
                    @foreach ($estudiantes as $estudiante)
                      {{$estudiante->id}}: {{$estudiante->apellidos}},{{$estudiante->nombre}};<br> 
                    @endforeach
                      </p> --}}
                      {{-- <p>
                        Mesas: {{$mesas->count()}}<br>
                        @foreach ($mesas as $mesa)
                          {{$mesa->id}}: {{$mesa->estudiante_id}},
                            @php
                              array_push( $id,$mesa->estudiante_id);
                              $i = 0;
                            @endphp
                            ;<br> 
                        @endforeach
                      </p> --}}
                        {{-- ids: {{count($id)}} --}}
                      {{-- <p>
                        @foreach ($estudiantes as $estudiante)
                          {{ $id[$i]}};
                          @php $i++; @endphp
                        @endforeach
                  </p>    --}}
                  
          <div class="ml-8 mt-2">
            <small>
              @foreach ($vacias as $vacia)
                {{$vacia->id}}: está vacía;<br> 
              @endforeach 
            </small>
          </div>
        </div>

        <details class="mt-2">
          <summary>Cambiar mesas vacías</summary>
          <div class=""><!-- Cambiar mesas vacías  -->
            <label class="d_inline" for="cambiarMesasVacias">Columna, fila</label>
            <textarea name="cambiarMesasVacias" id="cambiarMesasVacias" class="d_block" rows="1" placeholder="1_3,3_2"></textarea>
          </div> 
          <div class="mt-1">
            <small class="ejemplo">
              <strong>Esquema: columna_fila</strong> donde 1 es la primera columna de la izquierda y 3 es la tercera fila desde delante.
            </small>
          </div>
        </details>
        <details class="mt-2">
          <summary>Mover estudiantes de mesa</summary>
          <div class="mt-2"><!-- Mover estudiantes de mesa  -->
            <label class="d_inline" for="sentarEstudiantes"></label>
            <textarea name="sentarEstudiantes" id="sentarEstudiantes" class="d_block" rows="1" placeholder="1,2,3,4,5,6,7,8,9"></textarea>
          </div>
          <div class="mt-1 px-2">
            <small class="ejemplo">
              Ordena tus estudiantes escribiendo los números del <strong>1 </strong> al <strong> {{count($ids_estudiante)}} </strong></small><small> <strong>separados por comas</strong>
            </small>
          </div>

          <div class= "mt-2"><!-- Ayuda  -->
            <details class="mt-2">
              {{--  <summary>Ver más:</summary> --}}
              <p class="mt-2"></p>
              <div class="destacado text-center py-2">
                <p class="py-2 ">
                  @for($i = 1; $i <= count($ids_estudiante); $i++)
                    @if($i<10) {{$i='0'.$i}}
                    @else {{$i=''.$i}}
                    @endif 
                      <kbd> ,</kbd>&nbsp;
                    @if($i%$aula->num_columnas == 0)<br>
                    @endif 
                  @endfor
                </p>
              </div>  
              <small class="mt-2">
                Ordenados <strong>por lista</strong> se verían así <strong>desde la pizarra</strong>.
              </small>
              <details class="mt-2">
                <summary>Copia y pega esta lista</summary>
                  {{-- <p class="mt-2 px-2">:</p> --}}
                <div class="mt-1 px-2">
                  <small class="mt-2 text-center">{{count($ids_estudiante)}}
                    @for($i = count($ids_estudiante)-1; $i > 0; $i--), {{$i}}@endfor
                  </small>
                </div>
              </details>
            {{-- </details> --}}
          </div>
        {{-- </details> --}}
      </div>
      <div>
        <button type="submit" 
          title="Guardar clase" 
          class="bt_xxl mt-6 enviar">Guardar</button>
      </div>
    </form>
  </div>  
  <div class="px-6 py-4 mt-6 light-grey">
    <a href="{{url()->previous()}}"title="Cancelar y volver al índice" class="boton d_inline cancelar">Cancelar</a>
  </div>
</div>  {{--  fin modal-content --}}
        {{-- </div>  fin modal --}}
@endsection





 <div  id= "indice_1"class="caja">
    <div class="caja-body">
      <h2  class="my-4 text-6 text-blue-30 text-center smallCaps">Prueba cómo funcionan antes de elegir</h2>
      <hr>         
     <figure>
        <img src="/images/botonesConfig.png" alt="muestrario de botones" width="994px" hight="572px">
         <figcaption>
        El usuario aprende el funcionamiento de los botones clicando en cualquiera de los patrones para comprobar cómo cambian los valores en los contadores que hay el título.
        </figcaption>
      </figure>
      <hr>
      <p class="text-justify my-4">Al hacer clic en el botón "Usar en la materia..." se abre un formulario con la lista para seleccionar a qué materias-grupos quiere asignarse y otras opciones de configuración. </p>
    </div>
  </div>

  <div  id= "indice_2"class="caja">
    <div class="caja-body">

      <h2  class="my-4 text-6 text-blue-30  text-center smallCaps" >Botones graduales y Combinados</h2>
      <hr>

      <figure>
        <img src="/images/botonesConfig01.png" alt=" botones graduales y combinados" width="992" height="564">
          <figcaption>
          Los combinados son cajas preconfiguradas para incluir los botones elegidos. Los botones graduales tienen un valor inicial que aumenta o disminuye en cada clic hasta alcanzar el tope o valor final. 
          </figcaption>
      </figure>
      <hr>
      <p class="text-justify my-4">Además de los valores (inicial, final e incremento) se puede configurar también el aspecto: el color, la forma y el texto en el botón y si cambian o no..</p>
    </div>
  </div>

  <div id= "indice_3"  class="caja">
    <div class="caja-body">
      <h2 class="my-4 text-6 text-blue-30  text-center smallCaps" >Control de la asistencia</h2>
      <hr>
     
      <div class="grid   md:gridcols-2 items-center justify-center">
      <figure>
        <img src="/images/botonesConfig021.png" alt="botones control de asistencia simple" width="788" height="476">
        <figcaption class="text-justify text-xs ">
          El control de asistencia simple es un booleano que está habilitado por defecto: Al clicarlo guarda 'falta', si no se clica guarda 'Asiste'. ¿Qué pasa si el estudiante llega después de haber clicado la falta? Clicas de nuevo y guarda 'Asiste'.
        </figcaption>
      </figure>
      <figure>
        <img src="/images/botonesConfig022.png" alt="botones control de asistencia mútiple" width="788" height="476">
        <figcaption class="text-justify text-xs ">
          Se pueden añadir más opciones usando el control de asistencia múltiple. Por ejemplo: Asiste, Falta, Retraso, Expulsión. El primer clic guarda 'Falta', el segundo 'Retraso' (y opcionalmente, registra cuántos minutos). El tercer clic señala una expulsión.
        </figcaption>
      </figure>
      </div>
      <hr>
      <p class="text-justify my-4">Se pueden añadir más opciones usando el control de asistencia múltiple. Por ejemplo: Asiste, Falta, Retraso, Expulsión. El segundo clic guarda 'Retraso' (y opcionalmente, cuántos minutos). El tercer clic señala una expulsión.</p>
    </div>
  </div>

  <div  id= "indice_4" class="caja">
    <div class="caja-body">
      <h2 class="my-4 text-6 text-blue-30  text-center smallCaps" >Botones con premio aleatorio</h2>   
      <hr class="bg-azul-kc">   
        <figure>
         <img src="/images/botonesConfig03.png" alt=" botones premio" width="1000" height="566">
          <figcaption>
             Botones para motivar a los desmotivados
         </figcaption>
        </figure>
         <hr>
      <p class="text-justify my-4">Se puede rifar un premio al finalizar la clase o establecer el periodo en que puede darse. Opcionalmente se podrían añadir restricciones como: solo se dará si no tiene puntos negativos.</p>
    </div>


    
      
      {{-- <div class="menu-botones">
        <a class="items-menu-botones default" href="#indice_1">Elije tus Botones</a> --}}
        {{-- <a class="items-menu-botones default" href="#indice_2">Graduales y Combinados</a>
        <a class="items-menu-botones default" href="#indice_3">Control de Asistencia</a>
        <a class="items-menu-botones default" href="#indice_4">Botones Premio</a> --}}
      {{-- </div> --}}
      {{-- <p class="text-justify px-4 my-4">Esta es la página donde el usuario puede personalizar los botones. Se ofrecen modelos de uso para mostrar el funcionamiento de cada tipo. Las imágenes son ideas sobre su contenido</p> --}}