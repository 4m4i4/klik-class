{{-- /botones --}}
@extends('layouts.app')

@section('tablas')
@php
    use App\Models\Materia; 
    use App\Models\Boton;
    $plantilla_asist= Boton::find(3);
    $plantilla_asist_bt_name= $plantilla_asist->bt_name;                                           
    $misMaterias = Materia::where('user_id', auth()->user()->id)->get();
@endphp
<div id="#page-botones" class="container">

  {{-- <div class = ""> --}}

  <div class="caja mt-4">
    <div class="caja-header mt-2">
      <div class= "py-2">
<h2 class="title text-center">Personaliza tus botones</h2>
     
    {{-- <div class="caja-header bg-gradual5">
      <h2 class="mt-4 mb-4 title text-white text-center">Personaliza tus botones</h2>
      {{-- <hr class="mt-2 mb-4 hr"> --}}
    </div> 
  
      </div>
    </div>
  {{-- <div class="grid grid-cols-2"> --}}
  <div class="caja">
    {{-- <div class="caja-header">
      <h2 class="mt-4 mb-2 title text-blue-30 text-center">Prueba cómo funcionan antes de elegir tus botones</h2>
      <hr class="mt-2 mb-4 hr">
    </div> --}}

          <div class="caja-body">
      <h2  class="my-4 text-6 text-blue-30 text-center smallCaps">Prueba cómo funcionan antes de elegir</h2>
      <hr class="my-4 hr">
      <div class="grid grid-cols-1 md:grid-cols-3">

{{-- BOOLEANO --}}
        <div id= "cloneBooleano" class="plantilla-bt">
          <div class="m-1 grid sm:grid-cols-2 md:grid-cols-1">
            {{-- Nombre --}}
            <div class="d_block">
              <h3 class="text-center pasos-title-2 my-4">Booleano</h3>
              <p class="condensed">Nombre: <span class="ejemplo" id="nombre_booleano"></span></p>
              <div class="resultado-bt">
                <p class="smallCaps text-center"><span class="ejemplo text-6" id="booleano_res"></span></p>
              </div>
            </div>
            {{-- MÉTODOS, functions --}}
            <div class="plantilla-body">
               <div class="bt90x90 no_border mx-auto my-4 bg-36">
               <button id="booleano_bt" onclick="nosi()" class="bt90x90 my-0 -mt--03 mx-auto ">No</button></div>
            </div>
          </div>
          {{-- selecciona materias --}}
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
          {{-- FORMulario personalización --}}
          <div class="personalizar  mb-2">
            @if(auth()->user()->paso >5)
              @include('configurar.botones.cloneBooleano')
            @endif
          </div>          
        </div>
      

{{-- GRADUAL --}}
        <div id="cloneGradual" class="plantilla-bt">
          <div class="m-1 grid sm:grid-cols-2 md:grid-cols-1"> 
            {{-- Nombre --}}
            <div class="d_block">
              <h3 class="text-center pasos-title-2 mb-4">Gradual</h3>
              <p class="condensed">Nombre: <span id="nombre_gradual" class="ejemplo"></span></p>
              <div class="resultado-bt">
                <p class="smallCaps text-center"><span class="ejemplo text-6" id="g_res"></span></p>
              </div>
            </div>
            {{-- MÉTODOS, functions --}}
            <div class="plantilla-body">
              <button id="gradual_bt" class="bt90x90 mx-auto my-4"
              onmousedown=" cal_gradual( 'gradual_bt',0,100,10, 'Participa')">0</button>
            </div>
          </div>
          {{-- selecciona materias --}}
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
          {{-- FORMulario personalización --}}
          <div class="personalizar  mb-2">
            @if(auth()->user()->paso >5)
              @include('configurar.botones.cloneGradual')
            @endif
          </div>          
        </div>

{{-- ASISTENCIA --}}
        <div id= "cloneAsistencia" class="plantilla-bt">
          <div class="m-1 grid sm:grid-cols-2 md:grid-cols-1"> 
            {{-- Nombre --}}
            <div class="d_block">
              <h3 class="text-center pasos-title-2  mb-4">Asistencia</h3>
              <p class="condensed">Nombre: <span class="ejemplo" id="nombre_asistencia"></span></p>
              <div class="resultado-bt">
                <p class="smallCaps text-center"><span class="ejemplo text-6" id="asistencia_res"></span></p>
              </div>
            </div>
            {{-- MÉTODOS, functions --}}
            <div class="plantilla-body">
              <button id="asistencia_bt" class="bt90x90 mx-auto condensed my-4 "onclick=" asistencia3()">Presente</button>
            </div>
          </div>
          {{-- selecciona materias --}}
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
          {{-- FORMulario personalización --}}
          <div class="personalizar  mb-2">
            @if(auth()->user()->paso >5)
              @include('configurar.botones.cloneAsistencia')
            @endif
          </div>          
        </div>

      </div>
    </div>
  </div>

 

  </div>

</div>


@endsection

<script>

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
      bt_b.classList.add('bg-fucsia','text-white','circle');
      bt_b.classList.remove('bg-amarillo','text-gray-900');     
    }else if(res == "No"){
      res = "Sí"; 
      tt= "trabaja";
      bt_b.classList.add('bg-amarillo','text-gray-900');
      bt_b.classList.remove('bg-fucsia','text-white','circle');
    }
    // escribir resultado
    bt_b.innerHTML = res;
    t.innerHTML = tt;
    nom_b.innerHTML=" Trabaja";
    console.log(res); 
  }

  function asistencia3(){
    var ar_asistencia = [ 'Presente', 'Ausente', 'Retraso'];

    let bt_a = document.getElementById("asistencia_bt");
    let nom_a = document.getElementById("nombre_asistencia");
    let res = bt_a.innerHTML;
    console.log("aaa"+res);
    let n = nom_a.innerHTML;
    
    let t = document.getElementById("asistencia_res");
    let tt = t.innerHTML;
    var ar_asistencia = [ 'Presente', 'Ausente', 'Retraso'];

    if(res == ar_asistencia[0]){
        res = ar_asistencia[1];
        console.log("hh"+res);
        // tt= ar_asistencia[res];
        tt = res;
        console.log("tt."+tt);
        bt_a.classList.add('bg-fucsia','text-white');
        bt_a.classList.remove('bg-azul-kc');
      
    }else if(res == ar_asistencia[1]){
        res = ar_asistencia[2]; 
        tt = res;
        bt_a.classList.add('bg-amarillo','text-gray-900');
        bt_a.classList.remove('bg-fucsia','text-white');

    }else if(res == ar_asistencia[2]){
        res = ar_asistencia[0]; 
        tt = res;
        bt_a.classList.add( 'bg-azul-kc','text-white');
        bt_a.classList.remove('bg-amarillo','text-gray-900');
    }
    // escribir resultado
    document.getElementById("asistencia_res").innerHTML = tt;
    bt_a.innerHTML = tt;
    nom_a.innerHTML =" Asistencia";
    console.log("zzz"+res); 
  }
  
  var gradual_bt_name = document.getElementById("gradual_bt_name");
  // var g_bt_n = gradual_bt_name.value;
  var gradual_descripcion = document.getElementById("gradual_descripcion");
  // var g_descrp = gradual_descripcion.value;
  var gradual_default = document.getElementById(gradual_default);
  // var g_default = gradual_default.value;
  var gradual_v_last = document.getElementById(gradual_v_last);
  // var g_v_last = gradual_v_last.value;
  var gradual_pasos = document.getElementById("gradual_pasos");
  // var g_pasos = gradual_pasos.value;

 function getValor(x){
   var valor = document.getElementById(x).value;
   console.log(valor);
   return valor;
 }
//  var v_ini = getValor(gradual_default);
//  var v_fin = getValor(gradual_v_last);
//  var pasos = getValor(gradual_pasos);
//  var name = getValor(gradual_bt_name);
//  var dscrp = getValor(gradual_descripcion);



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

  function cal_gradual(dni, v_ini, v_fin, pasos, name){
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

  function valorTope(id, tope){
    let valor = document.getElementById(id).innerHTML;
    if(valor<50) return true;
    else return false;
  }



</script>