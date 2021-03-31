  <div class="flex-row items-center justify-between h-12 bg-36">
    <div class="flex-row items-center">
      <a href="/home" title= "home">
        <svg class="mx-2  d_inline f_left" width="38px" height="38px" viewBox="0 0 128 128">
            @include("include.logoQuad")
        </svg>
      </a>   

      <span class="bt-clase-header bg-sky text-overflow">{{$aula->aula_name}}</span>
      <a href="{{route('aulas.editMesasVacias',$aula->id)}}" title="Sentar de nuevo a los estudiantes" class="bt-clase-header mx-2 editar" >Mesas</a>
      <span id="khora" class=" reloj"></span> 
    </div>
    <div class="flex-row items-center">
       
     
    </div>
    <div  class="flex-row items-center">
         {{-- <a href="{{route('aulas.editMesasVacias',$aula->id)}}"  class="bt-clase-header f_left px-1 mx-2 editar" >Mesas</a> --}}
        {{-- <a href="#" id="id_{{$aula->id}}" class="bt-clase-header f_left px-1 mx-2 editar" onclick="vaciasModal(this.id)">Mesas</a> --}}
        {{-- <a href="{{route('aulas.editMesasVacias',$aula->id)}}" title= "editar mesas vacias">Mesas</a> --}}
     

      <span id="kdiaes" class=" mr-2  text-overflow"></span>

        {{-- <a href="{{ url()->previous()}}" class=" px-1 mx-2 atras">Atrás</a> --}}
      <a href="{{ route('materias.index')}}" class="bt-clase-header mr-l btn atras">
      <span class="ico-shadow "> 👈 </span>
      <span class="bt-text-hide" title="Volver a la lista"> Atrás</span></a>
    </div>  
  </div> 