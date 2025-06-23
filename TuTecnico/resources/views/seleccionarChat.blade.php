<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Servicios - TuTécnico</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Fuente Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet" />
</head>

<body class="bg-light" style="font-family: 'Montserrat', sans-serif;">

@include("componentes/navbar-top")

<div class="container mt-5">
  <h1 class="mb-4 pt-4 pt-lg-5 fw-bold">Seleccionar Chat</h1>

  
  <h4 class="mb-3">Selecciona con quién chatear</h4>

  @php
    if (auth()->user()->tipo === 'profesional') {
        $lista = $clientes;
        $tipoRelacion = 'cliente_id';
    } else {
        $lista = $profesionales;
        $tipoRelacion = 'profesional_id';
    }
  @endphp

  @if(count($lista) > 0)
    <div class="list-group">
      @foreach($lista as $item)
        <a href="{{ route('chat.ver', [$tipoRelacion => $item->id]) }}" 
           class="list-group-item list-group-item-action d-flex align-items-center fw-semibold mt-2">
          {{ $item->user->name }}
        </a>
      @endforeach
    </div>
  @else
    <p class="text-muted fst-italic">No hay usuarios disponibles para chatear.</p>
  @endif
</div>
@include("componentes/navbar-bottom")
</body>
</html>
