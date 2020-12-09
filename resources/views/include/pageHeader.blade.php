
@section('pageHeader')
  <div class="container">
    <nav class="navbar navbar-expand-sm ">

      <div class="logo">
        <a  href="{{ url('/') }}">
          <img src="/images/klikClass_logo.svg" alt = "logo" width = "512" height = "512"/>
        </a>
      </div>


      <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarMenuCategorias" aria-controls="navbarMenuCategorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>
      <nav class="menu">
        <a class="navbar-brand smallCaps nav-sup active" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>


        <div class="collapse navbar-collapse" id="navbarMenuCategorias">
            <!-- Left Side Of Navbar -->
           @if(auth()->user()!==null && auth()->user()->paso ==4)
            <a class="nav-sup" href="#">Personalizar</a>
            <a class="nav-sup" href="#">Exportar</a>
            @endif              
    
          <ul class="navbar-nav mr-auto menu-colapsable">
    
{{-- 
            <a class="nav-sup  nav-sub" href="{{route('estudiantes.index')}}">item3</a> --}}

          </ul>
        </div>

                    <!-- FIN: SubMenú Categorías -->
      </nav>
                   <!-- Menu user: Authentication Links -->
                    <!-- Right Side Of Navbar -->
      <ul class="navbar-nav menu-user">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
               
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </a>

                <div class="dropdown-menu-right dropdown-menu"aria-labelledby="navbarDropdown">
                  <a class="dropdown-item btn" href="#">Favoritos</a>
                  <a class="dropdown-item btn warning-reves" href="#">Mi perfil</a>
                  <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                   @csrf
                   @method("PUT")
                  <button type="submit" class="d_block warning">Sumar paso </button>
                  </form>

                  <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                   @csrf
                   @method("PUT")
                  <button type="submit" class="d_block secondary">Restar paso</button>
                  </form>
                  <a class="dropdown-item btn warning-reves" href="{{route('materias.index')}}">Materias</a>
                  <a class="dropdown-item btn warning-reves" href="{{route('clases.index')}}">Horario</a>    
                  <a class="dropdown-item btn" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST"  style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
        @endguest
      </ul>
    </nav>
  </div>

@show