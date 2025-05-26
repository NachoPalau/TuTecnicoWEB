<nav class="navbar-top navbar bg-white shadow fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- Logo (visible solo en desktop) -->
    <a href="{{ route('servicios') }}">
    <img src="{{ asset("IMG/logo/TuTecnicoG.png")}}" alt="Logo de la empresa" class="d-none d-lg-block mr-lg-3" height="55">
    </a>
    <!-- navbar-móvil (visible solo en móviles y tablets) -->
    <div class=" d-flex d-lg-none position-absolute" style="">
      <img src="{{ asset("IMG/logo/TuTecnicoG_texto.png")}}" alt="Desplegar" height="20">
    </div>

    <!-- Tres divs (Servicios, Reservas, Mensajes) - Solo en desktop -->
    <div class="d-none d-lg-flex justify-content-center align-items-center flex-grow-1">
      <div class="mx-5">Servicios</div>
      <div class="mx-5">Reservas</div>
      <div class="mx-5">Mensajes</div>
    </div>

    <!-- Login (visible en todos los dispositivos) -->
    <a href="{{ route('login') }}" class="px-1"><img src="{{ "IMG/navbar-1/login.png" }}" alt=""></a>
    
  </div>
</nav>