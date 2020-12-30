
@section('pageHeader')
  <div class="container-header">
    <nav class="navbar navbar-expand-sm ">

      <div class="logo">
        <a  href="{{ url('/') }}">
           <svg class="logoMenu"
            width="128px" height="128px" 
            viewBox="0 0 512 512">
            <g id="circleLogo">
              <path id="mesa3" fill="#00DFE7" d="M507 208l-77 0 0 -140c39,36 67,85 77,140z"/>
              <path id="fondo" fill="#363636" d="M256 0c67,0 128,26 174,68l0 140 77 0c3,15 5,31 5,48 0,24 -3,48 -10,70l-72 0 0 89 -72 -113 78 -29 -123 -73 0 -155 -203 0c42,-28 92,-45 146,-45zm174 444c-46,42 -107,68 -174,68 -38,0 -75,-8 -107,-24l164 0 0 -153 70 111c3,5 11,7 16,3l28 -18c1,-1 2,-2 3,-3l0 16zm-388 -48c-27,-40 -42,-88 -42,-140 0,-52 15,-100 42,-140l0 92 188 0 11 118 -199 0 0 70z"/>
              <path id="mesa2" fill="#00ABD6" d="M42 326l199 0 6 69 64 -62 2 2 0 154 -164 0c-44,-21 -81,-53 -107,-93l0 -70z"/>
              <path id="mesa1" fill="#FFEE00" d="M110 45l203 0 0 155 -89 -52 6 60 -188 0 0 -92c18,-28 41,-52 68,-71z"/>
              <path id="mesa4" fill="#00ABD6" d="M430 326l72 0c-13,46 -38,86 -72,118l0 -16c2,-4 3,-9 0,-13l0 0 0 -89z"/>
              <path id="flecha" fill="#FF0066" d="M224 148l212 125 -78 29 72 113c3,6 2,13 -3,16l-28 18c-5,4 -13,2 -16,-3l-72 -113 -64 62 -23 -247z"/>
            </g>
          </svg>

        </a>
      </div>
            <!-- Menú principal -->
      <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarMenuCategorias" aria-controls="navbarMenuCategorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>
      <nav class="menu"> 
        <a class="navbar-brand smallCaps nav-sup active" href="{{ url('/home') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
          <!-- Solo se ve al acabar la configuración -->
        <div class="collapse navbar-collapse" id="navbarMenuCategorias">
           
           @if(auth()->user()!==null && auth()->user()->paso ==6)
            <a class="nav-sub" href="#">Personalizar</a>
            <a class="nav-sub" href="#">Exportar</a>
            @endif              
    
          <ul class="navbar-nav mr-auto menu-colapsable">
          </ul>
        </div>
      </nav>
              <!-- FIN: Menú principal -->
                   <!-- Menu usuario:  -->
      <ul class="navbar-nav menu-user">
        <!-- Si no hay user: login y registro -->
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
                <!-- Si hay user: menú dropdown -->
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                    @php
                        $user=Auth::user();
                    @endphp
                </a>
                  <!-- Itéms del  menú dropdown -->
                <div class="dropdown-menu-right dropdown-menu"aria-labelledby="navbarDropdown">
                  <a class="dropdown-item btn" href="#">Favoritos</a>
                  <a class="dropdown-item btn warning-reves" href="#">Mi perfil</a>
                  <form method="POST" action="{{route('home.updatePasoMas',$user->id)}}">
                     @csrf
                     @method("PUT")
                    <button type="submit" class="d_block default-reves">Sumar paso </button>
                  </form>
                  <form method="POST" action="{{route('home.updatePasoMenos',$user->id)}}">
                    @csrf
                    @method("PUT")
                    <button type="submit" class="d_block default-reves">Restar paso</button>
                  </form>
                  <a class="dropdown-item btn warning-reves" href="{{route('materias.index')}}">Materias</a>
                  <a class="dropdown-item btn warning-reves" href="{{route('sesions.index')}}">Sesiones</a>
                  <a class="dropdown-item btn warning-reves" href="{{route('clases.index')}}">Clases</a>  
                  <a class="dropdown-item btn warning-reves" href="{{route('aulas.index')}}">Aulas</a>    
                  <a class="dropdown-item btn warning-reves" href="{{route('mesas.index')}}">Mesas</a>
                  <a class="dropdown-item btn warning-reves" href="{{route('estudiantes.index')}}">Estudiantes</a>
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
            <!--  Fin de  Menu usuario:  -->
    </nav>
  </div>

@show