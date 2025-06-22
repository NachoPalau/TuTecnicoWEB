<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Servicios - TuTécnico</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Fuente Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: "Montserrat", sans-serif;
    }
  </style>
</head>

<body>
  @include("componentes/navbar-top")

  <div class="container-fluid mt-5 mt-lg-5 mb-5 pb-5">
    <div class="row justify-content-center">
      <div class="mt-5 col-11 col-md-10 col-lg-9">
        <h2 class="fw-bold mb-4">SERVICIOS - {{ strtoupper($especialidad) }}</h2>

        <div class="row mb-4">
          <div class="col-12 col-md-6 col-lg-4">
            <form id='formulario-filtrar' action="{{ route('cliente/servicio', ['especialidad' => $especialidad]) }}"
              method="POST">
              @csrf
              <select name="localidad" class="form-select" onchange="this.form.submit()">
                <option value="">Todas las localidades</option>
                @foreach(\App\Models\User::localidades as $loc)
          <option value="{{ $loc }}" {{ $localidadSeleccionada === $loc ? 'selected' : '' }}>
            {{ $loc }}
          </option>
        @endforeach

              </select>
            </form>
          </div>
        </div>

        <div class="row g-4">
          @forelse($profesionales as $profesional)
        <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm"">
      <a href=" {{ route('perfilProf', ['id' => $profesional->id]) }}" class="text-decoration-none">
          <img src="{{ asset('usuarios/' . $profesional->user->imagen) }}"
          alt="Imagen de {{ $profesional->user->name }}" class="card-img-top">
          <div class="card-body text-center">
          <h3 class="card-title service-title">{{ $profesional->user->name }}</h3>
          <p><strong>Localidad:</strong> {{ $profesional->user->localidad }}</p>
          <p><strong>Especialidad:</strong> {{ $profesional->especialidad }}</p>
          <p><strong>Teléfono:</strong> {{ $profesional->user->telefono }}</p>
          </div>
        </div>
        </a>
        </div>
      @empty
        <div class="col-12">
        <div class="alert alert-info text-center">
          No hay profesionales disponibles en esta localidad.
        </div>
        </div>
      @endforelse
        </div>
      </div>
    </div>
  </div>

  @include("componentes/navbar-bottom")

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>