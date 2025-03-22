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
  <form action="{{route('filtrar_servicio')}}">
    @csrf
  <select name="localidad" >
    <option value="Ciudad"></option>
    @foreach ($localidades as $localidad)
      <option value="{{$localidad}}"></option>
    @endforeach
  </select>  
  </form>
  </div>

    <div class="services-grid row g-3">
      <!-- Servicio 1: Carpintería -->
      <div class="service-card col-12 col-md-6 col-lg-4">
        <img src="IMG/servicios/carpinteria.png" alt="Carpintería" class="service-img">
        <p class="service-title">María López</p>
      </div>

      <!-- Servicio 2: Electricidad -->
      <div class="service-card col-12 col-md-6 col-lg-4">
        <img src="IMG/servicios/electricidad.png" alt="Electricidad" class="service-img">
        <p class="service-title">Juan Cabreras</p>
      </div>

      <!-- Servicio 3: Pintura -->
      <div class="service-card col-12 col-md-6 col-lg-4">
        <img src="IMG/servicios/pintura.png" alt="Pintura" class="service-img">
        <p class="service-title">Kim Álvarez</p>
      </div>

      <!-- Servicio 4: Fontanería -->
      <div class="service-card col-12 col-md-6 col-lg-4">
        <img src="IMG/servicios/fontaneria.png" alt="Fontanería" class="service-img">
        <p class="service-title">Carlos Ramírez</p>
      </div>


  <!-- MENÚ INFERIOR (SOLO MÓVIL) -->
  
  @include("componentes/navbar-bottom")

  <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades JS de Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>