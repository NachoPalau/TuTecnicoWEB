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


<div class="container mt-5 ">
    <h2 class="mt-5 pt-3 pt-lg-5">Mis reservas</h2>

    @if($reservas->isEmpty())
        <p>No tienes reservas aún.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Profesional</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->fecha->format('d/m/Y H:i') }}</td>
                        <td>{{ $reserva->profesional->user->name ?? 'Desconocido' }}</td>
                        <td>{{ ucfirst($reserva->estado) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>



</body>
</html>