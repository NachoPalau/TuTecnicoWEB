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

  <div class="container-fluid mt-3 mt-lg-5 mb-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-11 col-md-10 col-lg-9">
        <h2 class="fw-bold m-5">Perfil Profesional</h2>
        
        @livewire('chat-box', ['toUser' => $profesional])
      
        
            
  @include("componentes/navbar-bottom")
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>