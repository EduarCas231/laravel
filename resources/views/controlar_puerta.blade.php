<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controlar Puerta - ByteLab</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Variables de color */
        :root {
            --background-color: #1a1a1a;
            --text-color: #e0e0e0;
            --primary-color: #436fb1;
            --primary-hover: #365a8c;
            --footer-bg: #121212;
            --footer-text: #436fb1;
            --card-bg: #2c2c2c;
            --accordion-bg: #252525;
            --success-color: #2ecc71;
            --success-hover: #27ae60;
            --danger-color: #e74c3c;
            --danger-hover: #c0392b;
        }

        /* Estilos Base */
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            padding-top: 70px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Navbar mejorada */
        .navbar {
            background-color: var(--footer-bg) !important;
            border-bottom: 2px solid var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .navbar-brand img {
            width: 35px;
            height: 35px;
            transition: transform 0.3s;
        }

        .navbar-brand:hover img {
            transform: rotate(15deg);
        }

        .nav-link {
            color: var(--text-color) !important;
            padding: 8px 15px !important;
            border-radius: 5px;
            margin: 0 2px;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(67, 111, 177, 0.2);
            color: var(--primary-color) !important;
        }

        /* Contenedor principal */
        .main-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            background-color: var(--card-bg);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 1px solid var(--primary-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .main-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        h2 {
            text-align: center;
            margin-top: 0;
            color: var(--primary-color);
            font-size: 2.2rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
            letter-spacing: 0.5px;
            min-width: 180px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        #mensaje {
            margin: 25px 0;
            text-align: center;
            font-size: 18px;
            min-height: 27px;
        }

        #mensaje p {
            font-weight: bold;
            padding: 12px;
            border-radius: 6px;
            background-color: var(--accordion-bg);
            border-left: 4px solid var(--primary-color);
        }

        #regresarBtn {
            background-color: var(--success-color);
            display: block;
            width: 100%;
            margin: 20px auto 0;
            padding: 12px;
        }

        #regresarBtn:hover {
            background-color: var(--success-hover);
        }

        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        #abrirPuerta {
            background-color: var(--success-color);
        }

        #abrirPuerta:hover {
            background-color: var(--success-hover);
        }

        #cerrarPuerta {
            background-color: var(--danger-color);
        }

        #cerrarPuerta:hover {
            background-color: var(--danger-hover);
        }

        /* Footer */
        .footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 25px 0;
            border-top: 1px solid var(--primary-color);
            margin-top: 40px;
        }

        .social-icons a {
            color: var(--footer-text);
            font-size: 1.25rem;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            color: var(--primary-hover);
            transform: translateY(-3px);
        }

        /* Media Queries para móviles */
        @media (max-width: 768px) {
            .navbar-brand span {
                display: none;
            }
            
            .main-container {
                padding: 20px;
                width: 95%;
            }
            
            .btn-container {
                flex-direction: column;
                align-items: center;
            }
            
            button {
                width: 100%;
                margin: 5px 0;
            }
            
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Barra de Navegación Mejorada -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('homebyte') }}">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" class="me-2">
                <span class="d-none d-sm-inline">ByteLab</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" id="offcanvasNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title"><i class="fas fa-bars me-2"></i>Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('homebyte') }}">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos') }}">
                                <i class="fas fa-box me-2"></i>Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios') }}">
                                <i class="fas fa-users me-2"></i>Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('accesos') }}">
                                <i class="fas fa-key me-2"></i>Accesos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ms-auto">
                @if(auth()->check())
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </button>
                </form>
                @endif
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="main-container">
        <h2>Control de Puerta</h2>

        <!-- Botones para abrir y cerrar la puerta -->
        <div class="btn-container">
            <button id="abrirPuerta"><i class="fas fa-door-open me-2"></i>Abrir Puerta</button>
            <button id="cerrarPuerta"><i class="fas fa-door-closed me-2"></i>Cerrar Puerta</button>
        </div>

        <!-- Mensaje para mostrar el estado de la puerta -->
        <div id="mensaje"></div>

        <!-- Botón para regresar a la página de accesos -->
        <a href="{{ route('accesos') }}">
            <button id="regresarBtn"><i class="fas fa-arrow-left me-2"></i>Regresar a Accesos</button>
        </a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <div class="social-icons mb-3">
                <a href="https://www.facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-x-twitter"></i></a>
            </div>
            <p class="mb-0">&copy; 2024 ByteLab. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Obtener el token CSRF desde la meta etiqueta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Acción para abrir la puerta
            $('#abrirPuerta').click(function () {
                controlarPuerta('abrir');
            });

            // Acción para cerrar la puerta
            $('#cerrarPuerta').click(function () {
                controlarPuerta('cerrar');
            });

            // Función para controlar la puerta
            function controlarPuerta(accion) {
                $.ajax({
                    url: "{{ route('controlar.puerta') }}",  // Ruta definida en el controlador
                    type: 'POST',
                    data: {
                        _token: csrfToken,  // Agregar el token CSRF
                        accion: accion  // Solo se pasa la acción ('abrir' o 'cerrar')
                    },
                    success: function (response) {
                        $('#mensaje').html('<p style="color: var(--success-color);">' + response.message + '</p>');
                    },
                    error: function (xhr) {
                        $('#mensaje').html('<p style="color: var(--danger-color);">Error: ' + xhr.responseText + '</p>');
                    }
                });
            }
        });
    </script>
</body>

</html>