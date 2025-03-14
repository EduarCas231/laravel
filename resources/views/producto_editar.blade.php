<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/usuarioED.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-primary">Editar Producto</h3>
        <form action="{{ route('producto_salvar', ['id' => $producto['id_productos']]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                @if (!empty($producto['foto_p']))
                <img src="{{ asset($producto['foto_p']) }}" alt="Foto del producto" width="120px" style="border-radius:5px;">
                @else
                <p class="text-muted">Sin foto</p>
                @endif
            </div>

            <div class="form-floating mb-4">
                <input type="file" class="form-control" name="foto_p" id="foto_p" accept="image/*">
                <input type="hidden" name="foto_actual" value="{{ $producto['foto_p'] ?? '' }}">
                <label for="foto_p">Foto</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="name_p" id="name_p" value="{{ old('name_p', $producto['name_p']) }}" placeholder="Nombre" required>
                <label for="name_p">Nombre</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="Noserie_p" id="Noserie_p" value="{{ old('Noserie_p', $producto['Noserie_p']) }}" placeholder="Número de Serie" required>
                <label for="Noserie_p">Número de Serie</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="modelo_p" id="modelo_p" value="{{ old('modelo_p', $producto['modelo_p']) }}" placeholder="Modelo" required>
                <label for="modelo_p">Modelo</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="region_p" id="region_p" value="{{ old('region_p', $producto['region_p']) }}" placeholder="Región" required>
                <label for="region_p">Región</label>
            </div>

            <div class="form-floating mb-4">
                <textarea class="form-control" name="detalle_p" id="detalle_p" placeholder="Detalles" required>{{ old('detalle_p', $producto['detalle_p']) }}</textarea>
                <label for="detalle_p">Detalles</label>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('productos') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</body>

</html>