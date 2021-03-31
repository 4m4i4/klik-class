@extends('layouts.app')

  @section('etapaUso')
  @php
  use App\Models\Mesa;
      $mesas = Mesa::all();
  @endphp
      {{-- @php
        use App\Models\Estudiante;
        use App\Models\Mesa;
        use App\Models\Materia;
        use Illuminate\Support\Arr;          
        $mesas = Mesa::all();
        $hasMesas = $aula->mesas;
        // dd( $mesas);
        $n_col = $aula->num_columnas;
        $n_fila = $aula->num_filas;
        $user = auth()->user()->id;
        $aula_hasMesas = $mesas->where('aula_id',$aula->id)->first();
        $materia = Materia::where('user_id', $user)->where('grupo', $aula->aula_name)->first();
        $index = 0;
        $mesasIndex = [];
        $studentIndex=[];
        $estudiantes = $materia->estudiantes;
        // dd($estudiantes);
        $n_student = $estudiantes->count();
        $contador = 0;
            
      @endphp
            
      <div class="flex justify-center">
        <div class="grid grid-cols-{{$n_col}}">
          @if($aula_hasMesas == null) Si no hay mesas recarga la página
            @for ($i = $n_fila;  $i > 0; $i--) 
              @for ($ii = 1; $ii <= $n_col; $ii++)
                @php
                  $mesa = new Mesa;
                  $mesa->columna = $ii;
                  $mesa->fila = $i;
                  $mesa->aula_id = $aula->id;
                  $mesa->clase_id = $aula->clase->id;
                  $mesa->is_ocupada = true;
                  if($index < $aula->num_mesas) {
                    $mesa->save();
                    $mesa->refresh();
                  }
                  $mesasIndex[$index] = $index;
                  $index++;
                @endphp
              @endfor
            @endfor

            @php
              // for ($i = 0; $i < $n_student; $i++) { 
              //   $studentIndex[$i] = $i;
              // }
              // $randomList = Arr::shuffle($studentIndex);
              //   dd($randomList);
              $n_mesas = $aula->num_mesas;
              $dif = $n_mesas - $n_student;
              // dd($hasMesas);
              $estaMesa = Mesa::where('aula_id',$aula->id)->get();
              $firstMesa = $estaMesa[0]->id;
              $lastMesa = $firstMesa + $estaMesa->count();   
              // si hay mesas vacías
              if($dif > 0){
                $mesasIndex = Arr::shuffle($mesasIndex);
                $vacias = Arr::random($mesasIndex, $dif);
                // dd($mesasIndex);
                for ($ii = 0; $ii < count($vacias); $ii++){
                  $indice = $vacias[$ii] + $firstMesa;
                  // asignar null a estudiante_id en las mesas vacías 
                  DB::table('mesas')->where('id',$indice)->update(['is_ocupada'=>false]);
                }  
              }
              // dd($firstMesa);
              // dd($mesas);
              // dd($lastMesa);
              // Sentar estudiantes
              for($i = $firstMesa; $i < $lastMesa; $i++){
                $mesa_id = Mesa::find($i);
                if($mesa_id->is_ocupada == true  && $contador < $estudiantes->count()){
                    $mesa_id->is_ocupada = true;
                    $mesa_id->estudiante_id = $estudiantes[$contador]->id;
                    $mesa_id->save();
                    $mesa_id->refresh();
                    $contador++;
                } 
              } 
            @endphp
          @endif
        </div> --}}
         <hr class="h-2">  
         <div class="bg-666 w-100 h-100 mx-auto">  
        <div class="grid grid-cols-{{$aula->num_columnas}} mx-4 p-6 grid-rows-{{$aula->num_filas}} h-90  ">
            {{-- {{dd( $hasMesas)}} --}}
            {{-- {{dd( $mesas)}} --}}
          @foreach ($mesas->where('aula_id', $aula->id) as $mesa)
            <div id={{$mesa->id}} class="mesa text-center flex-column justify-center" title="mesa_{{$mesa->id}}">
              @if($mesa->is_ocupada == true)
                <div>       
                  <button id="A_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}" 
                    class="bt_mesa propiedad_A bg-sobreB"
                    title="A_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}"
                    {{-- onmousedown="this.classList.toggle('bg-sobreB')" --}}
                    onclick="sino(A_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}),lee(A_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}})">Sí</button>
                  <button id="B_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}" 
                    class="bt_mesa propiedad_B bg-sky f_right" 
                    title="B_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}"
                    onclick="suma(B_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}},10),lee('B_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}')">0</button>
                </div>
                <div class="">
                  <button id="name_{{$mesa->id}}" class="nombre_mesa d_block py-0" title=" id: {{$mesa->estudiante->id}}" onclick= "desabilita({{$mesa->id}})">{{$mesa->estudiante->nombre}} {{Str::limit($mesa->estudiante->apellidos, 1)}}</button>
                </div> 
              @else
                <div>       
                  <button id="A_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}" class="bt_mesa propiedad_A " disabled title="A_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}"></button>
                  <button id="B_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}" class="bt_mesa propiedad_B f_right" disabled title="B_bt_{{$mesa->id}}_{{$mesa->columna}}_{{$mesa->fila}}"></button>
                </div>
                <div class="nombre_mesa" disabled>
                  <button class="nombre_mesa d_block py-0" title=" disabled: {{$mesa->id}}" disabled>-- --</button>
                </div>
              @endif
            </div>    
          @endforeach
</div> 
          {{-- @for($i = $firstMesa; $i < $lastMesa; $i++)

            <div class="mesa text-center" title="mesa_{{$i}}">
              <div>       
                <button id="bt_A_{{$i}}" class="bt_mesa propiedad_A" title="bt_A_{{$i}}">A</button>
                <button id="bt_B_{{$i}}" class="bt_mesa propiedad_B f_right" title="bt_B_{{$i}}">B</button>
              </div>
              <div class="nombre_mesa">
                @if($mesas[$i]->is_ocupada == true)  --}}
                
                  {{-- @if($contador < $estudiantes->count()) --}}
                    {{-- @php
                      // $item=$studentIndex[$contador]
                      // $item = $contador
                      $item = $randomList[$contador]
                    @endphp

                    {{$contador}}.  --}}
                    {{-- escribir los nombres de estudiantes--}}
                    {{-- {{ Str::limit($estudiantes[$item]->nombre,9) }} {{ Str::limit($estudiantes[$item]->apellidos,1) }} - id{{$estudiantes[$item]->id}}
                      @php
                        DB::table('mesas')->where('id',$i)->update(['is_ocupada'=>true,'estudiante_id'=>$estudiantes[$item]->id]) ;
                         $contador++;
                      @endphp
                @else
                   ---.
                   @php
                       $contador--;
                   @endphp
                @endif
              </div>
            </div>              
          @endfor --}}

                  {{-- leer los nombres desde la tabla mesas --}}
                    {{-- <strong>{{$mesas[$i -1]->estudiante->nombre}}</strong> {{Str::limit($mesas[$i -1]->estudiante->apellidos, 1)}} id: {{$mesas[$i -1]->estudiante->id}} --}}
        </div>
      </div>

  @endsection
                <!--FIN: App -->
      {{-- <div id="edit_vacias" class="modal">
        @include('configurar/vacias') 
      </div> --}}
    <!-- Scripts -->

      <script>
          // function vaciasModal(valor_id){
          //   let ar_id = valor_id.split('_');
            
          //   let aula_id = ar_id[1];
          //   // document.getElementById("ver_grupo").innerHTML = grupo ;
          //   document.getElementById("ver_aula_id").value = aula_id;
          //   document.getElementById('edit_vacias').style.display = 'block';
          // }

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
      let el=document.getElementById(x);
     let valor=  el.value;
     console.log("hola "+valor);    
    res = parseInt(res) + y;
    x.innerHTML = res;
       
  }
  function sino(x){
    let res = x.innerHTML;
    if(res=="Sí"){
      res="No";
      x.classList.remove('bg-sobreB');
      x.classList.add('bg-sobreN');
    }else if(res=="No"){
      res="Sí";
      x.classList.remove('bg-sobreN');
      x.classList.add('bg-sobreB');
      }

    x.innerHTML = res;
    console.log(res); 
    // x.classList.toggle('bg-sobreN');
  }
  function lee(x){
   let valor =document.getElementById(x).innerHTML;
   console.log("v: "+valor);
  let cero= parseInt(valor)%50;
  console.log("resto: "+cero);
  if(cero==0){
    document.getElementById(x).classList.toggle('bg-blue');
  }
  }
</script> 
