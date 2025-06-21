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
<h4 class="mt-5 pt-4">
  Chat con 
  @if(auth()->user()->tipo === 'cliente')
    {{ $profesional->user->name }}
  @else
    {{ $cliente->user->name }}
  @endif
</h4>

<div class="border p-3 mb-3" style="max-height: 300px; overflow-y:auto;">
    @foreach($mensajes as $mensaje)
        <div><strong>{{ $mensaje->emisor->name }}:</strong> {{ $mensaje->contenido }}</div>
    @endforeach
</div>

<form method="POST" action="{{ route('chat.enviar') }}">
    @csrf

    @if(auth()->user()->tipo === 'cliente')
        <input type="hidden" name="cliente_id" value="{{ auth()->user()->cliente->id }}">
        <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
    @else
        <input type="hidden" name="profesional_id" value="{{ auth()->user()->profesional->id }}">
        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
    @endif

    <textarea name="contenido" class="form-control mb-2" required></textarea>
    <button class="btn btn-primary">Enviar</button>
</form>

</body>
</html>