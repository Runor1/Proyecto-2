<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="/css/usuarios.css">
</head>

<body>

    <nav class="navbar header px-4">

        <div class="d-flex align-items-center">

            <img src="/img/logo.png"
                class="logo me-2">

            <h4 class="titulo m-0">
                Administración de Usuarios
            </h4>

        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-main"
                onclick="window.location.href='/registro'">

                + Crear Usuario

            </button>

            <a href="/adminDashboard"
                class="btn btn-login-neon">

                Volver

            </a>

        </div>

    </nav>

    <div class="container mt-5">

        <div class="text-center mb-4">

            <h2 class="titulo">
                Lista de Usuarios
            </h2>

            <p class="subtitulo">
                Administra los usuarios del sistema
            </p>

        </div>

        <div class="registro-card p-4">

            <table class="table table-dark table-hover text-center align-middle">

                <thead>

                    <tr>

                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Usuario</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody id="tbodyUsuarios">

                    <!-- Usuarios cargados con JavaScript -->

                </tbody>

            </table>

        </div>

    </div>

    

</body>

</html>