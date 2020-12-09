@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden ashadow sm:rounded-lg">
                <div class="p-6  m-1  border-gray-200 dark:border-gray-700 md:border-l">
                    <div class="text-lg leading-7 text-gray-600 dark:text-white">
                        {{-- <div class=""> --}}
                            <h2 class="text-center pasos-title-2">{{ __('Create course')}}. {{ __('Step')}} {{(auth()->user()->paso)}}</h2>
                            <p class="text-6 my-2 text-center">{{ __('Entering course data') }}</p>
                         
                        {{-- </div> --}}
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
                    
                    @includeWhen(auth()->user()->paso=='1', 'configurar.paso1')
                    @includeWhen(auth()->user()->paso=='2', 'configurar.paso2')
                    @includeWhen(auth()->user()->paso=='3', 'configurar.paso3')
                </div>
                
            </div>
        </div>
    </div>
@endsection
