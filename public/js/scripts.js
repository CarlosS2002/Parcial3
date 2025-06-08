// Mensaje de confirmación al eliminar o vaciar carrito
document.addEventListener('DOMContentLoaded', function() {
    // Confirmación para eliminar producto (en producto/listar.php)
    const deleteLinks = document.querySelectorAll('a[data-confirm]');
    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (!confirm(link.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });

    // Validación de formulario de registro (usuarios/registrar.php)
    const formRegistro = document.querySelector('form[action*="registrar"]');
    if (formRegistro) {
        formRegistro.addEventListener('submit', function(e) {
            const nombre = formRegistro.nombre.value.trim();
            const cedula = formRegistro.cedula.value.trim();
            const correo = formRegistro.correo.value.trim();
            const password = formRegistro.password.value.trim();

            if (!nombre || !cedula || !correo || !password) {
                alert('Todos los campos marcados son obligatorios.');
                e.preventDefault();
            } else if (!/^\S+@\S+\.\S+$/.test(correo)) {
                alert('Ingrese un correo válido.');
                e.preventDefault();
            }
        });
    }

    // Validación de formulario de productos (producto/formulario.php)
    const formProducto = document.querySelector('form[action*="crear"],form[action*="editar"],form[action*="actualizar"]');
    if (formProducto) {
        formProducto.addEventListener('submit', function(e) {
            const nombre = formProducto.nombre.value.trim();
            const precio = formProducto.precio.value.trim();
            if (!nombre || !precio) {
                alert('El nombre y el precio son obligatorios.');
                e.preventDefault();
            } else if (isNaN(precio) || Number(precio) <= 0) {
                alert('El precio debe ser un número positivo.');
                e.preventDefault();
            }
        });
    }
});
