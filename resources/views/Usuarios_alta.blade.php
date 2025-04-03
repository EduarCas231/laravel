<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/usuarioAl.css') }}">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h3><i class="fas fa-user-plus"></i> Registro de Usuario</h3>
            <p>Complete el formulario para crear su cuenta</p>
        </div>
        
        <form id="registroForm" action="{{ route('usuarios.registrar') }}" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            @csrf

            <!-- Foto -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-camera"></i>
                    </span>
                    <div class="file-input-container">
                        <input type="file" class="file-input" name="foto_u" id="foto_u" accept=".jpg,.png,.bmp">
                        <label for="foto_u" class="file-input-label">
                            <span id="file-name">Seleccionar foto de perfil</span>
                        </label>
                    </div>
                </div>
                <div class="text-danger" id="error_foto"><i class="fas fa-exclamation-circle"></i></div>
            </div>

            <!-- Nombre -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nombre_u" id="nombre_u" placeholder="Nombre" required>
                        <label for="nombre_u">Nombre completo</label>
                    </div>
                </div>
                <div class="text-danger" id="error_nombre"><i class="fas fa-exclamation-circle"></i></div>
            </div>

            <!-- Correo -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <div class="form-floating">
                        <input type="email" class="form-control" name="correo_u" id="correo_u" placeholder="Correo" required>
                        <label for="correo_u">Correo electrónico</label>
                    </div>
                </div>
                <div class="text-danger" id="error_correo"><i class="fas fa-exclamation-circle"></i></div>
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-lock"></i>
                    </span>
                    <div class="form-floating password-container">
                        <input type="password" class="form-control" name="contraseña_u" id="contraseña_u" placeholder="Contraseña" required oninput="actualizarBarra()">
                        <label for="contraseña_u">Contraseña</label>
                        <button type="button" class="toggle-password" onclick="togglePassword('contraseña_u')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="password-strength-container">
                    <div id="password-strength-bar" class="password-strength"></div>
                </div>
                <div class="password-strength-text" id="password-strength-text"></div>
                <div id="error_contraseña" class="text-danger"><i class="fas fa-exclamation-circle"></i></div>
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-lock"></i>
                    </span>
                    <div class="form-floating password-container">
                        <input type="password" class="form-control" name="contraseña_u_confirmation" id="confirmar_contraseña_u" placeholder="Confirmar Contraseña" required oninput="actualizarBarraConfirmar()">
                        <label for="confirmar_contraseña_u">Confirmar contraseña</label>
                        <button type="button" class="toggle-password" onclick="togglePassword('confirmar_contraseña_u')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="password-strength-container">
                    <div id="password-strength-bar-confirmar" class="password-strength"></div>
                </div>
                <div id="error_confirmar_contraseña" class="text-danger"><i class="fas fa-exclamation-circle"></i></div>
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-phone"></i>
                    </span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="telefono_u" id="telefono_u" placeholder="Teléfono" required>
                        <label for="telefono_u">Teléfono</label>
                    </div>
                </div>
                <div class="text-danger" id="error_telefono"><i class="fas fa-exclamation-circle"></i></div>
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="direccion_u" id="direccion_u" placeholder="Dirección" required>
                        <label for="direccion_u">Dirección</label>
                    </div>
                </div>
            </div>

            <!-- Tipo de Usuario -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-user-tag"></i>
                    </span>
                    <div class="form-floating">
                        <select class="form-select" name="tipo_u" id="tipo_u" required>
                            <option value="" disabled selected>Seleccione tipo</option>
                            <option value="0">Usuario</option>
                        </select>
                        <label for="tipo_u">Tipo de Usuario</label>
                    </div>
                </div>
            </div>

            <!-- Género -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-venus-mars"></i>
                    </span>
                    <div class="form-floating">
                        <select class="form-select" name="genero_u" id="genero_u" required>
                            <option value="1">Hombre</option>
                            <option value="0">Mujer</option>
                        </select>
                        <label for="genero_u">Género</label>
                    </div>
                </div>
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-icon">
                        <i class="fas fa-birthday-cake"></i>
                    </span>
                    <div class="form-floating">
                        <input type="date" class="form-control" name="fecha_u" id="fecha_u" placeholder="Fecha de Nacimiento" required>
                        <label for="fecha_u">Fecha de Nacimiento</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Registrarse
            </button>
        </form>
    </div>

    <script>
        // Mostrar nombre del archivo seleccionado
        document.getElementById('foto_u').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Seleccionar foto de perfil';
            document.getElementById('file-name').textContent = fileName;
        });

        function actualizarBarra() {
            const password = document.getElementById("contraseña_u").value;
            const strengthBar = document.getElementById("password-strength-bar");
            const strengthText = document.getElementById("password-strength-text");
            
            // Reset
            strengthBar.className = "password-strength";
            strengthText.textContent = "";
            
            if (password.length === 0) {
                strengthBar.style.width = "0%";
                return;
            }
            
            if (password.length < 8) {
                strengthBar.classList.add("weak");
                strengthText.textContent = "Débil";
                strengthText.style.color = "#ef4444";
            } else if (password.length <= 10) {
                strengthBar.classList.add("medium");
                strengthText.textContent = "Moderada";
                strengthText.style.color = "#f59e0b";
            } else {
                strengthBar.classList.add("strong");
                strengthText.textContent = "Fuerte";
                strengthText.style.color = "#10b981";
            }
        }

        function actualizarBarraConfirmar() {
            const password = document.getElementById("confirmar_contraseña_u").value;
            const strengthBar = document.getElementById("password-strength-bar-confirmar");
            
            // Reset
            strengthBar.className = "password-strength";
            
            if (password.length === 0) {
                strengthBar.style.width = "0%";
                return;
            }
            
            if (password.length < 8) {
                strengthBar.classList.add("weak");
            } else if (password.length <= 10) {
                strengthBar.classList.add("medium");
            } else {
                strengthBar.classList.add("strong");
            }
        }

        function togglePassword(id) {
            const input = document.getElementById(id);
            const button = input.nextElementSibling.nextElementSibling;
            const icon = button.querySelector('i');
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
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