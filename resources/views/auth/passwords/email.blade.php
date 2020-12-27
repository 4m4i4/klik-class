@extends('layouts.app')

@section('tablas')
  @include('include.formWindow')
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
            <button type="submit" class="boton d_block mt-6 mb-2 blue">{{ __('Send Password Reset Link') }}</button>
           </div>
      </form>
      <div class="px-6 py-4 mt-6 light-grey">
        <a href="/" title="Volver a la página anterior" class="d_inline boton danger">Cancelar</a>
      </div>
    </div>
</div>
@endsection
