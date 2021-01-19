@extends('layouts.app')
@section('tablas')
{{-- <div class="container bg-white"> --}}
  <div class="caja">
    <div class="caja-header">
      <h2 class="my-2">Personaliza tu Klik-Class</h2>
    {{-- </div>
  </div> --}}
  {{-- <div class="caja">
    <div class="caja-body"> --}}
    <a class="btn default" href="#indice_1">Elije botones</a>
    <a  class="btn default" href="#indice_2">Graduales y Combinados</a>
    <a  class="btn default" href="#indice_3">Control de asistencia</a>
    <a  class="btn default" href="#indice_4">Botones Premio</a>
    </div>
  </div>
  {{-- <div class="grid grid-cols-2"> --}}
  <div  id= "indice_1"class="caja">
    <div class="caja-body">
      <h2  class="my-4">Prueba cómo funcionan antes de elegir</h2>
      <hr>
     <figure>
        <img src="/images/botonesConfig.png" alt="muestrario de botones" width="994px" hight="572px">
         <figcaption>
         Al hacer clic en el botón "Usar este botón en..." se abrirá un formulario
        </figcaption>
      </figure>
      <hr>
      <p class="my-4">El usuario puede ver el funcionamiento de los botones clicando en los cualquiera de los patrones y ver cómo cambian los contadores que hay el título</p>
    </div>
  </div>

  <div  id= "indice_2"class="caja ">
    <div class="caja-body">

      <h2  class="my-4" >Botones graduales y Combinados</h2>
      <hr>

      <figure>
        <img src="/images/botonesConfig01.png" alt=" botones graduales y combinados" width="992" height="564">
          <figcaption>
          Los combinados son cajas preconfiguradas partiendo de los botones elegidos
          </figcaption>
      </figure>
      <hr>
      <p class="my-4">Esta es la página donde se hace la personalización de los botones. Por ahora sólo contiene imágenes con ideas sobre su contenido</p>
    </div>
  </div>

  <div id= "indice_3"  class="caja">
    <div class="caja-body">
      <h2  class="my-4" >Control de la asistencia</h2>
      <hr>


      <figure>
        <img src="/images/botonesConfig02.png" alt="botones control de asistencia" width="1002" height="1284">
        <figcaption>
          Las opciones del ciclo de clic son configurables
        </figcaption>
      </figure>
      <hr>
      <p class="my-4">El control de asistencia simple queda habilitado al acabar de introducir los datos, Se puedden elegir más posibilidades aquí "</p>
    </div>
  </div>

  <div  id= "indice_4" class="caja">
    <div class="caja-body">
      <h2  class="my-4" >Botones con premio aleatorio</h2>   
      <hr>   
        <figure>
         <img src="/images/botonesConfig03.png" alt=" botones premio" width="1000" height="566">
          <figcaption>
             Botones para motivar a los desmotivados
         </figcaption>
        </figure>
    </div>

  </div>
  {{-- </div> --}}

@endsection