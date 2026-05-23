<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Clase</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/crearClase.css">
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">

        <div class="registro-card p-4">

            <div class="text-center">
                <img src="/img/logo.png" alt="logo" class="logo">
                <h2 class="titulo">Nueva Clase</h2>
                <p class="subtitulo">Crea una clase en el sistema</p>
            </div>

            <form id="formClase">

                <input type="hidden" name="idClase">

                <div class="mb-3">
                    <input type="text" name="nombre" class="form-control"
                        placeholder="Nombre de la clase" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="descripcion" class="form-control"
                        placeholder="Descripción" required>
                </div>

                <div class="mb-3">
                    <select name="diaSemana" class="form-control" required>
                        <option value="">Día de la semana</option>

                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sábado">Sábado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="time" name="horario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="number" name="capacidad" class="form-control"
                        placeholder="Capacidad" min="1" required>
                </div>

                <button type="submit" class="btn btn-main w-100">
                    Guardar Clase
                </button>

            </form>

        </div>

    </div>
    <script>
        document.getElementById('formClase').addEventListener('submit', async function(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const data = {
                nombre: document.querySelector('[name=nombre]').value,
                descripcion: document.querySelector('[name=descripcion]').value,
                diaSemana: document.querySelector('[name=diaSemana]').value,
                horario: document.querySelector('[name=horario]').value,
                capacidad: document.querySelector('[name=capacidad]').value,
            };
            try {
                const response = await fetch('/api/clases', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
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
    </script>

</body>

</html>