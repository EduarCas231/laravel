<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="icon" href="{{ url('img/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Estilos generales */
        :root {
            --background-color: #1a1a1a; /* Fondo más oscuro */
            --text-color: #e0e0e0; /* Texto claro */
            --primary-color: #436fb1; /* Azul cobalto */
            --primary-hover: #365a8c; /* Azul cobalto más oscuro */
            --footer-bg: #121212; /* Fondo del footer más oscuro */
            --footer-text: #436fb1; /* Azul cobalto */
            --card-bg: #2c2c2c; /* Fondo de tarjetas más oscuro */
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            padding-top: 70px;
        }

        /* Barra de Navegación */
        .navbar {
            background-color: var(--footer-bg); /* Fondo oscuro */
            border-bottom: 2px solid var(--primary-color); /* Borde inferior en azul cobalto */
        }

        .navbar-brand, .nav-link {
            color: var(--text-color) !important; /* Texto claro */
        }

        .nav-link:hover {
            color: var(--primary-color) !important; /* Hover en azul cobalto */
        }

        .btn-danger {
            background-color: var(--primary-color); /* Botón de Cerrar Sesión en azul cobalto */
            border: none;
        }

        .btn-danger:hover {
            background-color: var(--primary-hover); /* Hover un poco más oscuro */
        }

        /* Tarjetas de Usuarios */
        .user-card {
            background-color: var(--card-bg); /* Fondo de tarjetas más oscuro */
            border: 1px solid var(--primary-color); /* Borde en azul cobalto */
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
        }

        .user-card img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .user-card h5 {
            color: var(--primary-color); /* Título en azul cobalto */
        }

        .user-card p {
            color: var(--text-color); /* Texto claro */
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg); /* Fondo del footer más oscuro */
            color: var(--footer-text); /* Texto en azul cobalto */
            padding: 20px 0;
            margin-top: 40px;
        }

        .social-icons a {
            color: var(--footer-text); /* Iconos en azul cobalto */
            margin: 0 10px;
            font-size: 1.5rem;
        }

        .social-icons a:hover {
            color: var(--primary-hover); /* Hover un poco más oscuro */
        }

        /* Botones Primarios */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
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

    <div class="container mt-5 pt-5">
        <h3>Lista de Usuarios</h3>

        @if(auth()->check())
        <div class="current-user-container">
            <h4>¡Bienvenido {{ auth()->user()->nombre_u }}!</h4>
            <div class="user-card">
                <img src="{{ url('img/images/' . auth()->user()->foto_u) }}" alt="Foto de {{ auth()->user()->nombre_u }}">
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ url('img/images/'.$usuario['foto_u']) }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;"></td>
                        <td>{{ $usuario['nombre_u'] }}</td>
                        <td>{{ $usuario['correo_u'] }}</td>
                        <td>{{ $usuario['telefono_u'] }}</td>
                        <td>{{ $usuario['direccion_u'] }}</td>
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

</body>

</html>
