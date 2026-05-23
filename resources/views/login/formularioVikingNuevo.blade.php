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
    <script>
        document.getElementById('registro').addEventListener('submit', async function(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const data = {
                name: document.querySelector('[name=nombre]').value,
                apellidoUno: document.querySelector('[name=apellidoUno]').value,
                apellidoDos: document.querySelector('[name=apellidoDos]').value,
                telefono: document.querySelector('[name=telefono]').value,
                email: document.querySelector('[name=email]').value,
                username: document.querySelector('[name=username]').value,
                password: document.querySelector('[name=password]').value,
                rol_id: 1,
            };
            try {
                const response = await fetch('/api/usuarios', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (response.ok) {
                    alert('Usuario creado correctamente');
                    window.location.href = isAdmin() ? "/usuariosVista" : "/";
                } else {
                    alert(result.message || 'Error al crear el usuario');
                }
            } catch (error) {
                console.log(error);
            }
        });
    </script>
</body>

</html>