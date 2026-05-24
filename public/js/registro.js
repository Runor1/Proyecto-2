document.getElementById('registro').addEventListener('submit', async function (e) {
    e.preventDefault();
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
        const response = await authFetch('/api/usuarios', {
            method: 'POST',
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