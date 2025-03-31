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
@include('componentes/navbar-top')
<form method="POST" class="m-5 p-5" >
    @csrf

    <label>Nombre</label>
    <input type="text" name="name" required>
    <br><br>
    <label>Email</label>
    <input type="email" name="email" required>
    <br><br>
    <label>Teléfono</label>
    <input type="text" name="telefono">
    <br><br>
    <label>Contraseña</label>
    <input type="password" name="password" required>
    <br><br>
    <label>Tipo de Usuario</label>
    <select name="tipo" id="tipo" onchange="mostrarCampos()">
        <option value="cliente">Cliente</option>
        <option value="profesional">Profesional</option>
    </select>
    <br><br>
    <!-- Campos para clientes -->
    <div id="campos-cliente">
        
    </div>

    <!-- Campos para profesionales -->
    <div id="campos-profesional" style="display:none;">
        <sele>Especialidad</sele>
        <select type="text" name="especialidad">
    </div>

    <button type="submit">Registrarse</button>
</form>
@include('componentes/navbar-top')
</body>
</html>

<script>
function mostrarCampos() {
    let tipo = document.getElementById("tipo").value;
    document.getElementById("campos-cliente").style.display = (tipo === "cliente") ? "block" : "none";
    document.getElementById("campos-profesional").style.display = (tipo === "profesional") ? "block" : "none";
}
</script>
