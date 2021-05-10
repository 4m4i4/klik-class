@extends('layouts.app')

@section('tablas')
  @include('include.formWindow')
      <div class="px-6 caja-header text-center">
        <h3 class="form-title">{{ __('Confirm Password') }}
        </h3>
      </div>
      <div class="mt-4 px-6">
        {{ __('Please confirm your password before continuing.') }}
      </div>

      <form class="px-6" method="POST" action="{{ route('password.confirm') }}">
        @csrf
          <div class="mt-4">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="d_block" name="password" required autocomplete="current-password">
            @error('password')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div>
            <button type="submit" class="boton d_block mt-6 mb-2 blue">{{ __('Confirm Password') }}</button>
          </div>
          @if (Route::has('password.request'))
            <a class="d_block" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
          @endif
        </form>
      </div>
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="/" title="Volver a la página anterior" class="d_inline boton danger">Cancelar</a>
      </div>
    </div>
</div>
@endsection
