<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chat - TuTécnico</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Montserrat', sans-serif;">
  @include("componentes/navbar-top")

    <div class="card-body m-3 mt-5 pt-3 pt-lg-5" style=" max-height: 90vh; overflow-y: auto;">
    <h1 class="mb-4 fw-semibold">
      Chat con 
      {{ auth()->user()->tipo === 'profesional' 
          ? $cliente->user->name 
          : $profesional->user->name }}
    </h1>

    <div class="border rounded p-2 mb-3 overflow-auto" style="max-height: 400px;" id="chat-container">
      @forelse($mensajes as $mensaje)
        @php
          $esMio = $mensaje->de_user_id === auth()->user()->id;
          $nombre = $mensaje->emisor->name ?? 'Tú';
          $inicial = strtoupper(mb_substr($nombre, 0, 1));
        @endphp

      <div class="d-flex mb-2 {{ $esMio ? 'justify-content-end' : 'justify-content-start' }}" style="max-width:;">
          @if(!$esMio)
            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3" style="width: 28px; height: 28px; font-size: 0.75rem; flex-shrink: 0;">
              {{ $inicial }}
            </div>
          @endif

          <div>
            <div class="text-muted small {{ $esMio ? 'text-end' : 'text-start' }}">
              {{ $nombre }} - {{ $mensaje->created_at->setTimezone('Europe/Madrid')->format('H:i') }}
            </div>
            <div class="px-3 py-2 rounded {{ $esMio ? 'bg-primary text-white text-end' : 'bg-light text-dark text-start' }} small text-break" style="max-width: 600px;">
              {{ $mensaje->contenido }}
            </div>
          </div>

          @if($esMio)
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center ms-3" style="width: 28px; height: 28px; font-size: 0.75rem; flex-shrink: 0;">
              {{ $inicial }}
            </div>
          @endif
        </div>

      @empty
        <p class="text-muted fst-italic">No hay mensajes aún.</p>
      @endforelse
    </div>

    <form method="POST" action="{{ route('chat.enviar') }}">
      @csrf
      <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
      <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
      <div class="input-group">
        <textarea name="contenido" class="form-control form-control-sm" rows="2" placeholder="Escribe un mensaje..." required></textarea>
        <button class="btn btn-primary btn-sm">Enviar</button>
      </div>
    </form>
  </div>
@include("componentes/navbar-bottom")
  <script>
    // Auto-scroll al último mensaje
    const chatContainer = document.getElementById('chat-container');
    chatContainer.scrollTop = chatContainer.scrollHeight;
  </script>
</body>
</html>
