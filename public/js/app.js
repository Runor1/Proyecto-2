
function getToken() {
    return localStorage.getItem("token");
}

function setToken(token) {
    localStorage.setItem("token", token);
}



function parseJwt(token) {
    try {
        return JSON.parse(atob(token.split('.')[1]));
    } catch (e) {
        return null;
    }
}

function isAuthenticated() {
    const token = getToken();
    return !!token;
}

function getPayload() {
    const token = getToken();
    if (!token) return null;
    return parseJwt(token);
}

function getRolId() {
    return localStorage.getItem("rol_id");
}

function isAdmin() {
    return getRolId() == "2";
}

function isUser() {
    return getRolId() == "1";
}


function requireAuth() {
    if (!isAuthenticated()) {
        window.location.href = "/";
    }
}

function requireAdmin() {
    requireAuth();

    if (!isAdmin()) {
        alert("⛔ No tienes permisos de ADMIN");
        window.location.href = "/";
    }
}

function logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('rol_id');
    localStorage.removeItem('username');
    localStorage.removeItem('user_id');
    window.location.href = '/';
}

function authFetch(url, options = {}) {
    const token = getToken();

    const headers = {
        "Content-Type": "application/json",
        ...(options.headers || {}),
        ...(token && { "Authorization": "Bearer " + token })
    };

    return fetch(url, {
        ...options,
        headers
    }).then(res => {

        if (res.status === 401) {
            alert("Sesión expirada");
            logout();
            return;
        }

        if (res.status === 403) {
            throw new Error("Forbidden");
        }

        return res;
    });
}
function getNombre() {

    const username = localStorage.getItem("username");

    const elemento = document.getElementById("nombreUsuario");

    if (!username || !elemento) return;

    const ruta = window.location.pathname;

    if (ruta.includes("inicio") || ruta === "/") {

        elemento.textContent = `¡Hola, ${username}! 👋`;

    } else if (ruta.includes("historial")) {

        elemento.textContent = `Historial de ${username}`;

    } else {

        elemento.textContent = username;

    }
}

async function cargarClases(dia, el) {
    document.querySelectorAll('.dia').forEach(d => d.classList.remove('activo'));
    el.classList.add('activo');

    const response = await authFetch('/api/clases');
    const clases = await response.json();
    const lista = document.getElementById('listaClases');
    const mensaje = document.getElementById('mensajeVacio');
    const filtradas = clases.filter(c => c.diaSemana === dia);

    if (filtradas.length === 0) {
        lista.innerHTML = '';
        mensaje.innerHTML = '<p class="text-muted">No hay clases disponibles este día.</p>';
        return;
    }

    mensaje.innerHTML = '';
    lista.innerHTML = filtradas.map(c => `
    <div class="clase-item">

        <div class="hora">
            ${c.horario}
        </div>

        <div class="info">
            <div class="nombre">${c.nombre}</div>
        </div>

        <a href="/reservas/${c.id}" class="btn-mas">
            Más
        </a>

    </div>
`).join('');
}

async function reservar(claseId) {
    const userId = localStorage.getItem('user_id');
    const response = await authFetch('/api/reservas', {
        method: 'POST',
        body: JSON.stringify({
            user_id: userId,
            clase_id: claseId,
            fechaReserva: new Date().toISOString().split('T')[0]
        })
    });
    const result = await response.json();
    if (response.ok) {
        alert('¡Reserva realizada correctamente!');
        window.location.href = "/horarioClases";
        cargarClases(document.querySelector('.dia.activo')?.textContent.trim(), document.querySelector('.dia.activo'));
    } else {
        alert(result.error || result.message || 'Error al reservar');
    }
}


async function cargarHistorial() {
    const userId = localStorage.getItem('user_id');
    const response = await authFetch('/api/reservas');
    const reservas = await response.json();
    const misReservas = reservas.filter(r => r.user_id == parseInt(userId));

    const tbody = document.getElementById('tablaHistorial');
    tbody.innerHTML = '';

    if (misReservas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5">No tenés reservas aún.</td></tr>';
        return;
    }

    misReservas.forEach(r => {
        tbody.innerHTML += `
                <tr>
                    <td>${r.clase ? r.clase.nombre : r.clase_id}</td>
                    <td>${r.clase ? r.clase.capacidad : '-'}</td>
                    <td>${r.fechaReserva}</td>
                    <td>${r.clase ? r.clase.horario : '-'}</td>
                    <td>${r.estado}</td>
                </tr>`;
    });
}

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
