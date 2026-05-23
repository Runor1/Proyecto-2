<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/usuarios.css">

    <style>
        .filtro-activo {
            background-color: white !important;
            color: black !important;
        }
    </style>
</head>

<body>

    <nav class="navbar header px-4">
        <div class="d-flex align-items-center">
            <img src="/img/logo.png" class="logo me-2">
            <h4 class="titulo m-0">Administración de Reservas</h4>
        </div>

        <div class="d-flex gap-2">
            <a href="/admin" class="btn btn-login-neon">Volver</a>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="text-center mb-4">
            <h2 class="titulo">Lista de Reservas</h2>
            <p class="subtitulo">Visualiza, cancela o elimina reservas</p>
        </div>

        <div class="mb-4 d-flex gap-2 justify-content-center flex-wrap">
            <button class="btn btn-outline-light filtro-btn"
                onclick="filtrar('', this)">
                Todas
            </button>

            <button class="btn btn-outline-success filtro-btn"
                onclick="filtrar('ACTIVA', this)">
                Activas
            </button>

            <button class="btn btn-outline-warning filtro-btn"
                onclick="filtrar('CANCELADA', this)">
                Canceladas
            </button>

            <button class="btn btn-outline-info filtro-btn"
                onclick="filtrar('FINALIZADA', this)">
                Finalizadas
            </button>
        </div>

        <div class="registro-card p-4">

            <table class="table table-dark table-hover text-center align-middle">

                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Clase</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="tbodyReservas">

                    <!-- Reservas cargadas con JavaScript -->

                </tbody>

            </table>

        </div>

    </div>

    <script>
        let todasReservas = [];

        async function cargarReservas() {
            const token = localStorage.getItem('token');
            const response = await fetch('/api/reservas', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });
            todasReservas = await response.json();
            renderizar(todasReservas);
        }

        function renderizar(reservas) {
            const tbody = document.getElementById('tbodyReservas');
            tbody.innerHTML = '';
            reservas.forEach(r => {
                tbody.innerHTML += `
                <tr>
                    <td>${r.user ? r.user.name : r.user_id}</td>
                    <td>${r.clase ? r.clase.nombre : r.clase_id}</td>
                    <td>${r.fechaReserva}</td>
                    <td>${r.estado}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" onclick="cancelarReserva(${r.id})">Cancelar</button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarReserva(${r.id})">Eliminar</button>
                    </td>
                </tr>`;
            });
        }

        function filtrar(estado, btn) {
            document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('filtro-activo'));
            btn.classList.add('filtro-activo');
            if (estado === '') {
                renderizar(todasReservas);
            } else {
                renderizar(todasReservas.filter(r => r.estado === estado));
            }
        }

        async function cancelarReserva(id) {
            if (!confirm('¿Cancelar esta reserva?')) return;
            const token = localStorage.getItem('token');
            await fetch('/api/reservas/' + id + '/cancelar', {
                method: 'PATCH',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });
            cargarReservas();
        }

        async function eliminarReserva(id) {
            if (!confirm('¿Eliminar esta reserva?')) return;
            const token = localStorage.getItem('token');
            await fetch('/api/reservas/' + id, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });
            cargarReservas();
        }

        cargarReservas();
    </script>

</body>
<script src="/js/app.js"></script>
<script>requireAuth() </script>

</html>