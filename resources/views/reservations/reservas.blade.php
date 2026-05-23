<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reserva</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="/css/reservas.css">
</head>

<body>

    <div class="container-fluid px-5">

        <header class="header d-flex justify-content-between align-items-center py-3">

            <img src="/img/logo.png" class="logo-header">

            <a href="/horarioClases"
                class="btn btn-login-neon">
                Volver
            </a>

        </header>

        <div class="card reserva-detalle p-4">

            <h2 class="text-center mb-4 titulo">
                Reserva tu espacio
            </h2>

            <div class="row">

                <div class="col-md-5">

                    <img src="/img/reserva.png"
                        class="img-fluid rounded">

                </div>

                <div class="col-md-7" id="detalleClase">

                    <!-- Información cargada con JavaScript -->

                </div>

            </div>

        </div>

    </div>

    <footer class="footer mt-5 py-4 text-center">

        <div class="container">

            <img src="/img/logo.png"
                width="120"
                class="mb-2">

            <p>
                © 2026 VIKINGS
            </p>

        </div>

    </footer>



</body>

<script src="/js/app.js"></script>
<script>
    requireAuth()
</script>

</html>