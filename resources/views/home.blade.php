@extends('layouts.app')

@section('content')

    <div class="p-6  m-1  border-gray-200 dark:border-gray-700 md:border-l">
        <div class="text-lg leading-7 text-gray-600 dark:text-white">

            <h2 class="text-center pasos-title-1">{{ __('Create course')}}. {{ __('Step')}} 
            
                @if(auth()->user()->paso==1) 1 @endif
                @if(auth()->user()->paso==2) 2 @endif
                @if(auth()->user()->paso==3) 2 @endif
                @if(auth()->user()->paso==4) 3 @endif
                @if(auth()->user()->paso==5) 3 @endif
           
            </h2>
            <p class="text-6 my-2 text-center">{{ __('Entering course data') }}</p>
         
        </div>

        <div class="ml-12">
            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                @if (session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                         {{-- {{ __('You are logged in!') }} --}}
            </div>
        </div>
    </div>                    

@endsection
@section('pasitos')
    <div class="grid grid-cols-1 md:grid-cols-3">
        
        @includeWhen(auth()->user()->paso==1, 'configurar.paso1')
        @includeWhen(auth()->user()->paso==2, 'configurar.paso2')
        @includeWhen(auth()->user()->paso==3, 'configurar.paso2')
        @includeWhen(auth()->user()->paso==4, 'configurar.paso3')
        @includeWhen(auth()->user()->paso==5, 'configurar.paso3')
    </div>
    
@endsection

@if(auth()->user()->paso==6)
@section('tablas')
<h2 class="text-center pasos-title-2">{{ __('Step')}} {{(auth()->user()->paso)}}</h2>
@endsection
@endif
