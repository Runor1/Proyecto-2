document.getElementById('formClase').addEventListener('submit', async function (e) {
    e.preventDefault();
    const data = {
        nombre: document.querySelector('[name=nombre]').value,
        descripcion: document.querySelector('[name=descripcion]').value,
        diaSemana: document.querySelector('[name=diaSemana]').value,
        horario: document.querySelector('[name=horario]').value,
        capacidad: document.querySelector('[name=capacidad]').value,
    };
    try {
        const response = await authFetch('/api/clases', {
            method: 'POST',
            body: JSON.stringify(data)
        });
        const result = await response.json();
        if (response.ok) {
            alert('Clase creada correctamente');
            window.location.href = '/clasesVista';
        } else {
            alert(result.message || 'Error al crear la clase');
        }
    } catch (error) {
        console.log(error);
    }
});