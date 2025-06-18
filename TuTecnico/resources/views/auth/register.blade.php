<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro - TuTécnico</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fuente Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logo-placeholder {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .logo-placeholder img {
      max-width: 150px;
    }

    /* Opcional: Reducir márgenes en inputs */
    .form-group {
      margin-bottom: 1rem;
    }

    .input-label {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .hidden {
      display: none;
    }
  </style>
</head>

<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-5">
        <!-- Espacio para el logo -->
        <div class="logo-placeholder">
          <img src="{{ asset('IMG/logo/TuTecnicoG.png') }}" alt="Logo de TuTécnico">
        </div>
        <div class="card p-4">
          <h2 class="text-uppercase text-center mb-4">Registrarse</h2>

          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nombre -->
            <div class="form-group">
              <x-input-label for="name" :value="__('Nombre')" class="input-label" />
              <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger" />
            </div>

            <!-- Correo Electrónico -->
            <div class="form-group">
              <x-input-label for="email" :value="__('Correo Electrónico')" class="input-label" />
              <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
            </div>

            <!-- Teléfono -->
            <div class="form-group">
              <x-input-label for="telefono" :value="__('Teléfono')" class="input-label" />
              <x-text-input id="telefono" class="form-control" type="tel" name="telefono" :value="old('telefono')"
                required />
              <x-input-error :messages="$errors->get('telefono')" class="mt-1 text-danger" />
            </div>

            <!-- Tipo de Usuario -->
            <div class="form-group">
              <x-input-label for="tipo" :value="__('Tipo de Usuario')" class="input-label" />
              <select id="tipo" name="tipo" class="form-select" onchange="mostrarCampos()">
                <option value="cliente" @selected(old('tipo') == 'cliente')>Cliente</option>
                <option value="profesional" @selected(old('tipo') == 'profesional')>Profesional</option>
              </select>
              <x-input-error :messages="$errors->get('tipo')" class="mt-1 text-danger" />
            </div>

            <!-- Campos exclusivos para Profesionales -->
            <div id="campos-profesional" class="form-group hidden">
              <x-input-label for="especialidad" :value="__('Especialidad')" class="input-label" />
              <select id="especialidad" name="especialidad" class="form-select">
                @foreach (\App\Models\Profesional::especialidades as $especialidad)
          <option value="{{ $especialidad }}">{{ $especialidad }}</option>
        @endforeach
              </select>
              <x-input-error :messages="$errors->get('especialidad')" class="mt-1 text-danger" />
            </div>


            <x-input-label for="localidad" :value="__('localidad')" class="input-label" />
            <select id="localidad" name="localidad" class="form-select">
              @foreach (\App\Models\User::localidades as $localidad)
          <option value="{{ $localidad }}">{{ $localidad }}</option>
        @endforeach
            </select>
            <x-input-error :messages="$errors->get('localidad')" class="mt-1 text-danger" />

            <div class="form-group mt-3" id="campo-imagen">
              <x-input-label for="imagen" :value="__('Imagen de Perfil')" />
              <input id="imagen" class="form-control" type="file" name="imagen" accept="image/*" />
              <x-input-error :messages="$errors->get('imagen')" class="mt-1 text-danger" />
            </div>



            <!-- Contraseña -->
            <div class="form-group">
              <x-input-label for="password" :value="__('Contraseña')" class="input-label" />
              <x-text-input id="password" class="form-control" type="password" name="password" required
                autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
              <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="input-label" />
              <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger" />
            </div>

            <!-- Botón de Registro y enlace a Login -->
            <div class="d-flex justify-content-between align-items-center mt-4">
              <a class="text-decoration-underline text-muted small mx-1" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
              </a>

              <x-primary-button class="btn btn-primary">
                {{ __('Registrarse') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function mostrarCampos() {
      let tipo = document.getElementById("tipo").value;
      document.getElementById("campos-profesional").style.display = (tipo === "profesional") ? "block" : "none";
    }
    document.addEventListener("DOMContentLoaded", mostrarCampos);
  </script>
</body>

</html>