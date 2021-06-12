@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">
          {{ __('Register') }}
        </h3>
      </div>

      <form  class="px-6" method="POST" action="{{ route('register') }}">
        @csrf
          <div class="mt-4">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="d_block"  name="name" value="{{ old('name') }}"  autofocus>
            @error('name')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="mt-4">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="d_block" name="email" value="{{ old('email') }}"  autofocus>
            @error('email')
             <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="grid grid-cols-2-auto mt-4">
            <div class="mr-1">
              <label class="d_block" for="password" >{{ __('Password') }}</label>
              <input id="password" type="password" class="d_block" name="password" value="{{ old('password') }}" autofocus>
            </div>
            <div class="">
              <label class="d_block"  for="password-confirm" ">{{ __('Confirm Password') }}</label>
              <input id="password-confirm" type="password" class="d_block" name="password_confirmation"  autocomplete="new-password"  autofocus>
            </div>
          </div>
            @error('password')
             <small class="t_red">* {{ $message }}</small><br>
            @enderror

          <details class="mt-4">
              <summary>Opcional</summary>
              <p class="mt-2">
                Marca si tienes mucha experiencia informática. Podrás cambiarlo después.
              </p>
              <div class="grid grid-cols-2-auto ml-2">
                <div class="d_block mr-1">
                  <input type="radio" id="avanzado" name="modo" value="avanzado">
                  <label class="d_inline my-2">Nivel avanzado</label>
                  <input class="ml-2" type="radio" id="novel" name="modo" checked value="novel">
                  <label class="d_inline my-2">Nivel simple</label>
                </div>
              </div>
            </details>
          <div>
            <button type="submit" title="{{ __('Register') }}" class="bt_xxl mt-6 enviar">{{ __('Register') }}
            </button>
          </div>
      </form>
    
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="/" title="Volver a la página anterior" class="cancelar">Cancelar</a>
      </div>
    </div>
  </div>
@endsection
