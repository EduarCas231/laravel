<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/usuarioED.css') }}">
    <style>
        .password-strength {
            height: 5px;
            width: 10%;
            background: gray;
            margin-top: 5px;
            border-radius: 3px;
        }

        .password-strength.red {
            background: red;
        }

        .password-strength.orange {
            background: orange;
        }

        .password-strength.green {
            background: green;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
        }

        .password-container {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-primary">Editar Usuario</h3>
        <form action="{{ route('usuarios_salvar', ['id' => $usuario['id_usuarios']]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

            <div class="mb-4">
                @if (!empty($usuario['foto_u']))
                 <img src="{{ asset($usuario['foto_u']) }}" alt="Foto de {{ $usuario['nombre_u'] }}" width="120px" style="border-radius:5px;">
                @else
                <p class="text-muted">Sin foto</p>
                @endif
            </div>

            <div class="form-floating mb-4">
                <input type="file" class="form-control" name="foto_u" id="foto_u" accept="image/*">
                <input type="hidden" name="foto_actual" value="{{ $usuario['foto_u'] ?? '' }}">
                <label for="foto_u">Foto</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="nombre_u" id="nombre_u" value="{{ old('nombre_u', $usuario['nombre_u']) }}" placeholder="Nombre" required>
                <label for="nombre_u">Nombre</label>
            </div>

            <div class="form-floating mb-4">
                <input type="email" class="form-control" name="correo_u" id="correo_u" value="{{ old('correo_u', $usuario['correo_u']) }}" placeholder="Correo" required>
                <label for="correo_u">Correo</label>
            </div>

            <div class="form-floating mb-4 password-container">
                <input type="password" class="form-control" name="contraseña_u" id="contraseña_u" placeholder="Dejar en blanco si no deseas cambiarla" oninput="actualizarBarra()">
                <label for="contraseña_u">Contraseña</label>
                <span class="toggle-password" onclick="togglePassword('contraseña_u')">&#128065;</span>
                <div id="password-strength-bar" class="password-strength"></div>
                <div class="form-text">Dejar en blanco si no deseas cambiar la contraseña.</div>
            </div>

           <div class="form-floating mb-4">
    @if(auth()->check() && auth()->user()->tipo_u == 1)
        <!-- Usuarios ADMIN (pueden seleccionar entre "Usuario" y "Administrador") -->
        <select class="form-select" name="tipo_u" id="tipo_u" required>
            <option value="" disabled selected>Seleccione tipo</option>
            <option value="0" {{ (isset($usuario) && $usuario->tipo_u == 0) ? 'selected' : '' }}>Usuario</option>
            <option value="1" {{ (isset($usuario) && $usuario->tipo_u == 1) ? 'selected' : '' }}>Administrador</option>
        </select>
        <label for="tipo_u">Tipo de Usuario</label>
    @else
        <!-- Usuarios NO ADMIN (solo ven "Usuario" y no pueden cambiarlo) -->
        <input type="text" class="form-control" value="Usuario" readonly>
        <input type="hidden" name="tipo_u" value="0"> <!-- Envía siempre "0" si no es admin -->
        <label>Tipo de Usuario</label>
    @endif
</div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="telefono_u" id="telefono_u" value="{{ old('telefono_u', $usuario['telefono_u']) }}" placeholder="Teléfono" required>
                <label for="telefono_u">Teléfono</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="direccion_u" id="direccion_u" value="{{ old('direccion_u', $usuario['direccion_u']) }}" placeholder="Dirección" required>
                <label for="direccion_u">Dirección</label>
            </div>

            <div class="form-floating mb-4">
                <input type="date" class="form-control" name="fecha_u" id="fecha_u"
                    value="{{ old('fecha_u', \Carbon\Carbon::parse($usuario['fecha_u'])->format('Y-m-d')) }}" required>

            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('usuarios') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }

        function actualizarBarra() {
            const password = document.getElementById("contraseña_u").value;
            const strengthBar = document.getElementById("password-strength-bar");

            if (password.length < 8) {
                strengthBar.className = "password-strength red";
            } else if (password.length >= 8 && password.length <= 10) {
                strengthBar.className = "password-strength orange";
            } else if (password.length >= 11 && password.length <= 16) {
                strengthBar.className = "password-strength green";
            } else {
                strengthBar.className = "password-strength";
            }
        }
    </script>
</body>

</html>
