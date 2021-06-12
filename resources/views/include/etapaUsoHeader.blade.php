  <div class="flex-row items-center justify-between h-12 bg-36">
    <div class="flex-row items-center">
      <a href="/home" title= "home">
        <svg class="mx-2  d_inline f_left" width="38px" height="38px" viewBox="0 0 128 128">
            @include("include.logoQuad")
        </svg>
      </a>   
      <span id="khora" class=" reloj"></span> 
      <span id="renderAula" class="bt-clase-header pt-03 bg-sky text-overflow" title="{{$aula->id}}">{{$materia_name}}</span>
      <a href="{{route('aulas.editMesasVacias',$aula->id)}}" title="Sentar de nuevo a los estudiantes" class="bt-clase-header pt-03 mx-2 editar"><span>Mesas</span></a>
    </div>
    <div class="flex-row items-center">
       
     
    </div>
    <div  class="flex-row items-center mr-2">
      <span id="kdiaes" class=" mr-2 reloj text-overflow"></span>
      @if(auth()->user()->paso < 5)
        <a href="{{ route('materias.index')}}" class="bt-clase-header btn atras">
      @else
        <a href="{{ route('home')}}" class="bt-clase-header btn atras">
      @endif
      <span class="ico-shadow "> 👈 </span>
      <span class="bt-text-hide" title="Volver a la lista"> Atrás</span></a>
    </div>  
  </div> 

  <script>
  // var ahora = document.getElementById('khora');
  </script>