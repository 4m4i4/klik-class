@extends('layouts.app')

  @section('etapaUso')
  @php
  use App\Models\Mesa;
      $mesas = Mesa::all();
  @endphp
 
    <hr class="h-2">  
    <div class="bg-666 w-100 h-100 mx-auto">  
      <div class="grid grid-cols-{{$aula->num_columnas}} mx-4 grid-rows-{{$aula->num_filas}} h-90  ">
            {{-- {{dd( $hasMesas)}} --}}
            {{-- {{dd( $mesas)}} --}}
        @foreach ($mesas->where('aula_id', $aula->id) as $mesa)
          <div id={{$mesa->id}} class="mesa text-center flex-column justify-center" title="mesa_{{$mesa->id}}">
            @if($mesa->is_ocupada == true)
              <div>       
                <button id="A_bt_{{$mesa->id}}" 
                    class="bt_mesa propiedad_A bg-sobreB"
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    {{-- onmousedown="this.classList.toggle('bg-sobreB')" --}}
                    onclick="sino(A_bt_{{$mesa->id}})">Sí</button>
                <button id="B_bt_{{$mesa->id}}" 
                    class="bt_mesa propiedad_B bg-sky f_right" 
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    onclick="suma(B_bt_{{$mesa->id}},10),lee('B_bt_{{$mesa->id}}')">0</button>
              </div>
              <div>
                <button id="name_{{$mesa->id}}"
                    class="nombre_mesa d_block py-0" 
                    title="Estudiante id: {{$mesa->estudiante->id}}" 
                    onclick= "desabilita({{$mesa->id}})">{{$mesa->estudiante->nombre}} {{Str::limit($mesa->estudiante->apellidos, 1)}}</button>
              </div> 
            @else
              <div>       
                <button id="A_bt_{{$mesa->id}}" 
                    class="bt_mesa propiedad_A" 
                    title="Mesa id: {{$mesa->id}}. Columna {{$mesa->columna}}, Fila {{$mesa->fila}}"
                    disabled>0</button>
                <button id="B_bt_{{$mesa->id}}" 
                    class="bt_mesa propiedad_B f_right" 
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

  function desabilita(id){
    let dni = id;
    console.log(dni);
    let m = document.getElementById(dni);
    // m.classList.add ("falta");
    m.setAttribute("disabled","true");
    let A_bt = document.getElementById("A_bt_" +dni);
    A_bt.setAttribute("disabled","true");
    let B_bt = document.getElementById("B_bt_" +dni);
    B_bt.setAttribute("disabled","true");
    let name = document.getElementById("name_" +dni);
    name.setAttribute("disabled","true");
  }

  function suma(x, y = 1){
    let res = x.innerHTML;
    // let el = document.getElementById(x);
    // let valor =  el.value;
    // console.log("suma " + valor);    
    res = parseInt(res) + y;
    x.innerHTML = res; 
  }

  function sino(x){
    let res = x.innerHTML;
    if(res == "Sí"){
      res = "No";
      x.classList.remove('bg-sobreB');
      x.classList.add('bg-sobreN');
    }else if(res == "No"){
      res = "Sí";
      x.classList.remove('bg-sobreN');
      x.classList.add('bg-sobreB');
    }
    x.innerHTML = res;
    console.log(res); 
    // x.classList.toggle('bg-sobreN');
  }

  function lee(x){
    let valor = document.getElementById(x).innerHTML;
    console.log("v: "+valor);
    let cero = parseInt(valor)%50;
    console.log("resto: "+cero);
    if(cero == 0){
      document.getElementById(x).classList.toggle('bg-blue');
    }
  }
</script> 
