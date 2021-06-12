{{-- /botones --}}
@extends('layouts.app')

@section('tablas')
@php
    use App\Models\Materia; use App\Models\Boton;
    $plantilla_asist= Boton::find(3);
    $plantilla_asist_bt_name= $plantilla_asist->bt_name;                                                                                                                                                                           
    $misMaterias = Materia::where('user_id', auth()->user()->id)->get();
@endphp
<div id="#page-botones" class="container">

  {{-- <div class = ""> --}}

  <div class="caja mt-4">
    <div class="caja-header mt-2">
      <div class="encabezamiento py-2">
        {{-- <h1 class="h1">Personaliza<br>Klik-Class</h1> --}}
                <h1 class="h1">Personaliza tus botones</h1>

      </div>
      {{-- <div class="menu-botones">
        <a class="items-menu-botones default" href="#indice_1">Elije tus Botones</a> --}}
        {{-- <a class="items-menu-botones default" href="#indice_2">Graduales y Combinados</a>
        <a class="items-menu-botones default" href="#indice_3">Control de Asistencia</a>
        <a class="items-menu-botones default" href="#indice_4">Botones Premio</a> --}}
      {{-- </div> --}}
      {{-- <p class="text-justify px-4 my-4">Esta es la página donde el usuario puede personalizar los botones. Se ofrecen modelos de uso para mostrar el funcionamiento de cada tipo. Las imágenes son ideas sobre su contenido</p> --}}
    </div>
  </div>
  {{-- <div class="grid grid-cols-2"> --}}
  <div class="caja">
    <div class="caja-body">
      <h2  class="my-4 text-6 text-blue-30 text-center smallCaps">Prueba cómo funcionan antes de elegir</h2>
      <hr class="my-4 hr">
      <div class="grid grid-cols-1 md:grid-cols-3">

{{-- BOOLEANO --}}
        <div id= "cloneBooleano" class="plantilla-bt">
          <div class="m-1 grid sm:grid-cols-2 md:grid-cols-1"> 
            <div class="d_block">
              <h3 class="text-center pasos-title-2 my-4">Booleano</h3>

              <p class="condensed">Nombre del botón: <span id="nombre_booleano"></span></p>

              <div class="resultado-bt">
                <p class="pasos-title-3"> Resultado: <span  class="ejemplo" id="booleano_res"></span></p>
              </div>

            </div>
            <div class="plantilla-body">
               <button id="booleano_bt" onclick="nosi()" class="bt90x90 mx-auto my-4">No</button>
            </div>
          </div>
          <div class="plantilla-footer">Usar en la materia...
            <label for="materia_id"></label>
            <select class="d_block" name="materia_id" value="" id="materia_id" multiple>
              @foreach($misMaterias as $materia)
                <option value={{$materia->id}}>{{$materia->materia_name}}</option>
              @endforeach
                <option value={{$materia_id = 0}}>Todas</option>
            </select>
            @error('materia_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  
          </div>
          <div class="mx-2 border-ccc  mb-2">
            @if(auth()->user()->paso >5)
              @include('configurar.botones.cloneBooleano')
            @endif
          </div>          
        </div>

{{-- GRADUAL --}}

        <div id="cloneGradual" class="plantilla-bt">
          <div class="m-1 grid sm:grid-cols-2 md:grid-cols-1"> 
            <div class="d_block">
              <h3 class="text-center pasos-title-2 mb-4">Gradual</h3>

              <p class="condensed">Nombre del botón: <span id="nombre_gradual"></span></p>

              <div class="resultado-bt">

                <p class="pasos-title-3"> Resultado: <span  class="ejemplo" id="g_res"></span></p>
              </div>
            </div>
            <div class="plantilla-body">
              <button id="gradual_bt" class="bt90x90 mx-auto my-4" onmousedown=" cal_gradual('gradual_bt' ,0,100,5, 'Participa')">0</button>
            </div>
          </div>
          <div class="plantilla-footer">Usar en la materia...
            <label for="materia_id"></label>
            <select class="d_block" name="materia_id" value="" id="materia_id" multiple>
              @foreach($misMaterias as $materia)
                <option value={{$materia->id}}>{{$materia->materia_name}}</option>
              @endforeach
                <option value={{$materia_id = 0}}>Todas</option>
            </select>
            @error('materia_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  
          </div>
          <div class="mx-2 border-ccc  mb-2">
            @if(auth()->user()->paso >5)
              @include('configurar.botones.cloneGradual')
            @endif
          </div>          
        </div>

{{-- ASISTENCIA --}}

        <div id= "cloneAsistencia" class="plantilla-bt">
          <div class="m-1 grid sm:grid-cols-2 md:grid-cols-1"> 
            <div class="d_block">
              <h3 class="text-center pasos-title-2  mb-4">Asistencia</h3>
              {{-- <p>Nombre:<span id="nombre_asistencia">{{ $plantilla_asist_bt_name}} --}}     

                {{-- <p class="condensed">Nombre del botón: <span id="nombre_booleano"></span></p>

              <div class="resultado-bt">
                <p class="pasos-title-3"> Resultado: <span id="booleano_res"></span></p>
              </div>

            </div>
            <div class="plantilla-body">
               <button id="booleano_bt" onclick="nosi()" class="bt90x90 mx-auto my-4">No</button>          --}}
              <p class="condensed">Nombre del botón: <span id="nombre_asistencia"></span></p>


              <div class="resultado-bt">
                <p class="pasos-title-3"> Resultado: <span class="ejemplo" id="asistencia_res"></span></p>
              </div>
            </div>
            <div class="plantilla-body">


              <button id="asistencia_bt"  class="bt90x90 mx-auto my-4 "onclick=" asistencia3()">Sí</button>
            </div>
          </div>

          <div class="plantilla-footer">Usar en la materia...
            <label for="materia_id"></label>
            <select class="d_block" name="materia_id" value="" id="materia_id"  multiple>
              @foreach($misMaterias as $materia)
                <option value={{$materia->id}}>{{$materia->materia_name}}</option>
              @endforeach
                <option value={{$materia_id = 0}}>Todas</option>
            </select>
            @error('materia_id')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror  
          </div>
          <div class="mx-2 border-ccc mb-2">
            @if(auth()->user()->paso >5)
              @include('configurar.botones.cloneAsistencia')
            @endif
          </div>          
        </div>

      </div>
    </div>
  </div>

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

  </div>

</div>


@endsection

<script>
// var nombre_gradual= document.getElementById("gradual_bt_name");
  // var ar_asistencia = [ 'Sí', 'No', 'Retraso'];
  var res_g= document.getElementById('gradual_res');
  var res_b= document.getElementById('booleano_res');
  var res_a= document.getElementById('asistencia_res');
  var nom_g= document.getElementById('nombre_gradual');

  function sumas(x, y = 1){
    let res = x.innerHTML;
    res = parseInt(res) + y;
    x.innerHTML = res; 
  }

   function nosi(){
    let bt_b= document.getElementById("booleano_bt");
    let nom_b= document.getElementById("nombre_booleano");
    let res = bt_b.innerHTML;
    let n= nom_b.innerHTML;
    
    let t= document.getElementById("booleano_res");
    let tt= t.innerHTML;

    if(res == "Sí"){
      res = "No";
      tt= "No trabaja";
      bt_b.classList.add('bg-fucsia','text-white');
      bt_b.classList.remove('bg-amarillo','text-gray-900');
     
    }else if(res == "No"){
      res = "Sí"; 
     tt= "trabaja";
      bt_b.classList.add('bg-amarillo','text-gray-900');
     bt_b.classList.remove('bg-fucsia','text-white');

    }
    bt_b.innerHTML = res;
     t.innerHTML = tt;
     nom_b.innerHTML=" Trabaja";
    console.log(res); 
  }
 function asistencia3(){
// console.log(nombre_gradual);
 var ar_asistencia = [ 'Sí', 'No', 'Retraso'];

    let bt_a= document.getElementById("asistencia_bt");
    let nom_a= document.getElementById("nombre_asistencia");
    let res = bt_a.innerHTML;
    console.log("aaa"+res);
    let n= nom_a.innerHTML;
    
    let t= document.getElementById("asistencia_res");
    let tt= t.innerHTML;
 var ar_asistencia = [ 'Sí', 'No', 'Retraso'];
  // var ar_asistencia = [ 'Primero', 'Segundo', 'Otra'];
    // if(res == ar_asistencia[0]){
    //   res = ar_asistencia[1];
    if(res == ar_asistencia[0]){
        res =ar_asistencia[1];
        // res=int(res);
      console.log("hh"+res);
      // tt= ar_asistencia[res];
      tt=res;
      console.log("tt."+tt);
      bt_a.classList.add('bg-fucsia','text-white');
      bt_a.classList.remove('bg-amarillo','text-gray-900');
     
    }else if(res == ar_asistencia[1]){
      res = ar_asistencia[2]; 
      tt= res;
      bt_a.classList.add('bg-azul-kc','text-white');
     bt_a.classList.remove('bg-fucsia');

    }else if(res == ar_asistencia[2]){
      res = ar_asistencia[0]; 
      tt=res;
      bt_a.classList.add('bg-amarillo','text-gray-900');
     bt_a.classList.remove('bg-azul-kc','text-white');

    }
    bt_a.innerHTML = tt;
     nom_a.innerHTML=" Asistencia";
    console.log("zzz"+res); 
 }
  function lee(laid){
    let valor = document.getElementById(laid).innerHTML;
    console.log("v: "+valor);
      if( parseInt(valor) < 50){        
        valor = parseInt(valor) + 10;
        document.getElementById(laid).innerHTML = valor; 
        let colorGradual = parseInt(valor) % 60;
        console.log("color gradual: "+colorGradual);
        switchColor(colorGradual,laid);
      }
  }
  function cal_gradual(dni ,v_ini,v_fin,pasos, name){
    let valor = document.getElementById(dni).innerHTML;
    document.getElementById("nombre_gradual").innerHTML = name;
    let res = document.getElementById("g_res");
    let incr = v_fin / pasos;

    if( parseInt(valor) < v_fin){        
      valor = parseInt(valor) + incr;
      document.getElementById(dni).innerHTML = valor; 
      res.innerHTML = valor;
      let colorGradual = parseInt(valor) % v_fin;
        console.log("color gradual: "+colorGradual);
        switchColorin(colorGradual,dni, incr);
    }
    // let nom_g = document.getElementById("nombre_gradual");
    // let n = nom_g.innerHTML; 
    // let n.innerHTML = name;
    
    // nom_g.innerHTML= nn;
  }
  function switchColorin(x, id, incr){
    let ele = document.getElementById(id);
    switch (x) {
      case incr:ele.classList.remove('bg-gradual1');
             ele.classList.add('bg-gradual2');
        break;
      case incr*2: ele.classList.remove('bg-gradual2');
              ele.classList.add('bg-gradual3');
        break;
      case incr*3: ele.classList.remove('bg-gradual3');
              ele.classList.add('bg-gradual4');
        break;
      case incr*4: ele.classList.remove('bg-gradual4');
              ele.classList.add('bg-gradual5');
        break;
      case incr*5: ele.classList.remove('bg-gradual5');
              ele.classList.add('bg-gradual6');
        break;

    }
  }
    function valorTope(id,tope){
      let valor = document.getElementById(id).innerHTML;
      if(valor<50) return true;
      else return false;

    }

  </script>