<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteLab - Productos</title>
    <link rel="icon" href="{{ asset('img/bitelogo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo1.jpeg') }}" type="image/jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Tarjetas de Productos */
        .card {
            background-color: var(--card-bg); /* Fondo de tarjetas más oscuro */
            border: 1px solid var(--primary-color); /* Borde en azul cobalto */
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05); /* Efecto de escala al pasar el mouse */
        }

        .card-title {
            color: var(--primary-color); /* Título en azul cobalto */
        }

        .card-text {
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

        /* Formularios y Barras de Búsqueda */
        .form-control {
            background-color: var(--card-bg); /* Fondo más oscuro */
            border: 1px solid var(--primary-color);
            border-radius: 5px;
            color: var(--text-color); /* Texto claro */
        }

        .form-control:focus {
            border-color: var(--primary-hover);
            box-shadow: 0 0 5px rgba(67, 111, 177, 0.5);
        }

        /* Efectos de Hover y Transiciones */
        .nav-link, .btn, .card {
            transition: all 0.3s ease;
        }

        /* Sombras y Profundidad */
        .navbar, .card, .btn {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
           
            <div class="ms-auto">
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    
                    <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="text-end mb-4">
            @if(auth()->check())
                <p>Tipo de usuario: {{ auth()->user()->tipo_u }}</p>
                @if(auth()->user()->tipo_u == 1) 
                <a href="{{ route('producto_alta') }}" class="btn btn-success mb-3">Nuevo Registro de producto</a>   
                    
                @else
                    <p>No tienes permiso para agregar productos.</p>
                @endif
            @else
                <p>No estás autenticado.</p>
            @endif
        </div>
    <!-- Contenido Principal -->
    <div class="container mt-5 pt-5">
        <h3>Productos</h3>
        <h5>Productos disponibles</h5>
        <hr>

        <!-- Formulario de Búsqueda -->
        <form action="{{ route('productos') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-bar" name="buscar" value="{{ $buscar }}" placeholder="Buscar producto...">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('productos') }}" class="btn btn-danger">Todos los productos</a>
            </div>
        </form>



        <!-- Tarjetas de Productos -->
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card">
                        <img src="{{ url('img/images/' . ($producto['foto_p'] ?? 'def.avif')) }}" class="card-img-top" alt="Imagen del producto">
                        <div class="card-body">
                            <h5 class="card-title">Producto: {{ $producto['name_p'] }}</h5>
                            <p class="card-text">Marca: {{ $producto['marca_p'] }}</p>
                            <p class="card-price">Precio: ${{ number_format($producto['precio_p'], 2, '.', ',') }}</p>
                            <p class="card-text">Stock: {{ $producto['stock_p'] }}</p>
                            <p class="card-text">Detalle: {{ $producto['detalle_p'] }}</p>

                            <a href="{{ route('producto_detalle', ['id' => $producto['id_productos']]) }}" class="btn btn-primary">Ver detalles</a>

                            @if(auth()->check() && auth()->user()->tipo_u == 1) 
                                <a href="{{ route('producto_editar', ['id' => $producto['id_productos']]) }}" class="btn btn-success mb-3">Editar</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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