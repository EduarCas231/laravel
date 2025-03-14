<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/usuariosD.css') }}">
</head>
<body>
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
            <div class="ms-auto">
            </div>
        </div>
    </nav>

    <div class="container">
        <h5>Información del Producto</h5>
        <hr>
        @if(isset($producto['foto_p']) && $producto['foto_p'])
            <img src="{{ asset($producto['foto_p']) }}" alt="Imagen del producto" class="profile-img">
        @else
            <p>No hay imagen disponible</p>
        @endif
        <div class="user-info">
            <p><b>Nombre:</b> {{ $producto['name_p'] }}</p>
            <p><b>Número de Serie:</b> {{ $producto['Noserie_p'] }}</p>
            <p><b>Modelo:</b> {{ $producto['modelo_p'] }}</p>
            <p><b>Región:</b> {{ $producto['region_p'] }}</p>
            <p><b>Detalles:</b> {{ $producto['detalle_p'] }}</p>
        </div>
        <br>
        <div class="text-center">
            <a href="{{ route('productos') }}">
                <button type="button" class="btn btn-success">Regresar</button>
            </a>
            @if(Auth::user()->tipo_u == 1)
                <form action="{{ route('producto_borrar', $producto['id_productos']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</button>
                </form>
            @endif
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="social-icons">
                <p>&copy; 2023 ByteLab. Todos los derechos reservados.</p>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>