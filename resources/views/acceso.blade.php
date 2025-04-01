<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Accesos - ByteLab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #436fb1;
            --dark-bg: #1a1a1a;
            --light-text: #f8f9fa;
            --hover-color: #365a8c;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
            color: #212529;
        }

        .main-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
        }

        .access-table {
            width: 100%;
            margin: 20px auto;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        .access-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: 500;
        }

        .access-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }

        .access-table tr:last-child td {
            border-bottom: none;
        }

        .access-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .access-table tr:hover {
            background-color: #e9ecef;
        }

        .permitido {
            color: var(--success-color);
            font-weight: 600;
        }

        .denegado {
            color: var(--danger-color);
            font-weight: 600;
        }

        .nuevo-registro {
            background-color: rgba(255, 193, 7, 0.2);
            animation: resaltar 3s ease-out;
        }

        @keyframes resaltar {
            0% { background-color: rgba(255, 193, 7, 0.4); }
            100% { background-color: transparent; }
        }

        /* Navbar personalizado */
        .navbar-custom {
            background-color: var(--dark-bg) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand-custom {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white !important;
        }

        .navbar-brand-custom img {
            transition: transform 0.3s ease;
        }

        .navbar-brand-custom:hover img {
            transform: rotate(15deg);
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link-custom:hover, 
        .nav-link-custom.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .btn-logout-custom {
            background-color: var(--danger-color);
            border: none;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-logout-custom:hover {
            background-color: #bb2d3b;
            transform: translateY(-1px);
        }

        /* Offcanvas personalizado */
        .offcanvas-custom {
            background-color: #2c3e50 !important;
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 15px;
            }
            
            h1 {
                font-size: 1.8rem;
                margin-bottom: 20px;
            }
            
            .access-table th, 
            .access-table td {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand navbar-brand-custom" href="{{ route('productos') }}">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" width="45">
                ByteLab
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end offcanvas-custom" id="offcanvasNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('homebyte') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('productos') }}">Productos</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('usuarios') }}">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom active" href="{{ route('accesos') }}">Accesos</a></li>
                    </ul>
                </div>
            </div>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout-custom">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="main-container">
        <h1><i class="fas fa-door-open me-2"></i>Registro de Accesos</h1>
        
        <div class="table-responsive">
            <table class="access-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-tasks me-2"></i>Acción</th>
                        <th><i class="fas fa-clock me-2"></i>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody id="tabla-accesos">
                    @foreach ($accesos as $acceso)
                        <tr>
                            <td class="{{ $acceso->accion == 'acceso permitido' ? 'permitido' : 'denegado' }}">
                                <i class="fas {{ $acceso->accion == 'acceso permitido' ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                                {{ ucfirst($acceso->accion) }}
                            </td>
                            <td>{{ $acceso->fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let ultimaFecha = "{{ $accesos->first()->fecha ?? '' }}";

        function actualizarAccesos() {
            fetch('/accesos' + (ultimaFecha ? `?ultima_fecha=${encodeURIComponent(ultimaFecha)}` : ''), {
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Error en la respuesta');
                return response.json();
            })
            .then(data => {
                if (data.length > 0) {
                    let tbody = document.getElementById("tabla-accesos");
                    
                    data.forEach(acceso => {
                        let fila = document.createElement("tr");
                        fila.classList.add("nuevo-registro");
                        
                        let icono = acceso.accion === "acceso permitido" ? 
                            '<i class="fas fa-check-circle me-2"></i>' : 
                            '<i class="fas fa-times-circle me-2"></i>';
                        
                        fila.innerHTML = `
                            <td class="${acceso.accion === "acceso permitido" ? "permitido" : "denegado"}">
                                ${icono}${acceso.accion.charAt(0).toUpperCase() + acceso.accion.slice(1)}
                            </td>
                            <td>${acceso.fecha}</td>
                        `;
                        
                        tbody.insertBefore(fila, tbody.firstChild);
                    });

                    ultimaFecha = data[0].fecha;
                }

                setTimeout(actualizarAccesos, 5000);
            })
            .catch(error => {
                console.error("Error al obtener los accesos:", error);
                setTimeout(actualizarAccesos, 10000); // Reintentar después de 10 segundos si hay error
            });
        }

        actualizarAccesos();
    });
    </script>
</body>
</html>
