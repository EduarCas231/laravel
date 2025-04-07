<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios - ByteLab</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
</head>

<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('productos') }}">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" class="me-2">
                <span class="d-none d-md-inline">ByteLab</span>
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
                            <a class="nav-link active" href="{{ route('usuarios') }}">
                                <i class="fas fa-users me-2"></i>Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('accesos') }}">
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
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h3 class="mb-2 mb-md-0"><i class="fas fa-users me-2"></i>Lista de Usuarios</h3>
            <div class="d-flex flex-wrap gap-2">
                @if(auth()->check() && auth()->user()->tipo_u == 1)
                <a href="{{ route('exportar.usuarios') }}" class="btn btn-success">
                    <i class="fas fa-file-excel me-1"></i> Exportar
                </a>
                @endif
                <a href="{{ route('usuarios.alta') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Nuevo
                </a>
            </div>
        </div>

        <!-- Usuario actual -->
        @if(auth()->check())
        <div class="user-card text-center mb-4">
            <h4><i class="fas fa-user-circle me-2"></i>¡Bienvenido {{ auth()->user()->nombre_u }}!</h4>
            <img src="{{ asset(auth()->user()->foto_u) }}" alt="Foto de perfil" class="img-fluid">
            <div class="mt-3">
                <p><i class="fas fa-envelope me-2"></i><strong>Correo:</strong> {{ auth()->user()->correo_u }}</p>
                <p><i class="fas fa-phone me-2"></i><strong>Teléfono:</strong> {{ auth()->user()->telefono_u }}</p>
                <a href="{{ route('usuarios_editar', ['id' => auth()->user()->id_usuarios]) }}" class="btn btn-success mt-2">
                    <i class="fas fa-edit me-1"></i> Editar Perfil
                </a>
            </div>
        </div>
        @endif

        <!-- Tabla de usuarios (para pantallas grandes) -->
        <div class="table-container">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset($usuario['foto_u']) }}" alt="Foto" style="width:40px;height:40px;border-radius:50%;"></td>
                        <td>{{ $usuario['nombre_u'] }}</td>
                        <td>{{ $usuario['correo_u'] }}</td>
                        <td>{{ $usuario['telefono_u'] }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('usuarios.detalle', ['id' => $usuario['id_usuarios']]) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->check() && (auth()->user()->tipo_u == 1 || auth()->user()->id == $usuario['id_usuarios']))
                                <a href="{{ route('usuarios_editar', ['id' => $usuario['id_usuarios']]) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif
                                @if(auth()->check() && auth()->user()->tipo_u == 1)
                                <form action="{{ route('usuarios.borrar', ['id' => $usuario['id_usuarios']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Lista de usuarios (para móviles) -->
        <div class="users-list">
            @foreach($usuarios as $usuario)
            <div class="user-list-card d-flex align-items-start">
                <img src="{{ asset($usuario['foto_u']) }}" alt="Foto" class="user-list-img">
                <div class="user-list-info">
                    <h5>{{ $usuario['nombre_u'] }}</h5>
                    <p class="mb-1"><i class="fas fa-envelope me-1"></i>{{ $usuario['correo_u'] }}</p>
                    <p class="mb-2"><i class="fas fa-phone me-1"></i>{{ $usuario['telefono_u'] }}</p>
                    <div class="user-list-actions">
                        <a href="{{ route('usuarios.detalle', ['id' => $usuario['id_usuarios']]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if(auth()->check() && (auth()->user()->tipo_u == 1 || auth()->user()->id == $usuario['id_usuarios']))
                        <a href="{{ route('usuarios_editar', ['id' => $usuario['id_usuarios']]) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endif
                        @if(auth()->check() && auth()->user()->tipo_u == 1)
                        <form action="{{ route('usuarios.borrar', ['id' => $usuario['id_usuarios']]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Botón flotante para gráficas (solo para administradores) -->
    @if(auth()->check() && auth()->user()->tipo_u == 1)
    <button class="btn btn-primary floating-btn" data-bs-toggle="modal" data-bs-target="#graficasModal">
        <i class="fas fa-chart-pie"></i>
    </button>

    <!-- Modal de gráficas -->
    <div class="modal fade" id="graficasModal" tabindex="-1" aria-labelledby="graficasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="graficasModalLabel"><i class="fas fa-chart-bar me-2"></i>Estadísticas de Usuarios</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="chart-container">
                        <canvas id="tipoUsuarioChart"></canvas>
                    </div>
                    <div class="chart-container mt-4">
                        <canvas id="generoChart"></canvas>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="text-center mt-4 py-3">
        <div class="container">
            <div class="social-icons mb-2">
                <a href="https://www.facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-x-twitter"></i></a>
            </div>
            <p class="mb-0 small">&copy; 2024 ByteLab. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts para las gráficas -->
    <script>
        // Gráfica de Tipo de Usuario
        const tipoUsuarioChartData = @json($tipoUsuarioChart);
        const tipoUsuarioCtx = document.getElementById('tipoUsuarioChart').getContext('2d');
        new Chart(tipoUsuarioCtx, {
            type: 'pie',
            data: {
                labels: tipoUsuarioChartData.labels,
                datasets: [{
                    label: 'Cantidad de Usuarios',
                    data: tipoUsuarioChartData.data,
                    backgroundColor: [
                        'rgba(67, 111, 177, 0.8)',  // Azul cobalto
                        'rgba(40, 167, 69, 0.8)',   // Verde éxito
                    ],
                    borderColor: [
                        'rgba(67, 111, 177, 1)',
                        'rgba(40, 167, 69, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#ffffff',
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución por Tipo de Usuario',
                        color: '#436fb1',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2c2c2c',
                        titleColor: '#436fb1',
                        bodyColor: '#ffffff',
                        borderColor: '#436fb1',
                        borderWidth: 1
                    }
                }
            }
        });

        // Gráfica de Género
        const generoChartData = @json($generoChart);
        const generoCtx = document.getElementById('generoChart').getContext('2d');
        new Chart(generoCtx, {
            type: 'pie',
            data: {
                labels: generoChartData.labels,
                datasets: [{
                    label: 'Cantidad de Usuarios',
                    data: generoChartData.data,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',  // Azul
                        'rgba(255, 99, 132, 0.8)',   // Rojo
                        'rgba(153, 102, 255, 0.8)'   // Morado
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#ffffff',
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución por Género',
                        color: '#436fb1',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#2c2c2c',
                        titleColor: '#436fb1',
                        bodyColor: '#ffffff',
                        borderColor: '#436fb1',
                        borderWidth: 1
                    }
                }
            }
        });
    </script>
</body>

</html>