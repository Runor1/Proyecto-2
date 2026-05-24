<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/formularioVikingNuevo.css') }}">
</head>

<body>

    <br><br><br>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 registro-card">

            <div class="text-center mb-3">
                <h3 class="fw-bold titulo">Datos de usuario</h3>
            </div>

            <form id="registro">

                <input type="hidden" id="idUsuario" name="idUsuario">

                <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre" required>

                <input type="text" name="apellidoUno" class="form-control mb-3" placeholder="Primer apellido" required>

                <input type="text" name="apellidoDos" class="form-control mb-3" placeholder="Segundo apellido" required>

                <input type="tel" name="telefono" class="form-control mb-3" placeholder="Teléfono" required>

                <input type="email" name="email" class="form-control mb-3" placeholder="Correo electrónico" required>

                <div class="text-center mb-3">
                    <h3 class="fw-bold titulo">Registro de usuario</h3>
                </div>

                <input type="text" id="username" name="username"
                    class="form-control mb-1" placeholder="Usuario" required>

                <div id="usernameError" class="text-danger mb-3" style="display:none;">
                    El usuario ya existe
                </div>

                <input type="password" name="password"
                    class="form-control mb-3" placeholder="Contraseña">

                <button class="btn btn-main w-100">
                    Crear usuario
                </button>

                <div class="text-center mb-4">
                    <br>
                    <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo">
                </div>

            </form>

        </div>
    </div>
    <script src="/js/app.js"></script>
    <script src="/js/registro.js"></script>
</body>

</html>