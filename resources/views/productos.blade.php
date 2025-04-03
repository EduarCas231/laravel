<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ByteLab - Productos</title>
    <link rel="icon" href="{{ asset('img/bitelogo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/logo1.jpeg') }}" type="image/jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/producto.css') }}">
</head>

<body>
    <!-- Navbar Mejorada -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('productos') }}">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" class="me-2">
                <span class="d-none d-sm-inline">ByteLab</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" id="offcanvasNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-primary">Menú ByteLab</h5>
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
                            <a class="nav-link active" href="{{ route('productos') }}">
                                <i class="fas fa-box me-2"></i>Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios') }}">
                                <i class="fas fa-users me-2"></i>Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('accesos') }}">
                                <i class="fas fa-key me-2"></i>Accesos
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

    <!-- Sección de usuario mejorada -->
    <div class="container mt-4">
        <div class="user-section text-center text-md-end">
            @if(auth()->check())
                <div class="d-inline-block me-2">
                    <span class="badge bg-primary">
                        @if(auth()->user()->tipo_u == 1)
                            <i class="fas fa-user-shield me-1"></i>Administrador
                        @else
                            <i class="fas fa-user me-1"></i>Usuario
                        @endif
                    </span>
                </div>
                @if(auth()->user()->tipo_u == 1)
                    <div class="d-grid gap-2 d-md-block mt-2 mt-md-0">
                        <a href="{{ route('producto_alta') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus-circle me-1"></i>Nuevo Producto
                        </a>
                        <a href="{{ route('exportar.productos') }}" class="btn btn-info btn-sm ms-md-2">
                            <i class="fas fa-file-excel me-1"></i>Exportar
                        </a>
                    </div>
                @endif
            @else
                <p class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>No estás autenticado</p>
            @endif
        </div>
    </div>

    <!-- Contenido Principal Mejorado -->
    <div class="container mt-3">
        <h3 class="mb-3 text-primary"><i class="fas fa-box-open me-2"></i>Productos</h3>
        <h5 class="text-muted mb-4"><i class="fas fa-check-circle me-2"></i>Productos disponibles</h5>
        <hr class="border-primary">

        <!-- Formulario de Búsqueda Mejorado -->
        <div class="search-container">
            <form action="{{ route('productos') }}" method="GET">
                <div class="input-group mb-4">
                    <input type="text" class="form-control search-bar" name="buscar" value="{{ $buscar }}" 
                           placeholder="Buscar producto..." aria-label="Buscar productos">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Buscar
                    </button>
                    <a href="{{ route('productos') }}" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Tarjetas de Productos Mejoradas -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($productos as $producto)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-img-container">
                            <img src="{{ asset($producto['foto_p']) }}" 
                                 class="card-img {{ $producto['foto_p'] === 'fondo' ? 'card-img-fill' : '' }}" 
                                 alt="{{ $producto['name_p'] }}"
                                 loading="lazy">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $producto['name_p'] }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($producto['detalle_p'], 60) }}</p>
                            <div class="mt-auto">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('producto_detalle', ['id' => $producto['id_productos']]) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Detalles
                                    </a>
                                    @if(auth()->check() && auth()->user()->tipo_u == 1)
                                        <a href="{{ route('producto_editar', ['id' => $producto['id_productos']]) }}" 
                                           class="btn btn-success btn-sm">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación Mejorada -->
        <div class="d-flex justify-content-center mt-5">
            {{ $productos->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- Footer Mejorado -->
    <footer>
        <div class="container text-center">
            <div class="social-icons mb-3">
                <a href="https://www.facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-x-twitter"></i></a>
                <a href="https://github.com" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
            </div>
            <p class="mb-1"><i class="fas fa-code me-1"></i> Desarrollado  por ByteLab</p>
            <p class="mb-0 small">&copy; 2024 ByteLab. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>