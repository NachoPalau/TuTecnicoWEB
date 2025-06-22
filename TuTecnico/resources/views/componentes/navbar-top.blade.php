<div class="navbar-top navbar bg-white shadow fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- Logo (visible solo en desktop) -->
    <a href="{{ route('servicios') }}">
      <img src="{{ asset("IMG/logo/TuTecnicoG.png")}}" alt="Logo de la empresa" class="d-none d-lg-block me-lg-3" height="55">
    </a>
    <!-- navbar-móvil (visible solo en móviles y tablets) -->
    <div class="d-flex d-lg-none position-absolute">
      <a href="{{ route('servicios') }}">
        <img src="{{ asset("IMG/logo/TuTecnicoG_texto.png")}}" alt="Desplegar" height="20">
      </a>
    </div>

    <!-- Tres divs (Servicios, Reservas, Mensajes) - Solo en desktop -->
    <div class="d-none d-lg-flex justify-content-center align-items-center flex-grow-1">
      <div class="mx-5">
        <a href="{{ route('servicios') }}" class="text-decoration-none text-dark">Servicios</a>
      </div>
      <div class="mx-5">
        @auth
          @if(auth()->user()->tipo === 'profesional')
            <a href="{{ route('reservas', ['id' => auth()->user()->id]) }}" class="text-decoration-none text-dark">Reservas</a>
          @elseif(auth()->user()->tipo === 'cliente')
            <a href="{{ route('misReservas', ['id' => auth()->user()->id]) }}" class="text-decoration-none text-dark">Reservas</a>
          @else
            Reservas
          @endif
        @else
          Reservas
        @endauth
      </div>
      <div class="mx-5">
        <a href="{{ route('seleccionarChat') }}" class="text-decoration-none text-dark">Mensajes</a>
      </div>
    </div>

    <!-- Login (visible en todos los dispositivos) -->
    @guest
      <!-- Usuario NO autenticado -->
      <a href="{{ route('login') }}" class="px-1">
        <img src="{{ asset('IMG/navbar-1/login.png') }}" alt="Login">
      </a>
    @endguest

    @auth
      <!-- Usuario autenticado -->
      <form method="POST" action="{{ route('logout') }}" class="">
        @csrf
        <button type="submit" class="text-black btn btn-link px-1 text-decoration-none">
          Cerrar sesión
        </button>
      </form>
    @endauth
  </div>
</div>
