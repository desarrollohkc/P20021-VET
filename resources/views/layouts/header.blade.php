<header class="header">
    <div class="container navbar">
        <a href="{{ url('portico-aforador') }}" class="logo"><img src="{{ asset('images/logo.png') }}" alt="Poste Auditor" class="header__logo"></a>
        @unless(Auth::guest())
                    <a href="{{ url('home') }}" class="logo-funcionario">Portico Aforador</a>
                    <a href="{{ url('tablero-de-control') }}" class="logo-funcionario">Tablero de Control</a>
            <nav class="nav d-none d-lg-flex header__navigation">
                    <a href="{{ url('portico-aforador') }}" class="nav-link header__navigation-link @if(Request::is('portico-aforador/*') or Request::path() == 'portico-aforador') active @endif">Portico Aforador</a>
                    <a href="{{ url('tablero-de-control') }}" class="nav-link header__navigation-link @if(Request::is('tablero-de-control/*') or Request::path() == 'tablero-de-control') active @endif">Tablero de Control</a>
                    <a href="{{ url('reportes') }}" class="nav-link header__navigation-link @if(Request::is('reportes/*') or  Request::path() == 'reportes') active @endif">Reportes y Consultas</a>
                    @if(Auth::user()->rol->nombre != 'banobras')
                        <a href="{{ url('configuracion') }}" class="nav-link header__navigation-link @if(Request::is('configuracion/*') or  Request::path() == 'configuracion') active @endif">Configuración</a>
                    @endif
            </nav>
            <div class="datos-usuario">
                <a class="usuario dropdown-toggle" href="#" id="menu_usuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p class="nombre-usuario" id="nombre-usuario">{{ Auth::user()->name }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <path fill="#FFF" fill-rule="evenodd" d="M20 17.617V20H0v-2.383l6.667-4.284v-1.666c-.411 0-.792-.414-1.142-1.242C5.175 9.597 5 8.9 5 8.333V5c0-1.377.489-2.556 1.467-3.533C7.444.489 8.622 0 10 0c1.377 0 2.556.489 3.533 1.467C14.51 2.444 15 3.623 15 5v3.333c0 .567-.174 1.264-.525 2.092-.35.828-.73 1.242-1.142 1.242v1.666L20 17.617z"/>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu_usuario">
                    <a class="dropdown-item-custom" href="{{ url('logout') }}">Cerrar sesión</a>
                </div>
            </div>
        @endunless
    </div>
</header>
