<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Bytelab</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">



</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="{{ url('img/bitelogo.png') }}" alt="Logo" width="45">
                ByteLab
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" id="offcanvasDarkNavbar" tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('homebyte') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('productos') }}">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('usuarios') }}">Usuarios</a></li>
			<li class="nav-item"><a class="nav-link" href="{{ route('accesos') }}">Accesos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="content-wrapper">
            <div class="text-content">
                <h3>Antecedentes de la organización</h3>
                <p>Bytelab es una empresa relativamente nueva, conformada por ingenieros, diseñadores y expertos en ciberseguridad con experiencia en el desarrollo de hardware y software de vanguardia...</p>

                <h3>Misión, Visión y Objetivos de la Organización</h3>
                <h4>Misión:</h4>
                <p>En Bytelab, nuestra misión es diseñar y desarrollar soluciones innovadoras en tecnología que impacten positivamente la vida de nuestros usuarios y contribuyan al progreso de la industria...</p>

                <h4>Visión:</h4>
                <p>Buscamos posicionarnos como una empresa líder en el mercado regional y nacional, ofreciendo productos y servicios de la más alta calidad, asegurando la satisfacción total de nuestros clientes...</p>
            </div>

            <div class="img1">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHNQI3Rvnus787ysGvS4SP3sBBWqCmLnNa4w&s" alt="Descripción de la imagen">
            </div>
        </div>

        <div class="index-section">
            <p class="collapse-link" onclick="toggleCollapse('productos')">Productos y Servicios</p>
            <div class="collapse-content" id="productos">
                <p>En Bytelab, ofrecemos una amplia gama de productos tecnológicos diseñados para mejorar la eficiencia en los procesos industriales y personales. Nuestros productos incluyen...</p>
            </div>
        </div>

        <div class="index-section">
            <p class="collapse-link" onclick="toggleCollapse('contacto')">Contacto</p>
            <div class="collapse-content" id="contacto">
                <p>Para más información, no dude en ponerse en contacto con nosotros a través de nuestros canales oficiales. Estamos siempre dispuestos a ayudar...</p>
            </div>
        </div>

    </div>

    <footer class="text-center">
        <div class="container">
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.whatsapp.com" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
            </div>
            <p class="mt-3">&copy; 2024 ByteLab. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleCollapse(id) {
            var element = document.getElementById(id);
            element.classList.toggle('active');
        }
    </script>

</body>

</html>
