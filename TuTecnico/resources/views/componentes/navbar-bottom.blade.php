<div class="navbar navbar-expand d-flex d-lg-none fixed-bottom bg-white border-top justify-content-around py-2">

  @auth
    @if(auth()->user()->tipo === 'profesional')
      <a href="{{ route('perfilProf', ['id'=> auth()->user()->id]) }}" class="text-decoration-none text-dark text-center px-2">
          <div>
              <img src="{{ asset('IMG/navbar-2/profile.png') }}" alt="Perfil" class="img-fluid" style="width: 24px; height: 24px;">
              <div class="small mt-1">Perfil</div>
          </div>
      </a>
      <a href="{{ route('reservas',['id'=> auth()->user()->id]) }}" class="text-decoration-none text-dark text-center px-2">
          <div>
              <img src="{{ asset('IMG/navbar-2/calendario.png') }}" alt="Reservas" class="img-fluid" style="width: 24px; height: 24px;">
              <div class="small mt-1">Reservas</div>
          </div>
      </a>
      <a href="{{ route('mensajes') }}" class="text-decoration-none text-dark text-center px-2">
          <div>
              <img src="{{ asset('IMG/navbar-2/chat.png') }}" alt="Mensajes" class="img-fluid" style="width: 24px; height: 24px;">
              <div class="small mt-1">Mensajes</div>
          </div>
      </a>

    @elseif(auth()->user()->tipo === 'cliente') 
      <a href="{{ route('servicios') }}" class="text-decoration-none text-dark text-center px-2">
          <div>
              <img src="{{ asset('IMG/navbar-2/servicios.png') }}" alt="Servicios" class="img-fluid" style="width: 24px; height: 24px;">
              <div class="small mt-1">Servicios</div>
          </div>
      </a>
      <a href="{{ route('misReservas', ['id'=> auth()->user()->id]) }}" class="text-decoration-none text-dark text-center px-2">
          <div>
              <img src="{{ asset('IMG/navbar-2/calendario.png') }}" alt="Reservas" class="img-fluid" style="width: 24px; height: 24px;">
              <div class="small mt-1">Reservas</div>
          </div>
      </a>
      <a href="{{ route('mensajes') }}" class="text-decoration-none text-dark text-center px-2">
          <div>
              <img src="{{ asset('IMG/navbar-2/chat.png') }}" alt="Mensajes" class="img-fluid" style="width: 24px; height: 24px;">
              <div class="small mt-1">Mensajes</div>
          </div>
      </a>
    @endif
  @endauth

  @guest
    <a href="{{ route('servicios') }}" class="text-decoration-none text-dark text-center px-2">
        <div>
            <img src="{{ asset('IMG/navbar-2/servicios.png') }}" alt="Servicios" class="img-fluid" style="width: 24px; height: 24px;">
            <div class="small mt-1">Servicios</div>
        </div>
    </a>
    <a href="{{ route('login') }}" class="text-decoration-none text-dark text-center px-2">
        <div>
            <img src="{{ asset('IMG/navbar-2/calendario.png') }}" alt="Login" class="img-fluid" style="width: 24px; height: 24px;">
            <div class="small mt-1">Reservas</div>
        </div>
    </a>
    <a href="{{ route('login') }}" class="text-decoration-none text-dark text-center px-2">
        <div>
            <img src="{{ asset('IMG/navbar-2/chat.png') }}" alt="Registro" class="img-fluid" style="width: 24px; height: 24px;">
            <div class="small mt-1">Mensajes</div>
        </div>
    </a>
  @endguest
</div>
