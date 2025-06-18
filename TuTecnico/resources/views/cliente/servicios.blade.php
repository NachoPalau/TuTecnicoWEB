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

  <h2 class="title fw-bold mb-3">SERVICIOS</h2>

    <div class="services-grid row g-3">
      <!-- Servicio 1: Carpintería -->
      <div class="service-card col-12 col-md-6 col-lg-4">
        <a href="{{route('cliente/servicio', ['especialidad' => 'carpinteria'])}}">
        <img src="IMG/servicios/carpinteria.png" alt="Carpintería" class="service-img">
        </a>
        <p class="service-title">CARPINTERÍA</p>
      </div>

      <!-- Servicio 2: Electricidad -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'electricidad'])}}">  
      <img src="IMG/servicios/electricidad.png" alt="Electricidad" class="service-img">
       </a>
      <p class="service-title">ELECTRICIDAD</p>
      </div>

      <!-- Servicio 3: Pintura -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'pintura'])}}">
      <img src="IMG/servicios/pintura.png" alt="Pintura" class="service-img">
      </a>  
      <p class="service-title">PINTURA</p>
      </div>

      <!-- Servicio 4: Fontanería -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'fontaneria'])}}">
      <img src="IMG/servicios/fontaneria.png" alt="Fontanería" class="service-img">
      </a>  
      <p class="service-title">FONTANERÍA</p>
      </div>

      <!-- Servicio 5: Jardinería -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'jardineria'])}}">
      <img src="IMG/servicios/jardineria.png" alt="Jardinería" class="service-img">
      </a> 
      <p class="service-title">JARDINERÍA</p>
      </div>

      <!-- Servicio 6: Climatización -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'obra'])}}">
      <img src="IMG/servicios/obra.png" alt="Climatización" class="service-img">
      </a>
      <p class="service-title">OBRA</p>
      </div>

      <!-- Servicio 7: Electrodomésticos -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'mudanza'])}}">
      <img src="IMG/servicios/mudanzas.png" alt="Electrodomésticos" class="service-img">
      </a>
      <p class="service-title">MUDANZA</p>
      </div>

      <!-- Servicio 8: Cerrajería -->
      <div class="service-card col-12 col-md-6 col-lg-4">
      <a href="{{route('cliente/servicio', ['especialidad' => 'cerrajeria'])}}">
      <img src="IMG/servicios/cerrajeria.png" alt="Cerrajería" class="service-img">
      </a>
      <p class="service-title">CERRAJERÍA</p>
      </div>
    </div>
  </div>

  <!-- MENÚ INFERIOR (SOLO MÓVIL) -->
  
  @include("componentes/navbar-bottom")

  <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades JS de Bootstrap) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>