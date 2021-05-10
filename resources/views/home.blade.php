{{-- home --}}
@extends('layouts.app')
@section('tablas')

    <div class="mt-2 text-gray-600 text-sm">
        @if (session('status'))
            <div class="alert alert-info" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="container">
        {{-- Crear curso --}}
      @if (auth()->user()->paso==0) 
        <p class="text-6 mb-4 text-center text-blue-30 pasos-title-3">
            Hola {{auth()->user()->name}} ¡Bienvenid@ a {{ config('app.name', 'Laravel') }} !
        </p>  
        <div class="caja" >
            <div class="caja-header leading-7 mx-auto text-gray-600 ">
                <p class="mb-4 mt-1 text-center">Tenemos todo preparado para que puedas </p>
                <h2 class="text-center mb-1 text-blue-30 pasos-title-1 sm:pasos-title">
                    <strong>Crear un Curso</strong>
                </h2>
            </div>
        
            <div class="caja-body">
                <div class="mx-auto m-1 grid md:gridcols-2 sm:gridcols-1 justify-center"> 
                    <div class="caja-grid m-1 px-6 bg-gray-100 ">
                        <p class="mt-4"><strong>Un curso</strong> es el registro de los datos de tus clases (horario, estudiantes, aulas, etc) que necesitas para poner a punto a Klik-Class.</p>
                        <p class="mt-4">Hemos dividido esta etapa en <strong>3 pasos</strong> para ayudarte en una tarea <em>algo</em> aburrida, no te vamos a engañar... </p>    
                    </div>               
                    <div class="caja-grid  m-1 px-6  bg-gray-100 ">
                        <p class="mt-4">Con cada <strong>formulario</strong> enviado  ¡¡estás más cerca del final!!</p><p class="mt-4"> Haz clic en tu nombre <strong> para salir </strong>de Klik-Class si te apetece...</p><p class="mt-4">Al volver verás que todo está <strong>guardado</strong>.<br>
                        Pulsa <strong>Crear Curso</strong> cuando quieras empezar...</p>
                    </div>
                </div>

                <form class=" text-center " method="POST" action="{{route('crearCurso',$user->id)}}">
                    @csrf
                    @method("PUT")
                        <button type="submit" 
                            title="Crear Curso" 
                            class="btn d_block h-12 crearCurso">Crear Curso <button>
                </form>
            </div>
        </div>
      @endif
        {{-- Fase de uso --}}
      @if(auth()->user()->paso>=5)
        <br>
        @if(auth()->user()->paso==5)
        {{-- El mensaje desaparece en cuanto salga de esta página --}}
        <p class="text-vw3 mt-2 mb-4 px-4 text-center text-blue-30 smallCaps">
            ¡¡Enhorabuena {{auth()->user()->name}} !! Lo has conseguido!! 
        </p>
        @endif
        {{-- <form id="enviaHora" > --}}
        <div class="caja marcoReloj">
           {{-- <textarea class="relojEnorme text-center" id="ahora" name="ahora"></textarea> --}}
            <div class="relojEnorme text-center" id="khora" name="ahora" 
            {{-- onchange="enviaHora(this.id)" --}}
            ></div>
            {{-- <button type="submit">Enviar</button> --}}
        </div>
        {{-- </form> --}}

        <p class="text-vw3 mt-2 mb-4 px-4 text-center text-blue-30">
        No tienes clase
        </p>  
      @endif
    </div>
@endsection 


@if(auth()->user()->paso > 0 && auth()->user()->paso < 5) 
        {{-- Los tres pasos para introducir los datos: navegación lineal --}}
    @section('content')    
        <div class="p-6  m-1  border-gray-200  md:border-l">
            <div class="text-lg leading-7 text-gray-600 ">
                <h2 class="text-center pasos-title-1 text-gray-800">{{ __('Create course')}}. {{ __('Step')}} 
                    @if(auth()->user()->paso==1) 1 @endif
                    @if(auth()->user()->paso==2) 2 @endif
                    @if(auth()->user()->paso==3) 2 @endif
                    @if(auth()->user()->paso==4) 3 @endif
                    {{-- @if(auth()->user()->paso==5) 3 @endif --}}
                </h2>
                <p class="text-6 my-2 text-center">{{ __('Entering course data') }}</p>
            </div>
        </div>
    @endsection        


    @section('pasos')

    <div class="grid grid-cols-1 md:grid-cols-3">
        @includeWhen(auth()->user()->paso==1, 'configurar.paso1')
        @includeWhen(auth()->user()->paso==2, 'configurar.paso2')
        @includeWhen(auth()->user()->paso==3, 'configurar.paso2')
        @includeWhen(auth()->user()->paso==4, 'configurar.paso3')
    </div>
    
    <div class="h-8"></div>
   
    @endsection 
@endif

<script>
    // var ahora = document.getElementById('khora');
    // function myTimer(){
    //   var x = new Date();
    //   var options = {hour:'2-digit', minute: '2-digit',hour12: false};
    //   // console.log(new Intl.DateTimeFormat('es-ES', options).format(d).replace(/\//g,'-').replace(',',''));
    //   ahora.innerHTML = new Intl.DateTimeFormat('es-ES', options).format(d).replace(/\//g,'-').replace(',',''); 
    //   // queHora.innerHTML = d.toLocaleTimeString(); 
    //   var queDia = document.getElementById("kdiaes");
    //   var dias = ["Domingo","Lunes", "Martes", "Miércoles","Jueves","Viernes","Sábado"];
    //   var dia = x.getDay();
    //   var n = x.getDate();
  
    //   if(queDia!==null)
    //   // queDia.innerHTML = d.toLocaleDateString();
    //   queDia.innerHTML = n+" "+ dias[dia];
    // }


  
    //   var ya = ahora.value;
    //   console.log(ya);
    //   var enviaHora = document.getElementById('enviaHora');
    //   enviaHora.addEventListener('submit',function(e){
    //       e.preventDefault();
    //       console.log('has hecho click');
    //       var datos = newFormData('enviaHora');


    // var datos =  document.getElementById('khora');
    //   console.log(datos.get('ahora'));
    //   fetch('http://127.0.0.1:8000/home/mostrarClase',{
    //       method:'post',
    //       body:'datos'
    //   })
    //   .then(res=>res.json())
    //   .then(data=>{
    //       console.log(data);
    //   });
 
    function enviaHora(cadena){
      let x = document.getElementById(cadena);
      ahora = x.value;
      console.log("hora: "+ahora);
        //   document.getElementById(cadena).value = value_materia_id;
        //   var xhr = new XMLHttpRequest();
        //   xhr.open('POST',`{{route('home')}}`,true);
        //   xhr.setRequestHeader('Content-Type','application/json');
        //   xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        // xhr.onreadystatechange = function(){
        //   document.getElementById('respuesta').innerHTML = xhr.responseText;
        // }
        //   xhr.send(location.replace(value_materia_id));
    }
</script>