{{-- materias.show --}}
@extends('layouts.app')
@php
    use App\models\Mesa;
    $mesas = Mesa::all();
@endphp
  @section('etapaUso')
    @if(session()->get('info'))
        <div class = "text-center alert alert-info">
          {{ session()->get('info') }}  
        </div>
    @endif
    <div class="bg-666 w-100 h-100 mx-auto">  

      <div class="grid grid-rows-{{$aula->num_filas}} h-90 content-center justify-between grid-cols-{{$aula->num_columnas}}">
        @foreach ($mesas->where('user_id', auth()->user()->id)->where('aula_id', $aula->id) as $mesa)
          <div id={{$mesa->id}}
           class="mesa text-center " 
           title="mesa{{$mesa->id}} Columna{{$mesa->columna}} Fila{{$mesa->fila}}">
            @if($mesa->is_ocupada == true)
              <div>       
                <button id="bt_izq_{{$mesa->id}}" 
                    class="bt_mesa bg-amarillo text-gray-900"
                    {{-- title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}" --}}
                    onclick="sino(bt_izq_{{$mesa->id}})">No</button>
                <button id="bt_dcha_{{$mesa->id}}" 
                    class="bt_mesa bg-gradual1 f_right" 
                    {{-- title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}" --}}
                    onmousedown="lee('bt_dcha_{{$mesa->id}}')"
                    {{-- onmouseup="suma(bt_dcha_{{$mesa->id}},10)"  --}}
                    >0</button>
              </div>
              <div>
                <button id="name_{{$mesa->id}}"
                    class="nombre_mesa d_block py-0" 
                    title="Estudiante id: {{$mesa->estudiante_id}}"
                    onclick= "desabilita({{$mesa->id}})">
                    {{DB::table('estudiantes')->where('id',$mesa->estudiante_id)->value('nombre')}}  {{Str::limit(DB::table('estudiantes')->where('id',$mesa->estudiante_id)->value('apellidos'),1)}}
                    </button>
              </div> 
            @else
              <div>       
                <button id="bt_izq_{{$mesa->id}}" 
                    class="bt_mesa bt_mesaIzq" 
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    disabled>0</button>
                <button id="bt_dcha_{{$mesa->id}}" 
                    class="bt_mesa bt_mesaDcha f_right" 
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    disabled>0</button>
              </div>
              <div>
                <button class="bt_mesa d_block py-0" 
                    title=" disabled mesa id: {{$mesa->id}}" 
                    disabled>-- --</button>
              </div>
            @endif
          </div>    
        @endforeach
      </div> 
    </div>
  </div>

  @endsection

    <!-- Scripts -->

  <script>
 var ahora=document.getElementById('hora');
//  var myVar = setInterval(myTimer,1000);


  function desabilita(id){
    let dni = id;
    console.log(dni);
    let m = document.getElementById(dni);
    // m.classList.add ("falta");
    m.setAttribute("disabled","true");
    let A_bt = document.getElementById("bt_izq_" +dni);
    A_bt.setAttribute("disabled","true");
    let B_bt = document.getElementById("bt_dcha_" +dni);
    B_bt.setAttribute("disabled","true");
    let name = document.getElementById("name_" +dni);
    name.setAttribute("disabled","true");
  }

  function suma(x, y = 1){
    let res = x.innerHTML;
    res = parseInt(res) + y;
    x.innerHTML = res; 
  }

   function sino(x){
    let res = x.innerHTML;
    if(res == "Sí"){
      res = "No"; x.classList.add('bg-fucsia','text-white');
      x.classList.remove('bg-amarillo','text-gray-900');
     
    }else if(res == "No"){
      res = "Sí";      x.classList.add('bg-amarillo','text-gray-900');
      x.classList.remove('bg-fucsia','text-white');

    }
    x.innerHTML = res;
    console.log(res); 
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

  function switchColor(x,id){
    let ele = document.getElementById(id);
    switch (x) {
      case 10:ele.classList.remove('bg-gradual1');
             ele.classList.add('bg-gradual2');
        break;
      case 20:ele.classList.remove('bg-gradual2');
              ele.classList.add('bg-gradual3');
        break;
      case 30:ele.classList.remove('bg-gradual3');
              ele.classList.add('bg-gradual4');
        break;
      case 40:ele.classList.remove('bg-gradual4');
              ele.classList.add('bg-gradual5');
        break;
      case 50:ele.classList.remove('bg-gradual5');
              ele.classList.add('bg-gradual6');
        break;
      case 50:ele.classList.remove('bg-gradual6');
              ele.classList.add('bg-gradual6');
        break;
      default:document.getElementById(id).classlist.toggle('bg-gradual1');
        break;
    }
  }
    function valorTope(id,tope){
      let valor = document.getElementById(id).innerHTML;
      if(valor<50) return true;
      else return false;

    }

    function registrarEstudiante(){

    }
    function crearListaDinamica(){

    }
    var source = new EventSource()
  
</script> 
