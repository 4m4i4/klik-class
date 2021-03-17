  <div class="flex flex-row items-center"> 
        <a href="/home" title= "home">
          <svg class="mx-2  d_inline f_left" width="32px" height="32px" viewBox="0 0 128 128">
            @include("include.logoQuad")
          </svg>
        </a>
        <span class="bt-clase-header f_left ml-2 primary-reves">{{$aula->aula_name}}</span>
        <a href="{{route('aulas.editMesasVacias',$aula->id)}}"  class="bt-clase-header f_left px-1 mx-2 editar" >Mesas</a>
         {{-- <a href="{{route('aulas.editMesasVacias',$aula->id)}}"  class="bt-clase-header f_left px-1 mx-2 editar" >Mesas</a> --}}
        {{-- <a href="#" id="id_{{$aula->id}}" class="bt-clase-header f_left px-1 mx-2 editar" onclick="vaciasModal(this.id)">Mesas</a> --}}
        {{-- <a href="{{route('aulas.editMesasVacias',$aula->id)}}" title= "editar mesas vacias">Mesas</a> --}}
        <span id="khora" class="bt-clase-header f_left primary-reves reloj"></span>   
        <span id="kdiaes" class="bt-clase-header f_right oscuro-reves reloj mr-2  text-overflow"></span>
        <a href="{{ url()->previous()}}" class="bt-clase-header f_left px-1 mx-2 atras">Atrás</a>
  </div> 