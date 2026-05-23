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
                onclick="window.location.href='/formulario'">

                + Crear Usuario

            </button>

            <a href="/admin"
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

    <script>
        async function cargarUsuarios() {
            const token = localStorage.getItem('token');
            const response = await fetch('/api/usuarios', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });
            const usuarios = await response.json();
            const tbody = document.getElementById('tbodyUsuarios');
            tbody.innerHTML = '';
            usuarios.forEach(u => {
                tbody.innerHTML += `
                <tr>
                    <td>${u.name}</td>
                    <td>${u.apellidoUno} ${u.apellidoDos}</td>
                    <td>${u.email}</td>
                    <td>${u.telefono}</td>
                    <td>${u.username}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="eliminarUsuario(${u.id})">Eliminar</button>
                    </td>
                </tr>`;
            });
        }

        async function eliminarUsuario(id) {
            if (!confirm('¿Eliminar este usuario?')) return;
            const token = localStorage.getItem('token');
            await fetch('/api/usuarios/' + id, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });
            cargarUsuarios();
        }

        cargarUsuarios();
    </script>

</body>

<script src="/js/app.js"></script>

<script> requireAdmin();</script>

</html>