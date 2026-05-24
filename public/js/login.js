document.getElementById('loginForm').addEventListener('submit', async function (e) {

    e.preventDefault();

    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();

    if (username === '' || password === '') {
        alert('Complete todos los campos');
        return;
    }

    try {

        var response = await fetch('/api/login', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                username: username,
                password: password
            })

        });

        var data = await response.json();

        // LOGIN EXITOSO
        if (response.ok) {

            // GUARDAR TOKEN
            localStorage.setItem('token', data.token);

            // GUARDAR ROL
            localStorage.setItem('rol_id', data.rol_id);

            // GUARDAR USERNAME
            localStorage.setItem('username', data.username);

            // GUARDAR USER_ID
            localStorage.setItem('user_id', data.user_id);

            // REDIRECCION SEGÚN ROL

            // ADMIN
            if (data.rol_id == 2) {

                window.location.href = '/admin';

            }

            // USUARIO NORMAL
            else if (data.rol_id == 1) {

                window.location.href = '/';

            }

            // ROL DESCONOCIDO
            else {

                alert('Rol no válido');

            }

        }

        // ERROR LOGIN
        else {

            alert(data.message || 'Credenciales incorrectas');

        }

    } catch (error) {

        console.log(error);

        alert('Error al conectar con el servidor');

    }

});