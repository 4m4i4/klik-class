@extends('layouts.app')

@section('tablas')
  @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3>
          <strong>{{ __('Login') }}</strong>
        </h3>
      </div>
      <form class="px-6" method="POST" action="{{ route('login') }}">
        @csrf
          <div class="mt-4">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input  class="d_block" id="email" type="email" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
            @error('email')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="mt-4">
            <label for="password">{{ __('Password') }}</label>
            <input class="d_block" id="password" type="password" name="password"  value="{{ old('password') }}" autocomplete="current-password">
            @error('password')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">{{ __('Remember Me') }}</label>
          </div>
          <div>
            <button type="submit" class="boton d_block mt-6 mb-2 blue">{{ __('Login') }}</button>
          </div>
            @if (Route::has('password.request'))
              <a class="d_block tx-btn" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
              </a>
            @endif
      </form>
    
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="/"  title="Volver a la página anterior" class="d_inline btn danger">Cancelar</a>
      </div>

  </div>

</div>
@endsection