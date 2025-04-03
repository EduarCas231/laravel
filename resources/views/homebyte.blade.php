<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - ByteLab</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                            <a class="nav-link active" href="{{ route('homebyte') }}">
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
                            <a class="nav-link" href="{{ route('accesos') }}">
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
    <div class="container mt-4">
        <div class="content-wrapper">
            <div class="text-content">
                <h3 class="text-primary"><i class="fas fa-book me-2"></i>Antecedentes de la organización</h3>
                <p>ByteLab es una empresa relativamente nueva, conformada por ingenieros, diseñadores y expertos en ciberseguridad con experiencia en el desarrollo de hardware y software de vanguardia. Nuestro equipo combina conocimientos técnicos avanzados con una pasión por la innovación tecnológica.</p>

                <h3 class="text-primary mt-4"><i class="fas fa-bullseye me-2"></i>Misión, Visión y Objetivos</h3>
                
                <div class="mission-card">
                    <h4 class="text-info"><i class="fas fa-flag me-2"></i>Misión:</h4>
                    <p>En ByteLab, nuestra misión es diseñar y desarrollar soluciones innovadoras en tecnología que impacten positivamente la vida de nuestros usuarios y contribuyan al progreso de la industria. Nos comprometemos a ofrecer productos de calidad que superen las expectativas de nuestros clientes.</p>
                </div>
                
                <div class="vision-card">
                    <h4 class="text-info"><i class="fas fa-eye me-2"></i>Visión:</h4>
                    <p>Buscamos posicionarnos como una empresa líder en el mercado regional y nacional, ofreciendo productos y servicios de la más alta calidad, asegurando la satisfacción total de nuestros clientes mediante la excelencia en el desarrollo tecnológico y la atención personalizada.</p>
                </div>
            </div>

            <div class="img-container">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHNQI3Rvnus787ysGvS4SP3sBBWqCmLnNa4w&s" alt="Descripción de la imagen">
                <p class="img-caption text-muted mt-2">Nuestro equipo de desarrollo en acción</p>
            </div>
        </div>

        <!-- Secciones desplegables -->
        <div class="accordion-section mt-5">
            <div class="accordion-item">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProducts">
                    <i class="fas fa-box-open me-2"></i>Productos y Servicios
                </button>
                <div id="collapseProducts" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <p>En ByteLab, ofrecemos una amplia gama de productos tecnológicos diseñados para mejorar la eficiencia en los procesos industriales y personales:</p>
                        <ul>
                            <li>Dispositivos IoT para automatización</li>
                            <li>Soluciones de ciberseguridad empresarial</li>
                            <li>Software de gestión personalizado</li>
                            <li>Equipos de hardware especializado</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContact">
                    <i class="fas fa-envelope me-2"></i>Contacto
                </button>
                <div id="collapseContact" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <p>Para más información, no dude en ponerse en contacto con nosotros a través de nuestros canales oficiales:</p>
                        <ul class="contact-list">
                            <li><i class="fas fa-phone me-2"></i> Teléfono: +123 456 7890</li>
                            <li><i class="fas fa-envelope me-2"></i> Email: info@bytelab.com</li>
                            <li><i class="fas fa-map-marker-alt me-2"></i> Dirección: Av. Tecnológica 123, Ciudad</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
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
</body>

</html>