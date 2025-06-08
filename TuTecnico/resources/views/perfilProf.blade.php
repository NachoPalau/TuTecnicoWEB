<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil Profesional - TuTécnico</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
  @include("componentes/navbar-top")

  <div class="container-fluid mt-3 mt-lg-5 mb-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-11 col-md-10 col-lg-9">
        <h2 class="fw-bold m-5">Perfil Profesional</h2>

        <!-- Encabezado del perfil -->
        <div class="card bg-primary text-white mb-4">

          <div class="card-body">
            <div class="row align-items-center">

              <div class="col-md-2 text-center mb-3 mb-md-0">
                <img src="{{ asset('') }}" class="img-thumbnail rounded-circle"
                  style="width: 120px; height: 120px;" alt="Foto de perfil">
              </div>
              <div class="col-md-6">
                <h3 class="fw-bold mb-1" id="profesional-name">Carlos Méndez</h3>
                <p class="mb-2"><i class="bi bi-tools me-2"></i><span id="profesional-especialidad">Técnico en
                    electrónica</span></p>
                <div class="mb-2" id="profesional-valoracion">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span class="ms-2">4.5 (86 reseñas)</span>
                </div>
                <p><i class="bi bi-geo-alt-fill me-2"></i><span id="profesional-localidad">Buenos Aires,
                    Argentina</span></p>
              </div>
              <div class="col-md-4 text-md-end">
                <button class="btn btn-light btn-lg rounded-pill px-4 me-2">
                  <i class="bi bi-share me-1"></i> Compartir
                </button>
                <button class="btn btn-outline-light btn-lg rounded-pill px-4" id="edit-profile-btn">
                  <i class="bi bi-pencil me-1"></i> Editar
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Sección de información -->
        <div class="row">
          <!-- Columna izquierda -->
          <div class="col-lg-8 mb-4">
            <!-- Sobre mí -->
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title fw-bold mb-3"><i class="bi bi-person-badge me-2 text-primary"></i>Sobre mí</h5>
                <p class="card-text" id="profesional-bio">Técnico especializado con más de 10 años de experiencia en
                  reparación y mantenimiento de electrodomésticos. Trabajo con responsabilidad, puntualidad y
                  transparencia en mis presupuestos.</p>
              </div>
            </div>

            <!-- Servicios -->
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title fw-bold mb-3"><i class="bi bi-tools me-2 text-primary"></i>Servicios ofrecidos
                </h5>
                <div class="row" id="servicios-container">
                  <!-- Los servicios se cargarán dinámicamente desde la base de datos -->
                  <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                      <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                        <i class="bi bi-blender text-primary"></i>
                      </div>
                      <div>
                        <h6 class="fw-bold mb-0">Electrodomésticos</h6>
                        <small class="text-muted">Lavadoras, secadoras, microondas</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center">
                      <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                        <i class="bi bi-tv text-primary"></i>
                      </div>
                      <div>
                        <h6 class="fw-bold mb-0">Electrónica</h6>
                        <small class="text-muted">Televisores, sistemas de audio</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Disponibilidad -->
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title fw-bold mb-3"><i class="bi bi-calendar-week me-2 text-primary"></i>Próxima
                  disponibilidad</h5>
                <div class="table-responsive">
                  <table class="table table-bordered" id="disponibilidad-table">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Las reservas disponibles se cargarán dinámicamente -->
                      <tr>
                        <td>15 Jun 2023</td>
                        <td>10:00 - 12:00</td>
                        <td><button class="btn btn-sm btn-outline-primary">Reservar</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Columna derecha -->
          <div class="col-lg-4">
            <!-- Estadísticas -->
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title fw-bold mb-3"><i class="bi bi-bar-chart-line me-2 text-primary"></i>Estadísticas
                </h5>
                <div class="mb-3">
                  <div class="d-flex justify-content-between mb-1">
                    <span>Servicios completados</span>
                    <span class="fw-bold" id="servicios-completados">128</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between mb-1">
                    <span>Clientes satisfechos</span>
                    <span class="fw-bold" id="satisfaccion-clientes">92%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar" style="width: 92%"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Contacto -->
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title fw-bold mb-3"><i class="bi bi-telephone me-2 text-primary"></i>Contacto</h5>
                <p><i class="bi bi-envelope me-2"></i><span id="profesional-email">carlos.mendez@example.com</span></p>
                <p><i class="bi bi-phone me-2"></i><span id="profesional-telefono">+54 11 2345-6789</span></p>
                <button class="btn btn-primary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#contactModal">
                  <i class="bi bi-chat-left-text me-1"></i> Enviar mensaje
                </button>
              </div>
            </div>

            <!-- Reseñas recientes -->
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title fw-bold mb-3"><i class="bi bi-star me-2 text-primary"></i>Reseñas recientes</h5>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span class="fw-bold">Ana López</span>
                    <span class="text-warning">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </span>
                  </div>
                  <p class="mb-0">Excelente servicio, muy profesional y puntual.</p>
                  <small class="text-muted">Hace 2 semanas</small>
                </div>
                <hr>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span class="fw-bold">Juan Pérez</span>
                    <span class="text-warning">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star"></i>
                    </span>
                  </div>
                  <p class="mb-0">Buen trabajo, pero un poco caro.</p>
                  <small class="text-muted">Hace 1 mes</small>
                </div>
                <a href="#" class="btn btn-outline-primary w-100 mt-2">Ver todas las reseñas</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de contacto -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalLabel">Enviar mensaje</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="mensaje-form">
            <div class="mb-3">
              <label for="mensaje-text" class="form-label">Mensaje</label>
              <textarea class="form-control" id="mensaje-text" rows="3" required></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" form="mensaje-form" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Barra de navegación inferior -->
  @include("componentes/navbar-bottom")

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Aquí iría la lógica para cargar los datos del profesional desde la base de datos
    document.addEventListener('DOMContentLoaded', function () {
      // Ejemplo de cómo podrías cargar los datos
      // fetch('/api/profesional/1')
      //   .then(response => response.json())
      //   .then(data => {
      //     document.getElementById('profesional-name').textContent = data.name;
      //     document.getElementById('profesional-especialidad').textContent = data.especialidad;
      //     // ... etc
      //   });

      // Evento para el botón de editar
      document.getElementById('edit-profile-btn').addEventListener('click', function () {
        // Lógica para editar el perfil
        console.log('Editar perfil');
      });

      // Evento para el formulario de mensaje
      document.getElementById('mensaje-form').addEventListener('submit', function (e) {
        e.preventDefault();
        // Lógica para enviar mensaje
        console.log('Mensaje enviado');
        var modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
        modal.hide();
      });
    });
  </script>
</body>

</html>