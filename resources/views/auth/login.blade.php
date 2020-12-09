@extends('layouts.app')

@section('content')
<div class="container">
    <div class="modal-content animate-zoom" style="max-width:320px">
      <div class= "center py-4">
        <a href="/"  class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
        <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
      </div>
      <div class="px-6 caja-header text-center"><h3><strong>{{ __('Login') }}</strong></h3></div>
      <form class="px-6 my-6" method="POST" action="{{ route('login') }}">
        @csrf
          <div class="py-6 mt-4">
            <label for="email" class="mb-2" ><b>{{ __('E-Mail Address') }}</b></label>
            <input  class="d_block mt-1" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="py-6 mt-6">
            <label for="password"><b>{{ __('Password') }}</b></label>
            <input  class="d_block" id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="py-6">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">{{ __('Remember Me') }}</label>
          </div>
          <div class="py-6 mb-4 mt-6">
            <button type="submit" class="boton d_block my-6 blue">{{ __('Login') }}</button>
          </div>
            @if (Route::has('password.request'))
              <a class="d_block" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
              </a>
            @endif
      </form>
    
      <div class="px-6 py-2 mt-6 light-grey">
        <a href="/"  title="Volver a la página anterior" class="d_inline boton my-4 danger">Cancelar</a>
      </div>

  </div>

</div>
@endsection
