async function cargarClasesAdmin() {
    const tbody = document.getElementById('tbodyClases');
    const response = await authFetch('/api/clases');
    const clases = await response.json();
    tbody.innerHTML = '';
    clases.forEach(clase => {
        tbody.innerHTML += `
            <tr>
                <td>${clase.nombre}</td>
                <td>${clase.descripcion}</td>
                <td>${clase.diaSemana}</td>
                <td>${clase.horario}</td>
                <td>${clase.capacidad}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="eliminarClase(${clase.id})">Eliminar</button>
                </td>
            </tr>`;
    });
}

async function eliminarClase(id) {
    if (!confirm('¿Eliminar esta clase?')) return;
    await authFetch('/api/clases/' + id, { method: 'DELETE' });
    cargarClasesAdmin();
}

cargarClasesAdmin();