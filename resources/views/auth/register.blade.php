@extends('layouts.app')

@section('content')
<div class="container">

    <div class="modal-content animate-zoom" style="max-width:320px">
      <div class= "center py-4">
        <a href="/"  class="boton xlarge danger d_topright" title="Cerrar">&times; </a>
        <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512" style="width:30%" class="circle mt-4">
      </div>
      <div class="px-6 caja-header text-center"><h3><strong>{{ __('Register') }}</strong></h3></div>

      <form  class="px-6 my-6" method="POST" action="{{ route('register') }}">
        @csrf

          <div class="py-6 mt-4">
            <label for="name"><b>{{ __('Name') }}</b></label>
            <input id="name" type="text" class="d_block"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
              <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="py-6 mt-6">
            <label for="email"><b>{{ __('E-Mail Address') }}</b></label>
            <input id="email" type="email" class="d_block" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
             <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="py-6 mt-6">
            <label for="password" ><b>{{ __('Password') }}</b></label>
            <input id="password" type="password" class="d_block" name="password" required autocomplete="new-password">
            @error('password')
             <small class="t_red">* {{ $message }}</small><br>
            @enderror
          </div>
          <div class="py-6 my-6">
            <label for="password-confirm" "><b>{{ __('Confirm Password') }}</b></label>
            <input id="password-confirm" type="password" class="d_block" name="password_confirmation" required autocomplete="new-password">
          </div>
          <div class="py-6 mb-4 mt-6">
            <button type="submit" class="boton d_block blue">{{ __('Register') }}
            </button>
          </div>
      </form>
    
    <div class="px-6 py-2 mt-8 light-grey">
        <a href="/"  title="Volver a la página anterior" class="d_inline boton my-4 danger">Cancelar</a>
    </div>
  </div>
</div>
@endsection
