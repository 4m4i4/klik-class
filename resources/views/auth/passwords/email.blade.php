@extends('layouts.app')

@section('tablas')
<div class="nomodal">
  @include('include.formBanner')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">{{ __('Reset Password') }}
        </h3>
      </div>
        @if (session('status'))
          <div class="px-6 alert alert-info" role="alert">
            {{ session('status') }}
          </div>
        @endif
      <form  class="px-6"  method="POST" action="{{ route('password.email') }}">
        @csrf
           <div class="mt-4">
              <label for="email" >{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="d_block" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email') <small class="t_red">* {{ $message }}</small><br>
             @enderror
           </div>
           <div>
            <button type="submit" 
            title="{{ __('Send Password Reset Link') }}"
              class="bt_xxl mt-6 enviar"> {{ __('Send Password Reset Link') }}</button>
           </div>
      </form>
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="/" title="Volver a la página anterior" class="cancelar">Cancelar</a>
      </div>
    </div>
</div>
@endsection
