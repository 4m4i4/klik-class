
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

       {{--  Menú principal  --}}
      <nav class="main-menu"> 
        <h2>
          <a class="navbar-brand smallCaps active" 
           href="{{ url('/') }}"
            title="Ir a Inicio">
          {{ config('app.name', 'Laravel') }}
          </a>
        </h2>

        <div class="menuUso">

          {{-- si se acaba la configuración se muestra el menú-  paso 6 --}}
          @if(auth()->user()!==null && auth()->user()->paso == 6)
          
            <a id="rutaBotones" class="{{ Request::path() === 'botones' ? 'active' : '' }} nav-sub" href="/botones" >Personalizar</a>
            <a id="rutaExportar" class="{{ Request::path() === 'exportar' ? 'active' : '' }} nav-sub" href="/exportar">Exportar</a>
          @endif

        </div>
      </nav>
              {{-- FIN del Menú principal --}}
             {{-- Menú de usuario --}}
      <ul class="mt-4 ml-4 menu-user">
            {{-- Si no hay user registrado: login y registro --}}
        @guest
            <li class="nav-item">
                <a class="user-link" href="{{ route('login') }}">{{ __('Login') }}</a>
               
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="user-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            {{-- Si hay user registrado: menú de usuario -dropdown --}}
            <li id="userMenuTrigger" class="nav-item dropdown" onclick="verUserMenu()">
                <a class="user-link" href="#" title="menú de usuario">
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                    @php
                        $user=Auth::user();
                    @endphp
                </a>
                  {{-- Itéms del  menú de usuario dropdown --}}
                <div id= "userDropdown" class="dropdown-menu">
                  {{-- El usuario verá el perfil y favoritos cuando esté en el paso 6. --}}
                  {{-- @if(auth()->user()!==null && auth()->user()->paso == 6) --}}
                    <a class="dropdown-item crear" href="#">Mi perfil</a>
                    <a class="dropdown-item oscuro-reves" href="#">Favoritos</a>
                  {{-- Solo para desarrollo --}}
                    <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                      @csrf
                      @method("PUT")
                      <button type="submit" class="dropdown-item  continuar">Sumar paso </button>
                    </form>
                    <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                      @csrf
                      @method("PUT")
                      <button type="submit" class="dropdown-item atras">Restar Paso</button>
                    </form>
                    <a class="dropdown-item crear" href="{{route('materias.index')}}">Materias</a>
                    <a class="dropdown-item editar" href="{{route('sesions.index')}}">Sesiones</a>
                    <a class="dropdown-item warning" href="{{route('clases.index')}}">Clases</a>  
                    <a class="dropdown-item ver" href="{{route('aulas.index')}}">Aulas</a>    
                    <a class="dropdown-item crearCurso" href="{{route('mesas.index')}}">Mesas</a>
                    <a class="dropdown-item enviar" href="{{route('estudiantes.index')}}">Estudiantes</a>
                    <a class="dropdown-item borrar" href="{{route('estudiantes.index')}}">Ver Aula</a>
                    <a class="dropdown-item cancelar" href=/botones>botones</a>
                  {{-- @endif --}}
                  {{-- formulario para salir --}}
                  <a class="dropdown-item oscuro " href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
        @endguest
      </ul>    
            {{-- Fin de  Menu usuario --}}
    </nav>
  </div>

<script>
  // var menuUser-name = document.getElementById('menuUser-name');

  // menuUser-name.onclick = function(){
  //   // userDropdown.classList.toggle('show');
  //   userDropdown.style.display = "block";
  // }
  function verUserMenu(){
    let userDropdown = document.getElementById('userDropdown');  
    userDropdown.classList.toggle('show');
  }
  window.onclick = function(event){
    if(event.target == document.getElementById('userMenuTrigger')){
          let userDropdown = document.getElementById('userDropdown');  
    userDropdown.classList.toggle('show');
    }
  }
  </script>