<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Iniciar Sesión</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <div class="container">
        <img src="{{ url('img/bitelogo.png') }}" alt="Logo" class="logo">
        <h3>Iniciar Sesión</h3>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-floating mb-4">
                <input type="email" class="form-control" name="correo_u" placeholder="Correo" required>
                <label for="correo_u">Correo</label>
            </div>
           <div class="form-floating mb-4">
    <input type="password" class="form-control" id="contraseña_u" name="contraseña_u" placeholder="Contraseña" required>
    <label for="contraseña_u">Contraseña</label>
    <i class="fas fa-eye" id="toggle-password" style="position: absolute; top: 35%; right: 10px; cursor: pointer;"></i>
</div>

            <button type="submit" class="cta">
                <span>Iniciar Sesión</span>
                <svg width="13px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
            <br><br>
            <a href="{{ route('usuarios.alta') }}" class="cta cta1">
                <span>Nuevo Registro de Usuario</span>
                <i class="fas fa-plus" style="margin-left: 10px;"></i>
            </a>
        </form>
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
    <footer>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100008169402961" target="_blank">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.whatsapp.com" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://twitter.com" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
        </div>
        <p class="mt-3">&copy; 2024 Cuervocura. Todos los derechos reservados.</p>
        <p>Create by Eduardo Casimiro G.</p>
    </footer>
    <script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        const passwordField = document.getElementById('contraseña_u');
        const passwordFieldType = passwordField.type;

        if (passwordFieldType === 'password') {
            passwordField.type = 'text';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>
