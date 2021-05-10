@extends('layouts.app')

@section('tablas')
  @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">{{ __('Reset Password') }}
        </h3>
      </div>
      <form class="px-6" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mt-4">
          <label for="email">{{ __('E-Mail Address') }}</label>
          <input id="email" type="email" class="d_block" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
          @error('email')
              <small class="t_red">* {{ $message }}</small><br>
          @enderror
        </div>

        <div class="grid grid-cols-2-auto mt-4">
          <div class="mr-1">
            <label class="d_block" for="password" >{{ __('Password') }}</label>
            <input id="password" type="password" class="d_block" name="password" required autocomplete="new-password">
          </div>
          <div class="ml-1">
            <label class="d_block"  for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="d_block" name="password_confirmation" required autocomplete="new-password">
          </div>
        </div>
        @error('password')
          <small class="t_red">* {{ $message }}</small><br>
        @enderror
        <div>
          <button type="submit" class="boton d_block mt-6 blue">{{ __('Reset Password') }}</button>
        </div>
      </form>
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="/" title="Volver a la página anterior" class="d_inline boton danger">Cancelar</a>
      </div>
    </div>
  </div>
@endsection
