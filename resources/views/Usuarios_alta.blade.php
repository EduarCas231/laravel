<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/usuarioAL.css') }}">
    <style>
        /* Estilo para la barra de seguridad de la contraseña */
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

        /* Estilo para el botón de mostrar contraseña */
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
        <h3 class="text-primary">Registro de Usuario</h3>
        <form id="registroForm" action="{{ route('usuarios.registrar') }}" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            @csrf

            <!-- Foto -->
            <div class="form-floating mb-4">
                <input type="file" class="form-control" name="foto_u" id="foto_u">
                <label for="foto_u">Foto</label>
                <div class="text-danger" id="error_foto"></div>
            </div>

            <!-- Nombre -->
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="nombre_u" id="nombre_u" placeholder="Nombre" required>
                <label for="nombre_u">Nombre</label>
                <div class="text-danger" id="error_nombre"></div>
            </div>

            <!-- Correo -->
            <div class="form-floating mb-4">
                <input type="email" class="form-control" name="correo_u" id="correo_u" placeholder="Correo" required>
                <label for="correo_u">Correo</label>
                <div class="text-danger" id="error_correo"></div>
            </div>

            <!-- Contraseña -->
            <div class="form-floating mb-4 password-container">
                <input type="password" class="form-control" name="contraseña_u" id="contraseña_u" placeholder="Contraseña" required oninput="actualizarBarra()">
                <label for="contraseña_u">Contraseña</label>
                <span class="toggle-password" onclick="togglePassword('contraseña_u')">&#128065;</span>
                <div id="password-strength-bar" class="password-strength"></div>
                <div id="error_contraseña" class="text-danger"></div>
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-floating mb-4 password-container">
                <input type="password" class="form-control" name="contraseña_u_confirmation" id="confirmar_contraseña_u" placeholder="Confirmar Contraseña" required oninput="actualizarBarraConfirmar()">
                <label for="confirmar_contraseña_u">Confirmar Contraseña</label>
                <span class="toggle-password" onclick="togglePassword('confirmar_contraseña_u')">&#128065;</span>
                <div id="password-strength-bar-confirmar" class="password-strength"></div>
                <div id="error_confirmar_contraseña" class="text-danger"></div>
            </div>

            <!-- Teléfono -->
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="telefono_u" id="telefono_u" placeholder="Teléfono" required>
                <label for="telefono_u">Teléfono</label>
                <div class="text-danger" id="error_telefono"></div>
            </div>

            <!-- Dirección -->
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="direccion_u" id="direccion_u" placeholder="Dirección" required>
                <label for="direccion_u">Dirección</label>
            </div>

            <!-- Tipo de Usuario -->
            <div class="form-floating mb-4">
                <select class="form-select" name="tipo_u" id="tipo_u" required>
                    <option value="" disabled selected>Seleccione tipo</option>
                    <option value="0">Usuario</option>
                </select>
                <label for="tipo_u">Tipo de Usuario</label>
            </div>


            <div class="form-floating mb-4">
                <select class="form-select" name="genero_u" id="genero_u" required>
                    <option value="1">Hombre</option>
                    <option value="0">Mujer</option>
                </select>
                <label for="genero_u">Género</label>
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="form-floating mb-4">
                <input type="date" class="form-control" name="fecha_u" id="fecha_u" placeholder="Fecha de Nacimiento" required>
                <label for="fecha_u">Fecha de Nacimiento</label>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script>
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

        function actualizarBarraConfirmar() {
            const password = document.getElementById("confirmar_contraseña_u").value;
            const strengthBar = document.getElementById("password-strength-bar-confirmar");

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

        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }

        function validarFormulario() {
            let valido = true;

            // Obtener los valores
            let nombre = document.getElementById("nombre_u").value;
            let correo = document.getElementById("correo_u").value;
            let telefono = document.getElementById("telefono_u").value;
            let contraseña = document.getElementById("contraseña_u").value;
            let confirmarContraseña = document.getElementById("confirmar_contraseña_u").value;
            let foto = document.getElementById("foto_u").files[0];

            // Expresiones regulares
            let regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
            let regexCorreo = /^[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            let regexTelefono = /^[0-9]+$/;
            let regexContraseña = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            let regexFoto = /\.(jpg|png|bmp)$/i;

            // Limpiar mensajes anteriores
            document.getElementById("error_nombre").textContent = "";
            document.getElementById("error_correo").textContent = "";
            document.getElementById("error_telefono").textContent = "";
            document.getElementById("error_contraseña").textContent = "";
            document.getElementById("error_confirmar_contraseña").textContent = "";
            document.getElementById("error_foto").textContent = "";

            // Validar nombre
            if (!regexNombre.test(nombre)) {
                document.getElementById("error_nombre").textContent = "El nombre solo puede contener letras y espacios.";
                valido = false;
            }

            // Validar correo
            if (!regexCorreo.test(correo)) {
                document.getElementById("error_correo").textContent = "El correo electrónico no es válido.";
                valido = false;
            }

            // Validar teléfono
            if (!regexTelefono.test(telefono)) {
                document.getElementById("error_telefono").textContent = "El teléfono solo puede contener números.";
                valido = false;
            }

            // Validar contraseña
            if (!regexContraseña.test(contraseña)) {
                document.getElementById("error_contraseña").textContent = "La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una minúscula, un número y un carácter especial.";
                valido = false;
            }

            // Validar confirmación de contraseña
            if (contraseña !== confirmarContraseña) {
                document.getElementById("error_confirmar_contraseña").textContent = "Las contraseñas no coinciden.";
                valido = false;
            }

            // Validar foto
            if (foto && !regexFoto.test(foto.name)) {
                document.getElementById("error_foto").textContent = "La foto debe ser en formato JPG, PNG o BMP.";
                valido = false;
            }

            return valido;
        }
    </script>
</body>

</html>