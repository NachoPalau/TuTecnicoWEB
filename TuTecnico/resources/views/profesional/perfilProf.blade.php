<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil Profesional - TuTécnico</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
  @include("componentes/navbar-top")

  <div class="container-fluid mt-4 mb-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-11 col-md-10 col-lg-8">
        
<!-- Botón circular para editar -->
<a href="{{ route('cambPerfProf', $profesional->id) }}" class="btn btn-light border rounded-circle position-absolute top-40 right-40 end-0 m-5" style="width: 40px; height: 40px;">
  <i class="bi bi-pencil-fill"></i>
</a>
        <h2 class="fw-bold mb-4">Perfil Profesional</h2>

        <!-- Foto del perfil centrada -->
        <div class="text-center mb-4 mt-5">
          <img src="{{ asset('IMG/perfiles/FotoCurriculum.jpg') }}" class="rounded-circle border"
            style="width: 240px; height: 240px;" alt="Foto de perfil">
        </div>

        <!-- Nombre, localidad y especialidad -->
        <div class="text-center mb-4">
          <h1 class="mb-1">{{ $profesional->user->name }}</h1>
          <p class="mb-1 text-muted">{{ $profesional->user->localidad }}</p>
          <p class="mb-0 fw-semibold">{{ $profesional->especialidad }}</p>
        </div>
        <div class="card shadow-sm mb-2">
          <div class="card-body">
            <h5 class="fw-bold mb-3"><i class="bi bi-person-badge text-primary me-2"></i>Sobre mí</h5>
            <p>{{ $profesional->descripcion }} </div>
        </div>



        <div class="card shadow-sm ">
          <div class="card-body">

            <h5 class="fw-bold mb-3"><i class="bi bi-telephone text-primary me-2"></i>Contacto</h5>
            <p><i class="bi bi-envelope me-2"></i>{{ $profesional->user->telefono }}</p>
           @auth
            @if (auth()->user()->tipo === 'cliente')
              <a href="{{ route('reservas', ['id' => $profesional->user->id]) }}" class="btn btn-primary w-100 mt-2">
                RESERVAR
              </a>
            @endif
           @endauth
           
            
            @auth
            @if (auth()->user()->tipo === 'cliente')
              <a href="{{ route('reservas', ['id' => $profesional->user->id]) }}" class="btn btn-primary w-100 mt-2">
                Enviar mensaje
              </a>
            @endif
           @endauth


            <!-- Reseñas -->
            <hr>
            <h5 class="fw-bold mb-3"><i class="bi bi-star text-primary me-2"></i>Reseñas recientes</h5>

            <div class="mb-3">
              <div class="d-flex justify-content-between">
                <span class="fw-bold">Ana López</span>
                <span class="text-warning">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </span>
              </div>
              <p class="mb-0">Excelente servicio, muy profesional y puntual.</p>
              <small class="text-muted">Hace 2 semanas</small>
            </div>

            <hr>

            <div class="mb-3">
              <div class="d-flex justify-content-between">
                <span class="fw-bold">Juan Pérez</span>
                <span class="text-warning">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                </span>
              </div>
              <p class="mb-0">Buen trabajo, pero un poco caro.</p>
              <small class="text-muted">Hace 1 mes</small>
            </div>

            <a href="#" class="btn btn-outline-primary w-100 mt-2">Ver todas las reseñas</a>
          </div>
        </div>

      </div>
    </div>
  </div>





  @include("componentes/navbar-bottom")
</body>

</html>