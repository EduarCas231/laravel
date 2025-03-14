<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="icon" href="{{ url('img/bitelogo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/usuarioAL.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-primary">Registro de Usuario</h3>
        <form id="registroForm" action="{{ route('usert.registrar') }}" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
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

            <!-- Dirección -->
            <div class="form-floating mb-4">
                <input type="text" class="form-control" name="direccion_u" id="direccion_u" placeholder="Dirección" required>
                <label for="direccion_u">Dirección</label>
            </div>

            <!-- Estado -->
            <div class="form-floating mb-4">
                <select class="form-select" name="estado_u" id="estado_u" required onchange="actualizarMunicipios()">
                    <option value="">Selecciona un estado</option>
                    <option value="México">México</option>
                    <option value="Ciudad de México">Ciudad de México</option>
                    <option value="Querétaro">Querétaro</option>
                </select>
                <label for="estado_u">Estado</label>
            </div>

            <!-- Municipio -->
            <div class="form-floating mb-4">
                <select class="form-select" name="municipio_u" id="municipio_u" required>
                    <option value="">Selecciona un municipio</option>
                </select>
                <label for="municipio_u">Municipio</label>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <script>
        // Objeto con los municipios por estado
        const municipiosPorEstado = {
            "México": ["Toluca", "Zinacantepec", "Lerma", "Atarasquillo", "Metepec"],
            "Ciudad de México": ["Álvaro Obregón", "Azcapotzalco", "Benito Juárez", "Coyoacán", "Gustavo A. Madero"],
            "Querétaro": ["Querétaro", "El Marqués", "Corregidora", "San Juan del Río", "Tequisquiapan"]
        };

        // Función para actualizar los municipios según el estado seleccionado
        function actualizarMunicipios() {
            const estadoSelect = document.getElementById('estado_u');
            const municipioSelect = document.getElementById('municipio_u');
            const estadoSeleccionado = estadoSelect.value;

            // Limpiar el select de municipios
            municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';

            // Obtener los municipios del estado seleccionado
            const municipios = municipiosPorEstado[estadoSeleccionado];

            // Llenar el select de municipios
            if (municipios) {
                municipios.forEach(municipio => {
                    const option = document.createElement('option');
                    option.value = municipio;
                    option.textContent = municipio;
                    municipioSelect.appendChild(option);
                });
            }
        }

        // Llamar a la función al cargar la página para llenar los municipios iniciales (opcional)
        document.addEventListener('DOMContentLoaded', () => {
            actualizarMunicipios(); // Esto asegura que el select de municipios esté vacío al inicio
        });
    </script>
</body>

</html>