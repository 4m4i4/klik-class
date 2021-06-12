{{-- pageFooter --}}

@php 
  // use App\Models\helpers;
  $meses =[ '',
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
          ];
  $dias =[ "Domingo",
           "Lunes",
           "Martes",
           "Miércoles",
           "Jueves",
           "Viernes",
           "Sábado"
          ];

  $h= now();
  $date = date_create("$h");
  $diaSemana = $dias[date("w")]; 
  $ddia = date("d");
  $dmes = $meses[date("n")];
  $danio = date("Y");
  $fecha = $diaSemana." ". $ddia." de ". $dmes. " de ".$danio;



@endphp

      {{-- reloj javascript             --}}
    <div class="reloj" id="khora"></div> 

    {{-- <div class="reloj ml-2"> {{-- reloj php --}}
      {{-- @php
        $ahora=function (){
          while(1){
            $hora = new DateTime();
            $ahora = $hora->format('H:i');
            sleep(1000);
          }
          return $ahora;
        };
      @endphp 
      {{$ahora}}</div> --}}
    <div class="fecha px-8">{{$fecha}} </div>
    <div>PASO:  <!--Qué paso está el usuario. Solo desarrollo-->
      @if(auth()->user()!==null)
        {{auth()->user()->paso}} 
      @else 0
      @endif
    </div>
    {{-- <div><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/" title="Creative Commons Reconocimiento-NoComercial-CompartirIgual 4.0 Internacional License" ><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png"/></a></div> --}}
<script>
  var ahora = document.getElementById('khora');
</script>