@extends('layouts.app')
@section('tablas')
<div class="container">

  <div class="caja mx-1 px-4">
    <div class="caja-header">
      <h1 class=" my-4 text-center">Personaliza Klik-Class</h1>
      <div class="flex items-center justify-center">
        <a class="default text-sm px-4 py-1 text-center mr-1" href="#indice_1">Elije tus Botones</a>
        <a class="default text-sm px-4 py-1 text-center mr-1" href="#indice_2">Graduales y Combinados</a>
        <a class="default text-sm px-4 py-1 text-center mr-1" href="#indice_3">Control de Asistencia</a>
        <a class="default text-sm px-4 py-1 text-center" href="#indice_4">Botones Premio</a>
      </div>
      <p class="my-4">Esta es la página donde el usuario puede personalizar los botones. Se ofrecen modelos de uso para mostrar el funcionamiento de cada tipo. Las imágenes son ideas sobre su contenido</p>
    </div>
  </div>
  {{-- <div class="grid grid-cols-2"> --}}
  <div  id= "indice_1"class="caja mx-1 px-4">
    <div class="caja-body">
      <h2  class="my-4 text-blue-30 smallCaps">Prueba cómo funcionan antes de elegir</h2>
      <hr>
     <figure>
        <img src="/images/botonesConfig.png" alt="muestrario de botones" width="994px" hight="572px">
         <figcaption>
        El usuario aprende el funcionamiento de los botones clicando en cualquiera de los patrones para comprobar cómo cambian los valores en los contadores que hay el título.
        </figcaption>
      </figure>
      <hr>
      <p class="my-4">Al hacer clic en el botón "Usar este botón en..." se abre un formulario con la lista para seleccionar a qué materias-grupos quiere asignarse y otras opciones de configuración. </p>
    </div>
  </div>

  <div  id= "indice_2"class="caja mx-1 px-4">
    <div class="caja-body">

      <h2  class="my-4 text-blue-30 smallCaps" >Botones graduales y Combinados</h2>
      <hr>

      <figure>
        <img src="/images/botonesConfig01.png" alt=" botones graduales y combinados" width="992" height="564">
          <figcaption>
          Los combinados son cajas preconfiguradas para incluir los botones elegidos. Los botones graduales tienen un valor inicial que aumenta o disminuye en cada clic hasta alcanzar el tope o valor final. 
          </figcaption>
      </figure>
      <hr>
      <p class="my-4">Además de los valores (inicial, final e incremento) se puede configurar también el aspecto: el color, la forma y el texto en el botón y si cambian o no..</p>
    </div>
  </div>

  <div id= "indice_3"  class="caja mx-1 px-4">
    <div class="caja-body">
      <h2  class="my-4 text-blue-30 smallCaps" >Control de la asistencia</h2>
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
      <p class="my-4">Se pueden añadir más opciones usando el control de asistencia múltiple. Por ejemplo: Asiste, Falta, Retraso, Expulsión. El segundo clic guarda 'Retraso' (y opcionalmente, cuántos minutos). El tercer clic señala una expulsión.</p>
    </div>
  </div>

  <div  id= "indice_4" class="caja mx-1 px-4">
    <div class="caja-body">
      <h2  class="my-4 text-blue-30 smallCaps" >Botones con premio aleatorio</h2>   
      <hr>   
        <figure>
         <img src="/images/botonesConfig03.png" alt=" botones premio" width="1000" height="566">
          <figcaption>
             Botones para motivar a los desmotivados
         </figcaption>
        </figure>
         <hr>
      <p class="my-4">Se puede rifar un premio al finalizar la clase o establecer el periodo en que puede darse. Opcionalmente se podrían añadir restricciones como: solo se dará si no tiene puntos negativos.</p>
    </div>

  </div>
  {{-- </div> --}}

@endsection