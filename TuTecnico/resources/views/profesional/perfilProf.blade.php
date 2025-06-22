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
        
        <div class=" m-3 m-lg-5">
        @auth
        @if (auth()->user()->tipo === 'profesional')
        <a href="{{ route('cambPerfProf', $profesional->id) }}" 
        class="btn btn-light border rounded-circle position-absolute top-40 right-40 end-0 m-5"
        style="width: 40px; height: 40px;">
        <i class=" bi bi-pencil-fill"></i>
        </a>
      @endif
    @endauth
    </div>

        <!-- Foto del perfil centrada -->
        <div class="text-center mb-4 pt-4 mt-5">
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
            <p>{{ $profesional->descripcion }}
          </div>
        </div>



        <div class="card shadow-sm ">
          <div class="card-body">

            <h5 class="fw-bold mb-3"><i class="bi bi-telephone text-primary me-2"></i>Contacto</h5>
            <p><i class="bi bi-envelope me-2"></i>{{ $profesional->user->telefono }}</p>
            @auth
            @if (auth()->user()->tipo === 'cliente')
          <a href="{{ route('reservas', ['id' => $profesional->id]) }}" class="btn btn-primary w-100 mt-2">
            RESERVAR
          </a>
          @endif
      @endauth

            @auth
            @if (auth()->user()->tipo === 'profesional')
          <a href="{{ route('misReservas', ['id' => $profesional->id]) }}" class="btn btn-primary w-100 mt-2">
            Mis reservas
          </a>
          @endif
      @endauth

            @auth
            @if (auth()->user()->tipo === 'cliente')
          <a href="{{ route('chat.ver', ['profesional_id' => $profesional->id]) }}"
            class="btn btn-primary w-100 mt-2">
            Enviar mensaje
          </a>
          @endif
      @endauth


            <!-- Reseñas -->
            <hr>
            <h5 class="fw-bold mb-3"><i class="bi bi-star text-primary me-2"></i>Reseñas recientes</h5>

            @foreach($profesional->resenas as $resena)
          <div class="mb-3">
            <div class="d-flex justify-content-between">
            <span class="fw-bold">{{ $resena->cliente?->user?->name ?? 'Cliente desconocido' }}</span>
            <span class="text-warning">
              @for ($i = 0; $i < $resena->valoracion ; $i++)
          <i class="bi bi-star-fill"></i>
          @endfor
              @for ($i = $resena->valoracion ; $i < 5; $i++)
          <i class="bi bi-star"></i>
          @endfor
            </span>
            </div>
            <p class="mb-0">{{ $resena->comentario }}</p>
            <small class="text-muted">{{ $resena->created_at->diffForHumans() }}</small>
          </div>
          <hr>
      @endforeach

            <!-- Formulario para agregar reseña -->
            @auth
            @if(auth()->user()->tipo === 'cliente')
<form action="{{ route('resenas.store', $profesional) }}" method="POST">
            @csrf
            <h6>Deja tu reseña</h6>
            <div class="mb-3">
            <label for="comentario" class="form-label">Comentario</label>
            <textarea name="comentario" id="comentario" class="form-control" rows="3"
              required>{{ old('comentario') }}</textarea>
            @error('comentario')<small class="text-danger">{{ $menssage }}</small>@enderror
            </div>
            <div class="mb-3">
            <label class="form-label">Calificación</label>
<select name="valoracion" class="form-select" required> 
              <option value="">Selecciona</option>
              @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}" {{ old('valoracion ') == $i ? 'selected' : '' }}>{{ $i }}
            estrella{{ $i > 1 ? 's' : '' }}</option>
            @endfor
            </select>
            @error('valoracion')<small class="text-danger">{{ $mensage }}</small>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Enviar reseña</button>
            </form>
          @endif
      @endauth

          </div>
        </div>

      </div>
    </div>
  </div>





  @include("componentes/navbar-bottom")
</body>

</html>