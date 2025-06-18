<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - TuTécnico</title>
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
          <h2 class="text-uppercase text-center mb-4">Iniciar sesión</h2>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Correo Electrónico -->
            <div class="form-group">
              <x-input-label for="email" :value="__('Correo Electrónico')" class="input-label"/>
              <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
            </div>
            <!-- Contraseña -->
            <div class="form-group">
              <x-input-label for="password" :value="__('Contraseña')" class="input-label"/>
              <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-4">
              <a class="text-decoration-underline text-muted small mx-1" href="{{ route('register') }}">
                {{ __('¿No estas registrado?') }}
              </a>
              
              <x-primary-button class="btn btn-primary">
                {{ __('Iniciar Sesión') }}
              </x-primary-button>
            </div>

            </div>
          </form>
        </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>
