@extends('layouts.app')

@section('tablas')
  @include('include.formWindow')
    <div class="px-6 caja-header text-center">
        <h3 class="form-title">{{ __('Verify Your Email Address') }}</h3>
    </div>

    <div class="mt-4 px-6">
        @if (session('resent'))
            <div class="alert alert-info" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
    </div>
    <form class="px-6" method="POST" action="{{ route('verification.resend') }}">
        @csrf
          <div>
            <button type="submit" title="{{ __('click here to request another') }}" 
             class="bt_xxl mt-6 enviar">{{ __('click here to request another') }}</button>.
          </div>
    </form>
    <div class="px-6 py-4 mt-6 light-grey">
        <a href="/" title="Volver a la página anterior" class="cancelar">Cancelar</a>
    </div>
  </div>
</div>
@endsection