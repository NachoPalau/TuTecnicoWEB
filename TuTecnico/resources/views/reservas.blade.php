<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perfil Profesional - TuTécnico</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <style>
    html,
    body {
      height: 100%;
      overflow-y: auto;
    }

    .table-bordered td,
    .table-bordered th {
      border: 2px solid #d3d3d3 !important;
      /* Borde oscuro (gris oscuro de Bootstrap) */
    }
  </style>

</head>

<body class="bg-light">
  @include("componentes/navbar-top")
  <h1 class="m-3">reservas</h1>
  <div class="card mt-3 mx-3">
    <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
      <h5 class="card-title fw-bold mb-3">
        <i class="bi bi-calendar-week me-2 text-primary"></i>Disponibilidad semanal
      </h5>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-outline-secondary btn-sm" onclick="cambiarSemana(-1)">⬅️</button>
        <h6 class="mb-0" id="rango-semana"></h6>
        <button class="btn btn-outline-secondary btn-sm" onclick="cambiarSemana(1)">➡️</button>
      </div>

      @php
    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    $horas = range(8, 16, 2);
    @endphp

      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle table-sm">
          <thead class="table-light">
            <tr>
              <th scope="col">Hora</th>
              @foreach ($dias as $dia)
          <th scope="col">{{ $dia }}</th>
        @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($horas as $hora)
          <tr>
            <th scope="row">{{ str_pad($hora, 2, '0', STR_PAD_LEFT) }}:00 -
            {{ str_pad($hora + 2, 2, '0', STR_PAD_LEFT) }}:00
            </th>
            @foreach ($dias as $i => $dia)
                  @php
                  $slot = $inicioSemana->copy()->addDays($i)->setTime($hora, 0);
                  $reserva = $reservasBD->get($slot->format('Y-m-d H:i'));
                  @endphp
        <td>
  @if(auth()->check() && auth()->user()->tipo === 'profesional')
      {{-- Vista del profesional --}}
      @if($reserva)
          @if($reserva->estado === 'pendiente')
              <form method="POST" action="{{ route('reserva.estado', $reserva->id) }}">
  @csrf
  <div class="dropdown">
    <button class="btn btn-sm btn-warning dropdown-toggle d-flex align-items-center" type="button" id="dropdownEstado" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="me-2">Pendiente</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
        <path d="M8 3.5a.5.5 0 0 1 .5.5v4.25l3.5 2.1a.5.5 0 1 1-.5.866l-3.75-2.25A.5.5 0 0 1 7.5 8V4a.5.5 0 0 1 .5-.5z"/>
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8z"/>
      </svg>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownEstado">
      <li>
        <button type="submit" name="estado" value="aceptada" class="dropdown-item d-flex align-items-center text-success">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle me-2" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0zm7.354-1.354a.5.5 0 0 0-.708 0L7 8.793 6.354 8.146a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
          </svg>
          Aceptar
        </button>
      </li>
      <li>
        <button type="submit" name="estado" value="rechazada" class="dropdown-item d-flex align-items-center text-danger">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle me-2" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0zm7.354-1.354a.5.5 0 0 0-.708 0L7 8.793 6.354 8.146a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"/>
          </svg>
          Rechazar
        </button>
      </li>
    </ul>
  </div>
</form>


          @else
              {{ ucfirst($reserva->estado) }}
          @endif
      @else
          Vacía
      @endif

  @elseif(auth()->check() && auth()->user()->tipo === 'cliente')
      {{-- Vista del cliente --}}
      @php
          $cliente = \App\Models\Cliente::where('user_id', auth()->id())->first();
      @endphp

      @if($reserva)
          @if($reserva->cliente_id === optional($cliente)->id && $reserva->estado === 'pendiente')
              {{ ucfirst($reserva->estado) }}
              <form method="POST" action="{{ route('reserva.cancelar', $reserva->id) }}">
                  @csrf
                  <button class="btn btn-outline-danger btn-sm mt-1">Cancelar</button>
              </form>
          @else
              No disponible
          @endif
      @else
          <form method="POST" action="{{ route('reserva.crear') }}">
    @csrf
    <input type="hidden" name="fecha" value="{{ $slot }}" />
    <input type="hidden" name="profesional_id" value="{{ $profesional->id }}" />
    <button class="btn btn-outline-primary btn-sm">Reservar</button>
</form>

      @endif
  @endif
</td>

        @endforeach
          </tr>
      @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>

  @include('componentes/navbar-bottom')

  <!-- Bootstrap JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
  // Fecha inicio semana desde servidor (formato yyyy-mm-dd)
  let inicioSemana = new Date("{{ $inicioSemana->format('Y-m-d') }}");

  function actualizarRango() {
    const opciones = { day: '2-digit', month: '2-digit', year: 'numeric' };
    const inicioStr = inicioSemana.toLocaleDateString('es-ES', opciones);
    const finSemana = new Date(inicioSemana);
    finSemana.setDate(inicioSemana.getDate() + 6);
    const finStr = finSemana.toLocaleDateString('es-ES', opciones);
    document.getElementById('rango-semana').textContent = `${inicioStr} - ${finStr}`;
  }

  function cambiarSemana(dias) {
    inicioSemana.setDate(inicioSemana.getDate() + dias * 7);
    const y = inicioSemana.getFullYear();
    const m = String(inicioSemana.getMonth() + 1).padStart(2, '0');
    const d = String(inicioSemana.getDate()).padStart(2, '0');
    // Recarga la página con nuevo parámetro para que el backend muestre esa semana
    window.location.href = `?inicioSemana=${y}-${m}-${d}`;
  }

  // Inicializar rango al cargar la página
  actualizarRango();
</script>

</html>