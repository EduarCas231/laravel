<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-primary">Registro de Usuario</h3>
        <form action="{{ route('usuarios.registrar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-4">
                <input type="file" class="form-control" name="foto_u" id="foto_u">
                <label for="foto_u">Foto</label>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="nombre_u" id="nombre_u" placeholder="Nombre" required>
                <label for="nombre_u">Nombre</label>
            </div>
            <div class="form-floating mb-4">
                <input type="email" class="form-control" name="correo_u" id="correo_u" placeholder="Correo" required>
                <label for="correo_u">Correo</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="contraseña_u" id="contraseña_u" placeholder="Contraseña" required>
                <label for="contraseña_u">Contraseña</label>
                <div id="contraseñaHelp" class="form-text text-danger" style="display:none;">
                    La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas, números y caracteres especiales.
                </div>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="telefono_u" id="telefono_u" placeholder="Teléfono" required>
                <label for="telefono_u">Teléfono</label>
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="direccion_u" id="direccion_u" placeholder="Dirección" required>
                <label for="direccion_u">Dirección</label>
            </div>
            <div class="form-floating mb-4">
                <select class="form-select" name="tipo_u" id="tipo_u" required>
                    <option value="" disabled selected>Seleccione tipo</option>
                    <option value="0">Usuario</option>
                </select>
                <label for="tipo_u">Tipo de Usuario</label>
            </div>
            <div class="form-floating mb-4">
                <input type="date" class="form-control" name="fecha_u" id="fecha_u" placeholder="Fecha de Nacimiento" required>
                <label for="fecha_u">Fecha de Nacimiento</label>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script>
        document.getElementById("contraseña_u").addEventListener("input", function(event) {
            const password = event.target.value;
            const errorMessage = document.getElementById("contraseñaHelp");
            const passwordCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
            
            errorMessage.style.display = passwordCriteria.test(password) ? "none" : "block";
        });
    </script>
</body>
</html>
