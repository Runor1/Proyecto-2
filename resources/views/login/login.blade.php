<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="card shadow-lg p-4 rounded-4" style="width: 350px;">

            <div class="text-center mb-4">
                <h3 class="fw-bold titulo">Bienvenido Viking</h3>
            </div>

            <form id="loginForm">

                <div class="form-floating mb-3">
                    <input type="text" id="username" class="form-control" placeholder="Usuario" required>
                    <label>Usuario</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" id="password" class="form-control" placeholder="Contraseña" required>
                    <label>Contraseña</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-3">
                        Iniciar sesión
                    </button>

                    <div class="text-center mt-3">
                        <span>¿No tienes cuenta?</span>
                        <a href="/registro" class="link-light fw-bold">Crear cuenta</a>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <br>
                    <img src="/img/logo.png" alt="logo" class="logo">

                </div>

            </form>

        </div>

    </div>
</body>

</html>