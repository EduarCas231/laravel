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
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .chart-container {
            width: 80%;
            margin: 10px auto;
            background-color: #2c2c2c;
            border-radius: 10px;
            padding: 15px;
        }

        .chart-container canvas {
            max-width: 100%;
            height: 250px !important;
            background-color: #2c2c2c;
        }
    </style>
</head>

<body>
    <div class="container mt-5 pt-5">
        <h3>Lista de Usuarios</h3>
        <a href="{{ route('exportar.usuarios') }}" class="btn btn-success mb-3">
            <i class="fas fa-file-excel"></i> Exportar a Excel
        </a>
        <a href="{{ route('usert.alta') }}" class="btn btn-primary floating-btn">
            <i class="fas fa-plus"></i> Agregar Usuario
        </a>
    </div>

    @if(auth()->check())
    <div class="current-user-container">
        <h4>¡Bienvenido {{ auth()->user()->nombre_u }}!</h4>
        <div class="user-card">
            <img src="{{ asset(auth()->user()->foto_u) }}" alt="Foto de {{ auth()->user()->nombre_u }}">
            <h5>{{ auth()->user()->nombre_u }}</h5>
            <p><strong>Correo:</strong> {{ auth()->user()->correo_u }}</p>
            <p><strong>Dirección:</strong> {{ auth()->user()->direccion_u }}</p>
            <div>
                <a href="{{ route('usuarios.editar', ['id' => auth()->user()->id_usuarios]) }}" class="btn btn-success btn-sm">Editar</a>
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
                    <th>Dirección</th>
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
                    <td>{{ $usuario['direccion_u'] }}, {{ $usuario['estado_u'] }}, {{ $usuario['municipio_u'] }}</td>
                    <td>
                        <form action="{{ route('usert.borrar', ['id' => $usuario['id_usert']]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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