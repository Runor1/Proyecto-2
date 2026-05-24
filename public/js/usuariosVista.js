async function cargarUsuarios() {
    const tbody = document.getElementById('tbodyUsuarios');
    const response = await authFetch('/api/usuarios');
    const usuarios = await response.json();
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
    await authFetch('/api/usuarios/' + id, { method: 'DELETE' });
    cargarUsuarios();
}

cargarUsuarios();