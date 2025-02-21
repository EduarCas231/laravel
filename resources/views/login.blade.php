<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Iniciar Sesión</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
    --background-color: #ffffff;
    --text-color: #000080;
    --container-bg: rgba(240, 248, 255, 0.9);
    --input-bg: #f0f8ff;
    --input-focus-bg: #e6f0ff;
    --button-bg: #0000ff;
    --button-hover-bg: #0000cc;
    --button-text-color: #ffffff;
    --alert-color: #ff0000;
    --footer-text-color: #000080;
    --border-color: #0000ff;
}

@media (prefers-color-scheme: dark) {
    :root {
        --background-color: #001f3f;
        --text-color: #ffffff;
        --container-bg: rgba(0, 51, 102, 0.9);
        --input-bg: #003366;
        --input-focus-bg: #004080;
        --button-bg: #0055ff;
        --button-hover-bg: #0040cc;
        --button-text-color: #ffffff;
        --alert-color: #ff3333;
        --footer-text-color: #ffffff;
        --border-color: #0055ff;
    }
}


        body {
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .container {
            background-color: var(--container-bg);
            border: 2px solid var(--border-color);
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            width: 400px;
            padding: 20px;
            text-align: center;
        }

        .logo {
            width: 50%;
            max-width: 200px;
            height: auto;
            border-radius: 10%;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h3 {
            color: var(--text-color);
        }

        .alert {
            color: var(--alert-color);
        }

        footer {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .social-icons a {
            color: var(--footer-text-color);
            margin: 0 10px;
            font-size: 24px;
            text-decoration: none;
        }

        .form-control {
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: var(--input-focus-bg);
            color: var(--text-color);
        }

        label {
            color: var(--text-color);
        }

        .cta {
            position: relative;
            margin: auto;
            padding: 19px 22px;
            transition: all 0.2s ease;
            background-color: var(--button-bg);
            color: var(--button-text-color);
            border: 2px solid var(--border-color);
            border-radius: 28px;
            display: inline-flex;
            align-items: center;
        }

        .cta:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            border-radius: 28px;
            background: rgba(232, 233, 236, 0.5);
            width: 56px;
            height: 56px;
            transition: all 0.3s ease;
        }

        .cta span {
            position: relative;
            font-size: 16px;
            line-height: 18px;
            font-weight: 900;
            letter-spacing: 0.25em;
            text-transform: uppercase;
        }

        .cta:hover:before {
            width: 100%;
            background: rgba(69, 121, 171, 0.5);
        }

        .cta:hover svg {
            transform: translateX(0);
        }

        .cta:active {
            transform: scale(0.96);
        }

        .cta1 {
            margin-top: 20px;
        }

        .cta1 svg {
            margin-left: 10px;
        }
    </style>
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
