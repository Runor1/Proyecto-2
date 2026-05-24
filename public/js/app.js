
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

    //const filtradas = clases.filter(c => c.diaSemana.toUpperCase() === dia);
    const filtradas = clases.filter(c => c.diaSemana === dia);

    if (filtradas.length === 0) {
        lista.innerHTML = '';
        mensaje.innerHTML = '<p class="text-muted">No hay clases disponibles este día.</p>';
        return;
    }

    mensaje.innerHTML = '';
    lista.innerHTML = filtradas.map(c => `
        <div class="clase-card">
            <div>
                <h5>${c.nombre}</h5>
                <p>${c.descripcion}</p>
                <small>🕐 ${c.horario} | 👥 Cupos: ${c.capacidad}</small>
            </div>
            <button class="btn btn-main" onclick="reservar(${c.id})">
                Reservar
            </button>
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
        cargarClases(document.querySelector('.dia.activo')?.textContent.trim(), document.querySelector('.dia.activo'));
    } else {
        alert(result.error || result.message || 'Error al reservar');
    }
}