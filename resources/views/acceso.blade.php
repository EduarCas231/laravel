<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Accesos - ByteLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/accesos.css') }}">
</head>

<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('productos') }}">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" class="me-2">
                <span class="d-none d-sm-inline">ByteLab</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" id="offcanvasNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title"><i class="fas fa-bars me-2"></i>Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homebyte') }}">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos') }}">
                                <i class="fas fa-box me-2"></i>Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios') }}">
                                <i class="fas fa-users me-2"></i>Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('accesos') }}">
                                <i class="fas fa-key me-2"></i>Accesos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('controlar.puerta') }}">
                                <i class="fas fa-door-open me-2"></i>Control Puerta
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>


    <!-- Contenido Principal -->
    <div class="container mt-5 pt-4">
        <h1 class="text-center mb-4"><i class="fas fa-door-open me-2"></i>Registro de Accesos</h1>

        <!-- Sección de Filtros Mejorada -->
        <div class="filtros-container">
            <div class="filtros-header">
                <i class="fas fa-filter"></i>
                <h4>Filtrar Registros</h4>
            </div>

            <form id="form-filtros">
                <div class="row">
                    <div class="col-md-4">
                        <div class="filtro-group">
                            <label for="filtro-usuario"><i class="fas fa-user me-2"></i>Usuario</label>
                            <input type="text" class="form-control" id="filtro-usuario" placeholder="Ej: Juan Pérez">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="filtro-group">
                            <label for="filtro-accion"><i class="fas fa-exchange-alt me-2"></i>Acción</label>
                            <select class="form-select" id="filtro-accion">
                                <option value="">Todas las acciones</option>
                                <option value="acceso permitido">Acceso permitido</option>
                                <option value="acceso denegado">Acceso denegado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="filtro-group">
                            <label for="filtro-fecha"><i class="fas fa-calendar me-2"></i>Fecha específica</label>
                            <input type="date" class="form-control" id="filtro-fecha">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="filtro-group">
                            <label for="filtro-fecha-inicio"><i class="fas fa-calendar-day me-2"></i>Fecha inicio</label>
                            <input type="date" class="form-control" id="filtro-fecha-inicio">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="filtro-group">
                            <label for="filtro-fecha-fin"><i class="fas fa-calendar-day me-2"></i>Fecha fin</label>
                            <input type="date" class="form-control" id="filtro-fecha-fin">
                        </div>
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="button" id="btn-limpiar" class="btn btn-limpiar">
                        <i class="fas fa-broom me-2"></i>Limpiar filtros
                    </button>
                    <button type="button" id="btn-filtrar" class="btn btn-filtrar">
                        <i class="fas fa-filter me-2"></i>Aplicar filtros
                    </button>
                </div>
            </form>
        </div>

        <!-- Botón de exportación y tabla -->
        @if(auth()->check() && auth()->user()->tipo_u == 1)
        <div class="d-flex justify-content-between mb-3">
            <div></div>
            <a href="{{ route('exportar.accesos') }}" class="btn btn-success">
                <i class="fas fa-file-excel me-2"></i>Exportar a Excel
            </a>
        </div>
        @endif

        <div class="table-responsive">
            <table class="access-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-user-tie me-2"></i>Usuario</th>
                        <th><i class="fas fa-exchange-alt me-2"></i>Acción</th>
                        <th><i class="fas fa-calendar-alt me-2"></i>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody id="tabla-accesos">
                    @foreach ($accesos as $acceso)
                    <tr>
                        <td>
                            <i class="fas fa-user-circle me-2"></i>
                            {{ $acceso->nombre ?? 'Invitado' }}
                        </td>
                        <td class="{{ $acceso->accion == 'acceso permitido' ? 'permitido' : 'denegado' }}">
                            <i class="fas {{ $acceso->accion == 'acceso permitido' ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                            {{ ucfirst($acceso->accion) }}
                        </td>
                        <td>
                            <i class="far fa-clock me-2"></i>
                            {{ $acceso->fecha }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if($accesos->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $accesos->links() }}
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <div class="container">
            <div class="social-icons mb-3">
                <a href="https://www.facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-x-twitter"></i></a>
            </div>
            <p class="mb-0">&copy; 2024 ByteLab. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let ultimaFecha = "{{ $accesos->first()->fecha ?? '' }}";

            // Función para aplicar filtros
            function aplicarFiltros() {
                const usuario = $('#filtro-usuario').val().toLowerCase();
                const accion = $('#filtro-accion').val();
                const fecha = $('#filtro-fecha').val();
                const fechaInicio = $('#filtro-fecha-inicio').val();
                const fechaFin = $('#filtro-fecha-fin').val();

                $('#tabla-accesos tr').each(function() {
                    const fila = $(this);
                    const textoUsuario = fila.find('td:eq(0)').text().toLowerCase();
                    const textoAccion = fila.find('td:eq(1)').text().toLowerCase();
                    const textoFecha = fila.find('td:eq(2)').text();
                    const fechaAcceso = textoFecha.split(' ')[0];

                    let coincide = true;

                    if (usuario && !textoUsuario.includes(usuario)) {
                        coincide = false;
                    }

                    if (accion && !textoAccion.includes(accion.toLowerCase())) {
                        coincide = false;
                    }

                    if (fecha && fechaAcceso !== fecha) {
                        coincide = false;
                    }

                    if ((fechaInicio && fechaAcceso < fechaInicio) ||
                        (fechaFin && fechaAcceso > fechaFin)) {
                        coincide = false;
                    }

                    fila.toggle(coincide);
                });
            }

            $('#btn-filtrar').click(aplicarFiltros);

            $('#btn-limpiar').click(function() {
                $('#form-filtros')[0].reset();
                $('#tabla-accesos tr').show();
            });

            function actualizarAccesos() {
                const filtros = {
                    usuario: $('#filtro-usuario').val(),
                    accion: $('#filtro-accion').val(),
                    fecha: $('#filtro-fecha').val(),
                    fecha_inicio: $('#filtro-fecha-inicio').val(),
                    fecha_fin: $('#filtro-fecha-fin').val(),
                    ultima_fecha: ultimaFecha
                };

                const hayFiltros = Object.values(filtros).some(val => val && val !== ultimaFecha);

                if (!hayFiltros) {
                    fetch('/accesos' + (ultimaFecha ? `?ultima_fecha=${encodeURIComponent(ultimaFecha)}` : ''), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Error en la respuesta');
                            return response.json();
                        })
                        .then(data => {
                            if (data.length > 0) {
                                let tbody = document.getElementById("tabla-accesos");

                                data.forEach(acceso => {
                                    let fila = document.createElement("tr");
                                    fila.classList.add("nuevo-registro");

                                    let iconoAccion = acceso.accion === "acceso permitido" ?
                                        '<i class="fas fa-check-circle me-2"></i>' :
                                        '<i class="fas fa-times-circle me-2"></i>';

                                    fila.innerHTML = `
                                <td>
                                    <i class="fas fa-user-circle me-2"></i>
                                    ${acceso.nombre || 'Invitado'}
                                </td>
                                <td class="${acceso.accion === "acceso permitido" ? "permitido" : "denegado"}">
                                    ${iconoAccion}${acceso.accion.charAt(0).toUpperCase() + acceso.accion.slice(1)}
                                </td>
                                <td>
                                    <i class="far fa-clock me-2"></i>
                                    ${acceso.fecha}
                                </td>
                            `;

                                    tbody.insertBefore(fila, tbody.firstChild);
                                });

                                ultimaFecha = data[0].fecha;
                            }

                            setTimeout(actualizarAccesos, 5000);
                        })
                        .catch(error => {
                            console.error("Error al obtener los accesos:", error);
                            setTimeout(actualizarAccesos, 10000);
                        });
                } else {
                    setTimeout(actualizarAccesos, 5000);
                }
            }

            actualizarAccesos();
        });
    </script>
</body>

</html>