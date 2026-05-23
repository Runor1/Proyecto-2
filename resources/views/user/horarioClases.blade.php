<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Horario de Clases</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="/css/horarioClases.css">
</head>

<body>

    <div class="container mt-5">

        <nav class="navbar header px-4">

            <div class="d-flex align-items-center">

                <img src="/img/logo.png" class="logo me-2">

                <h4 class="titulo m-0">
                    Horarios de clases
                </h4>

            </div>

            <div class="d-flex">

                <a href="/" class="btn btn-login-neon">
                    Volver
                </a>

            </div>

        </nav>

        <div class="text-center mb-2 subtitulo-dia">
            Escoge un día
        </div>

        <div class="dias text-center mb-4">

            <a href="#"
                class="dia"
                onclick="cargarClases('LUNES', this)">
                LUN
            </a>

            <a href="#"
                class="dia"
                onclick="cargarClases('MARTES', this)">
                MAR
            </a>

            <a href="#"
                class="dia"
                onclick="cargarClases('MIERCOLES', this)">
                MIÉ
            </a>

            <a href="#"
                class="dia"
                onclick="cargarClases('JUEVES', this)">
                JUE
            </a>

            <a href="#"
                class="dia"
                onclick="cargarClases('VIERNES', this)">
                VIE
            </a>

            <a href="#"
                class="dia"
                onclick="cargarClases('SABADO', this)">
                SÁB
            </a>

            <a href="#"
                class="dia"
                onclick="cargarClases('DOMINGO', this)">
                DOM
            </a>

        </div>

        <div class="lista-clases" id="listaClases">

            <!-- Clases cargadas con JavaScript -->

        </div>

        <div class="text-center mt-4" id="mensajeVacio"></div>

    </div>

    <footer class="footer mt-5 py-4 text-center">

        <div class="container">

            <img src="/img/logo.png"
                alt="Logo"
                width="120"
                class="mb-2">

            <p class="mb-1">
                © 2026 VIKINGS
            </p>

            <p class="mb-0 small">
                Todos los derechos reservados
            </p>

        </div>

    </footer>



</body>
<script src="/js/app.js"></script>
<script>
    requireAuth()
</script>

</html>