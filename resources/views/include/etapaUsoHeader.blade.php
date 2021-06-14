  <div class="header-uso flex-row items-center justify-between h-12 bg-36">
    <div class="  flex-row  items-center  ">
      <a href="/home" title= "home">
        <svg class="mx-2 mb-1 d_inline f_left" width="34px" height="34px" viewBox="0 0 128 128">
            @include("include.logoQuad")
        </svg>
      </a>   
      <span id="khora" class=" reloj"></span> 
      <span id="renderAula" class="bt-clase-header bg-sky text-black" title="{{$aula->id}}">{{ Str::before($materia->materia_name," ") }} <strong class="bt-text-hide">{{Str::after($materia->materia_name," ") }}</strong></span>
      <a href="{{route('aulas.editMesasVacias',$aula->id)}}" title="Sentar de nuevo a los estudiantes" class="bt-clase-header mx-2 editar"><span>Mesas</span></a>
    </div>
    <div class="flex-row  items-center mr-4">
      <span id="kdiaes" class="reloj text-overflow"></span>
      @if(auth()->user()->paso < 5)
        <a href="{{ route('materias.index')}}" class="bt-clase-header atras">
      @else
        <a href="{{ route('home')}}" class="bt-clase-header atras">
      @endif
      <span class="ico-shadow "> 👈 </span>
      <span class="bt-text-hide" title="Volver a la lista"> Atrás</span></a>
    </div>  
  </div> 

  <script>

// function screenResize(){
//   var screenWidth=screen.availWidth;
//   if(screenWidth>=414) var dias = ["Domingo","Lunes", "Martes", "Miércoles","Jueves","Viernes","Sábado"];
//   if(screenWidth<414) var dias = ["Do","Lu", "Ma", "Mi","Ju","Vi","Sa"];
//   return dias;
// }

//     screenWidth= screenResize();
//     if(screenWidth>=414){
//   var semana=`'Horario','Lunes','Martes','Miercoles','Jueves','Viernes'`;
//   var dias = ["Domingo","Lunes", "Martes", "Miércoles","Jueves","Viernes","Sábado"];}
// if(screenWidth<414){
// var semana=`'Hora','Lun','Mar','Mie','Jue','Vie'`;
//  var dias = ["Do","Lu", "Ma", "Mi","Ju","Vi","Sa"];
// }
  // var ahora = document.getElementById('khora');
  </script>