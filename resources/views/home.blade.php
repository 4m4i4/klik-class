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
      @if(auth()->user()->paso==6)
      <br>
        <p class="text-vw3 mt-2 mb-4 px-4 text-center text-blue-30 smallCaps">
            ¡¡Enhorabuena {{auth()->user()->name}} !! Lo has conseguido!! 
        </p>  

        <div class="caja marcoReloj">
           <div class="relojEnorme text-center" id="khora"></div>
        </div>
        <p class="text-vw3 mt-2 mb-4 px-4 text-center text-blue-30">
            No tienes clase
        </p>  
      @endif
    </div>

@endsection 
@section('content')
        {{-- Los tres pasos para introducir los datos: navegación lineal --}}
    @if(auth()->user()->paso > 0 && auth()->user()->paso < 6) 
        <div class="p-6  m-1  border-gray-200  md:border-l">
            <div class="text-lg leading-7 text-gray-600 ">
                <h2 class="text-center pasos-title-1 text-gray-800">{{ __('Create course')}}. {{ __('Step')}} 
                    @if(auth()->user()->paso==1) 1 @endif
                    @if(auth()->user()->paso==2) 2 @endif
                    @if(auth()->user()->paso==3) 2 @endif
                    @if(auth()->user()->paso==4) 3 @endif
                    @if(auth()->user()->paso==5) 3 @endif
                </h2>
                <p class="text-6 my-2 text-center">{{ __('Entering course data') }}</p>
            </div>
        </div>
    @endif
@endsection
@section('pasos')

    <div class="grid grid-cols-1 md:grid-cols-3">
        @includeWhen(auth()->user()->paso==1, 'configurar.paso1')
        @includeWhen(auth()->user()->paso==2, 'configurar.paso2')
        @includeWhen(auth()->user()->paso==3, 'configurar.paso2')
        @includeWhen(auth()->user()->paso==4, 'configurar.paso3')
        @includeWhen(auth()->user()->paso==5, 'configurar.paso3')
    </div>
    
@endsection