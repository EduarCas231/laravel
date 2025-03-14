<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Producto</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/prodcutoA.css') }}">


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">
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
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h3>Registro de Producto</h3>
        <hr>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('producto_registrar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name_p" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="name_p" name="name_p" value="{{ old('name_p') }}" required>
            </div>
            <div class="mb-3">
                <label for="detalle_p" class="form-label">Detalles del Producto</label>
                <textarea class="form-control" id="detalle_p" name="detalle_p" rows="3" required>{{ old('detalle_p') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="Noserie_p" class="form-label">Número de Serie</label>
                <input type="text" class="form-control" id="Noserie_p" name="Noserie_p" value="{{ old('Noserie_p') }}" required>
            </div>
            <div class="mb-3">
                <label for="modelo_p" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo_p" name="modelo_p" value="{{ old('modelo_p') }}" required>
            </div>
            <div class="mb-3">
                <label for="region_p" class="form-label">Región</label>
                <input type="text" class="form-control" id="region_p" name="region_p" value="{{ old('region_p') }}" required>
            </div>
            <div class="mb-3">
                <label for="foto_p" class="form-label">Foto del Producto</label>
                <input type="file" class="form-control" id="foto_p" name="foto_p" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success">Registrar Producto</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
