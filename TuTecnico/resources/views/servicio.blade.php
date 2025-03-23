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
    /* Estilos personalizados */
    body {
      font-family: "Montserrat", sans-serif;
    }

    .service-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
    }

    .service-title {
      font-size: 16px;
      font-weight: 600;
      margin-top: 8px;
    }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: white;
      border-top: 1px solid #ddd;
      padding: 10px 0;
    }

    .bottom-nav a img {
      width: 25px;
      height: 25px;
    }
  </style>
</head>

<body>
  <!-- NAVBAR SUPERIOR -->
  
@include("componentes/navbar-top")


  <!-- CONTENIDO PRINCIPAL -->
  <div class="page-content container-fluid mt-3 mt-lg-5 mb-4 px-3 px-lg-5 pb-5 pt-5">
  <div class="title fw-bold mb-3">
  <h2>SERVICIOS</h2>
  <form id='formulario-filtrar' action="{{route('servicio', ['especialidad' => $especialidad])}}" method="POST">
    @csrf
    <select name="localidad" onchange="document.getElementById('formulario-filtrar').submit();">
        <option value="">Selecciona una localidad</option>
        @foreach ($localidades as $localidad)
            <option value="{{$localidad}}" @selected(request('localidad')== $localidad)>{{ $localidad }}</option>
        @endforeach
    </select>
</form>

  </div>

  @section('content')
    <div class="container">
        <h1>Listado de Profesionales - Carpintería</h1>

        @if($profesionales->isEmpty())
            <p>No hay profesionales disponibles.</p>
        @else
            <ul>
                @foreach($profesionales as $profesional)
                    <li>
                        <h3>{{ $profesional->nombre }}</h3>
                        <p><strong>Localidad:</strong> {{ $profesional->localidad }}</p>
                        <p><strong>Especialidad:</strong> {{ $profesional->especialidad }}</p>
                        <p><strong>Contacto:</strong> {{ $profesional->contacto }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

<h2 class="text-center mb-4">Listado de Profesionales</h2>

<div class="services-grid row g-3">
    @forelse($profesionales as $profesional)
        <!-- Tarjeta de Profesional -->
        <div class="service-card col-12 col-md-6 col-lg-4">
            <div class="card p-3 h-100">
                <img src="{{ asset('IMG/servicios/carpinteria.png') }}" alt="Carpintería" class="service-img mb-3">
                <h5 class="service-title text-center">{{ $profesional->nombre }}</h5>
                <p class="text-center"><strong>Localidad:</strong> {{ $profesional->localidad }}</p>
                <p class="text-center"><strong>Especialidad:</strong> {{ $profesional->especialidad }}</p>
                <p class="text-center"><strong>Contacto:</strong> {{ $profesional->contacto }}</p>
            </div>
        </div>
    @empty
        <p class="text-center">No hay profesionales disponibles en esta localidad.</p>
    @endforelse
</div>


  <!-- MENÚ INFERIOR (SOLO MÓVIL) -->
  
  @include("componentes/navbar-bottom")

  <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades JS de Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>