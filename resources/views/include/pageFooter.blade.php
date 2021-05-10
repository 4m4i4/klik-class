{{-- pageFooter --}}

@php 
  $meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];                
  $h= now(); 
  $date = date_create("$h");
  $ddia = date_format($date, "d");
  $dmes = $meses[date_format($date, "n")];
  $danio = date_format($date, "Y");
  $fecha =  $ddia." de ". $dmes. " de ".$danio;
  $diaMes=  $ddia." de ". $dmes;
  $laHora = date_format($date, "H:i");
@endphp
<div style="max-width=360px">

  <div class="grid grid-cols-3-auto">
      {{-- reloj javascript             --}}
    <span class="reloj" id="khoraes"></span> 
      {{-- {{$laHora}} ...    --}}
    <span class="fecha">{{$diaMes}} </span>
    <span>PASO:  <!--Qué paso está el usuario. Solo desarrollo-->
      @if(auth()->user()!==null)
        {{auth()->user()->paso}} 
      @else 0
      @endif
    </span>
  </div>
</div>