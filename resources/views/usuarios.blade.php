<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
    <style>
        /* Estilos para el botón flotante */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        /* Estilos para las gráficas dentro del modal */
        .chart-container {
            width: 80%;
            /* Reducir el ancho del contenedor */
            margin: 10px auto;
            /* Centrar el contenedor */
            background-color: #2c2c2c;
            /* Fondo oscuro */
            border-radius: 10px;
            /* Bordes redondeados */
            padding: 15px;
            /* Espaciado interno */
        }

        .chart-container canvas {
            max-width: 100%;
            height: 250px !important;
            /* Reducir la altura del gráfico */
            background-color: #2c2c2c;
            /* Fondo oscuro para el gráfico */
        }
    </style>
</head>

<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('productos') }}">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" width="45">
                ByteLab
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" id="offcanvasDarkNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('homebyte') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('productos') }}">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('usuarios') }}">Usuarios</a></li>
                    </ul>
                </div>
            </div>
            <!-- Botón de Cerrar Sesión alineado a la derecha -->
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Botón flotante para administradores -->
    @if(auth()->check() && auth()->user()->tipo_u == 1)
    <button class="btn btn-primary floating-btn" data-bs-toggle="modal" data-bs-target="#graficasModal">
        <i class="fas fa-chart-pie"></i> Ver Gráficas
    </button>
    @endif

    <div class="container mt-5 pt-5">
        <h3>Lista de Usuarios</h3>

        @if(auth()->check())
        <div class="current-user-container">
            <h4>¡Bienvenido {{ auth()->user()->nombre_u }}!</h4>
            <div class="user-card">
                <img src="{{ asset(auth()->user()->foto_u) }}" alt="Foto de {{ auth()->user()->nombre_u }}">
                <h5>{{ auth()->user()->nombre_u }}</h5>
                <p><strong>Correo:</strong> {{ auth()->user()->correo_u }}</p>
                <p><strong>Teléfono:</strong> {{ auth()->user()->telefono_u }}</p>
                <p><strong>Dirección:</strong> {{ auth()->user()->direccion_u }}</p>
                <div>
                    <a href="{{ route('usuarios.editar', ['id' => auth()->user()->id_usuarios]) }}" class="btn btn-success btn-sm" aria-label="Editar tu usuario">Editar</a>
                </div>
            </div>
        </div>
        @endif

        <div class="table-container table-desktop">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset($usuario['foto_u']) }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;"></td>
                        <td>{{ $usuario['nombre_u'] }}</td>
                        <td>{{ $usuario['correo_u'] }}</td>
                        <td>{{ $usuario['telefono_u'] }}</td>
                        <td>{{ $usuario['direccion_u'] }}</td>
                        <td>
                            @if($usuario['genero_u'] == 1)
                            Hombre
                            @elseif($usuario['genero_u'] == 0)
                            Mujer
                            @else
                            No especificado
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('usuarios.detalle', ['id' => $usuario['id_usuarios']]) }}" class="btn btn-primary btn-sm" aria-label="Ver detalles de {{ $usuario['nombre_u'] }}">Detalle</a>
                            @if(auth()->check())
                            @if(auth()->user()->tipo_u == 1 || auth()->user()->id == $usuario['id_usuarios'])
                            <a href="{{ route('usuarios.editar', ['id' => $usuario['id_usuarios']]) }}" class="btn btn-success btn-sm" aria-label="Editar usuario {{ $usuario['nombre_u'] }}">Editar</a>
                            @endif
                            @if(auth()->user()->tipo_u == 1)
                            <form action="{{ route('usuarios.borrar', ['id' => $usuario['id_usuarios']]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" aria-label="Borrar usuario {{ $usuario['nombre_u'] }}">Borrar</button>
                            </form>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para las gráficas -->
    <div class="modal fade" id="graficasModal" tabindex="-1" aria-labelledby="graficasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light"> <!-- Fondo oscuro y texto claro -->
                <div class="modal-header bg-dark border-secondary"> <!-- Fondo oscuro y borde secundario -->
                    <h5 class="modal-title" id="graficasModalLabel">Gráficas de Usuarios</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body bg-dark"> <!-- Fondo oscuro -->
                    <div class="chart-container">
                        <canvas id="tipoUsuarioChart"></canvas>
                    </div>
                    <div class="chart-container mt-4"> <!-- Contenedor para la gráfica de género -->
                        <canvas id="generoChart"></canvas>
                    </div>
                </div>
                <div class="modal-footer bg-dark border-secondary"> <!-- Fondo oscuro y borde secundario -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.whatsapp.com" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
            </div>
            <p class="mt-3">&copy; 2024 ByteLab. Todos los derechos reservados.</p>
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
                        'rgba(54, 162, 235, 0.8)', // Color para usuarios normales
                        'rgba(255, 99, 132, 0.8)', // Color para administradores
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
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
                            color: '#ffffff', // Color blanco para las leyendas
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Usuarios por Tipo',
                        color: '#ffffff', // Color blanco para el título
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
                        'rgba(255, 99, 132, 0.8)', // Color para mujeres
                        'rgba(54, 162, 235, 0.8)', // Color para hombres
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
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
                            color: '#ffffff', // Color blanco para las leyendas
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Usuarios por Género',
                        color: '#ffffff', // Color blanco para el título
                    }
                }
            }
        });
    </script>
</body>

</html>