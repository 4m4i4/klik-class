
{{-- @section('pageHeader') --}}
  <div class="container-header">
    <nav class="navbar">

      <div class="logo">
        <a class="d_block" href="{{ url('/home') }}" title="Ir a Home">
          <svg class="logoMenu"
            width="128px" height="128px" 
            viewBox="0 0 512 512">
            @include('include.logoCircle')
          </svg>
        </a>
      </div>
      
        {{-- boton hamburguesa- despliegs la barra en 640px y menos --}}
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarMenuCategorias" aria-controls="navbarMenuCategorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        {{-- @if(auth()->user()!==null && auth()->user()->paso == 6) --}}
          <span class="navbar-toggler-icon"></span>
      {{-- @endif           --}}
        </button>

       {{--  Menú principal  --}}
      <nav class="main-menu"> 
        <h2>
          <a class="navbar-brand smallCaps active"  href="{{ url('/') }}" title="Ir a Inicio">
          {{ config('app.name', 'Laravel') }}
          </a>
        </h2>

        <div class="collapse navbar-collapse" id="navbarMenuCategorias">
          {{-- si se acaba la configuración se muestra el menú-  paso 6 --}}
          @if(auth()->user()!==null && auth()->user()->paso == 6)
            <a class="nav-sub" href="/botones">Personalizar</a>
            <a class="nav-sub" href="/exportar">Exportar</a>
          @endif

        </div>
      </nav>
              {{-- FIN del Menú principal --}}
             {{-- Menú de usuario --}}
      <ul class="mt-4 ml-4 menu-user">
            {{-- Si no hay user registrado: login y registro --}}
        @guest
            <li class="nav-item">
                <a class="nav-link user-link" href="{{ route('login') }}">{{ __('Login') }}</a>
               
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link user-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            {{-- Si hay user registrado: menúde usuario -dropdown --}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link user-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                    @php
                        $user=Auth::user();
                    @endphp
                </a>
                  {{-- Itéms del  menú de usuario dropdown --}}
                <div class="dropdown-menu-right dropdown-menu" aria-labelledby="navbarDropdown">
                  {{-- El usuario verá el perfil y favoritos cuando esté en el paso 6. --}}
                  {{-- @if(auth()->user()!==null && auth()->user()->paso == 6) --}}
                    <a class="dropdown-item btn crear" href="#">Mi perfil</a>
                    <a class="dropdown-item btn oscuro-reves" href="#">Favoritos</a>
                  {{-- Solo para desarrollo --}}
                    <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                      @csrf
                      @method("PUT")
                      <button type="submit" class="d_block smallCaps continuar">Sumar paso </button>
                    </form>
                    <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                      @csrf
                      @method("PUT")
                      <button type="submit" class="d_block atras smallCaps">Restar Paso</button>
                    </form>
                    <a class="dropdown-item btn crear" href="{{route('materias.index')}}">Materias</a>
                    <a class="dropdown-item btn editar" href="{{route('sesions.index')}}">Sesiones</a>
                    <a class="dropdown-item btn warning" href="{{route('clases.index')}}">Clases</a>  
                    <a class="dropdown-item btn ver" href="{{route('aulas.index')}}">Aulas</a>    
                    <a class="dropdown-item btn crearCurso" href="{{route('mesas.index')}}">Mesas</a>
                    <a class="dropdown-item btn enviar" href="{{route('estudiantes.index')}}">Estudiantes</a>
                    <a class="dropdown-item btn borrar" href="{{route('estudiantes.index')}}">Ver Aula</a>
                    <a class="dropdown-item btn cancelar" href=/botones>botones</a>
                  {{-- @endif --}}
                  {{-- formulario para salir --}}
                  <a class="dropdown-item btn oscuro " href="{{ route('logout') }}"
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
            {{-- Fin de  Menu usuario --}}
    </nav>
  </div>

{{-- @show --}}