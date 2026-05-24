const container = document.getElementById("authButtons");

if (isAuthenticated()) {
    if (isAdmin()) {
        container.innerHTML = `
            <ul class="nav nav-tabs custom-nav">
                <li class="nav-item"><a class="nav-link active" href="/horarioClases">Clases</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
                <li class="nav-item"><button class="nav-link btn-logout" onclick="logout()">Salir</button></li>
            </ul>`;
    } else if (isUser()) {
        container.innerHTML = `
            <ul class="nav nav-tabs custom-nav">
                <li class="nav-item"><a class="nav-link" href="/historial">Historial</a></li>
                <li class="nav-item"><a class="nav-link active" href="/horarioClases">Clases</a></li>
                <li class="nav-item"><button class="nav-link btn-logout" onclick="logout()">Salir</button></li>
            </ul>`;
    }
}

getNombre();