{{-- /informacion --}}
@extends('layouts.app')

@section('tablas')
<div class="container">
  <div class="caja mt-4">
    <div  id= "indice_0" class="caja-header mt-2">
      <details class="mt-2 mx-2">
        <summary class="smallCaps title editar">Información</summary>
          <div class="my-4 mx-4 informacion">
            <ul class="mb-2">Se explican los <strong> ítems del menú de desarrollo</strong> (sin acceso para el usuario). Se ha dejado disponible porque: 

                <li class="ml-4 my-2">Contiene partes del trabajo que no podrían mostrarse de otro.</li>

                <li class="ml-4 my-2">Permite <em> "tomar atajos" </em>que se explican a continuación.</li>
            </ul>
          </div>
          <div class="my-4 mx-4 informacion">
            <ul class= "mb-2">Se añaden un par de usuarios (con sus datos del curso, y las contraseñas) por si se quieren utilizar:
              <li class="d_block ml-4 my-2"><strong>Usuarios:</strong> nueva; new</li>
              <li class="d_block ml-4 my-2"><strong>Correo:</strong>  nueva@a.com; new@a.com</li>
              <li class="d_block ml-4 my-2"><strong>Contraseñas:</strong>  klikclass</li>

            </ul>
          </div>
          <br>
          
      </details>
    </div>
    <div class="caja-body">

      <div class="menu-botones">
        <a class="items-menu-botones atras" href="#indice_1">Sumar y Restar paso</a>
        <a class="items-menu-botones crearCurso" href="#indice_2">Páginas Principales
        </a>
        <a class="items-menu-botones continuar" href="#indice_3">Resultados Ajax y json</a>
        <a class="items-menu-botones oscuro-reves" href="#indice_4">Menú de usuario</a>
      </div>
      <p class="text-justify px-4 my-4"></p>
    
    </div>
  </div>

  <div id="indice_1" class="caja">
    <div class="caja-header">
      <h2 class="mt-4 mb-2 title text-blue-30 text-center">Sumar y Restar paso</h2>
      <hr class="mt-2 mb-4 hr">
    </div>
    <div class="caja-body">
      <div class="my-4 mx-4 informacion">
        <h2 class="mb-2">Se avanza en 7 pasos: del 0 al 6</h2>
        <ol>Desde la etapa de configuración a la etapa de uso. <br><code>/home</code> pasa por <strong>todos: </strong>
          <li class="d_block ml-4 my-2"><strong>Paso 0:</strong> Crear <span class="smallCaps text-blue-30">curso</span>.<br><span class="smallCaps text-blue-30">Inicio de la Etapa de Configuración</span>  <br><code>url= /home</code></li>
          <li class="d_block ml-4 my-2"><strong>Paso 1:</strong> Introducir <span class="smallCaps text-blue-30">materias</span>.  <br><code>url= /configurar/materias</code></li>
          <li class="d_block ml-4 my-2"><strong>Paso 2:</strong> Introducir <span class="smallCaps text-blue-30">sesiones</span>.  <br><code>url= /configurar/sesions</code></li>
          <li class="d_block ml-4 my-2"><strong>Paso 3:</strong> Introducir <span class="smallCaps text-blue-30">clases</span>.  <br><code>url= /configurar/clases</code></li>
          <li class="d_block ml-4 my-2"><strong>Paso 4:</strong> Paso final de la etapa de configuración. Navegación lineal desde  <br><code>url= /configurar/materias</code> 
              <ul>
                <li class="d_block ml-4 my-2">4.1. Introducir <span class="smallCaps text-blue-30">Estudiantes</span>. <code>url= /configurar/materias</code> </li> 
                <li class="d_block ml-4 my-2">4.2. Configurar <span class="smallCaps text-blue-30">Aula</span>. <code>url= /configurar/aulas/{id}/edit</code>....</li> 
                <li class="d_block ml-4 my-2">4.3. Colocar <span class="smallCaps text-blue-30">Mesas</span>. <code>url= /etapaUso/materias/{id}/show</code></li> 
              </ul>
          </li>
          <li class="d_block ml-4 my-2"><strong>Paso 5: Fin </strong>de la  <span class="smallCaps">Etapa de Configuración</span>. <br>  <span class="smallCaps text-blue-30">Inicio de la Etapa de Uso</span>. <br><code>url= /home</code> </li>
          <li class="d_block ml-4 my-2"><strong>Paso 6:</strong> Etapa de uso propiamente dicha. <br><code>url= /home</code></li>.
          
            
        </ol>
      </div>
      <div class="my-4 mx-4 h-12">
        <p class=" mb-4"><a class="f_right btn smallCaps h-8 px-4 oscuro-reves" href="#indice_0"><span class="text-sm">Volver al Índice</span></a></p>
      </div>

    </div>
  </div>

  <div id="indice_2" class="caja">
    <div class="caja-header">
      <h2 class="mt-4 mb-2 title text-blue-30 text-center">Páginas Principales</h2>
      <hr class="mt-2 mb-4 hr">
    </div>
    <div class="caja-body">
      <div class="my-4 mx-4 informacion">
        <p>Enlaces a las <span class="smallCaps text-blue-30">vistas.</span> (son las url que están en el primer botón)</p>
      </div>
      <div class="my-4 mx-4 h-12">
        <p class=" mb-4"><a class="f_right btn smallCaps h-8 px-4 oscuro-reves" href="#indice_0"><span class="text-sm">Volver al Índice</span></a></p>
      </div>
    </div>
  </div>

  <div id="indice_3" class="caja">
    <div class="caja-header">
      <h2 class="mt-4 mb-2 title text-blue-30 text-center">Resultados Ajax y json</h2>
      <hr class="mt-2 mb-4 hr">
    </div>
    <div class="caja-body">
      <div class="my-4 mx-4 informacion">
        <p><span class="smallCaps text-blue-30">Llamadas asíncronas</span> El Botón de Ajax funciona si coincide la hora actual con una clase, la muestra, aunque no donde debiera.</p>
        <p><span class="smallCaps text-blue-30">Consultas .json API rest</span>, son consultas en  json (me ha costado....)</p>

      </div>
      <div class="my-4 mx-4 h-12">
        <p class=" mb-4"><a class="f_right btn smallCaps h-8 px-4 oscuro-reves" href="#indice_0"><span class="text-sm">Volver al Índice</span></a></p>
      </div>
    </div>
  </div>

  <div id="indice_4" class="caja">
    <div class="caja-header">
      <h2 class="mt-4 mb-2 title text-blue-30 text-center">Menú de usuario</h2>
      <hr class="mt-2 mb-4 hr">
    </div>
    <div class="caja-body">
      <div class="my-4 mx-4 informacion">
        <p>Hasta el quinto paso, el menú de usuario solo contiene el botón 'Salir' </p>
        <p>A partir del paso 5, aparecen los botones del menú: Falta 'Perfil de usuario' y 'Favoritos' está sin desarrollar (enlaza a la página de personalización de los botones)</p>
      </div>
    
      <div class="my-4 mx-4 h-12">
        <p class=" mb-4"><a class="f_right btn smallCaps h-8 px-4 oscuro-reves" href="#indice_0"><span class="text-sm">Volver al Índice</span></a></p>
      </div>
    </div>
  </div>
</div>
@endsection