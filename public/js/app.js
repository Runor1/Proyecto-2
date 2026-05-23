
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
    document.addEventListener("DOMContentLoaded", async () => {

        const response = await authFetch("/api/usuarios/me");

        if (!response.ok) return;

        const usuario = await response.json();

        const nombreCompleto = `${usuario.nombre} ${usuario.apellidoUno}`;

        const elemento = document.getElementById("nombreUsuario");

        const ruta = window.location.pathname;

        if (ruta.includes("inicio")) {
            elemento.textContent = `¡Hola, ${nombreCompleto}! 👋`;
        }

        else if (ruta.includes("historial")) {
            elemento.textContent = `Historial de ${nombreCompleto}`;
        }

        else {
            elemento.textContent = nombreCompleto;
        }
    });
}