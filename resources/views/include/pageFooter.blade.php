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
  // $diaSemana = $dias[date_format($date,"w")];       
  // $ddia = date_format($date, "d");
  // $dmes = $meses[date_format($date, "n")];
  // $danio = date_format($date, "Y");

  $fecha = $diaSemana.", ". $ddia." de ". $dmes. " de ".$danio;
  $diaMes=  $ddia." de ". $dmes;
  // $ahora = new DateTime();
  // $laHora = $ahora->format('H:i');
  // $laHora = date_format($date, "H:i");
  // $laHora = $ahora;
  // $ahora= new DateTime();
  // $ahora= $ahora->format('i');
  $ahora = date('H : i');




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
