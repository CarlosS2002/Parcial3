<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Registro de Usuario</h2>
<?php
if (!empty($_SESSION['error_msg'])) {
    echo '<div class="msg error">' . $_SESSION['error_msg'] . '</div>';
    unset($_SESSION['error_msg']);
}
if (!empty($_SESSION['success_msg'])) {
    echo '<div class="msg success">' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
}
?>
<form method="POST" action="<?= $base ?>usuario/registrar">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    
    <label>Cédula:</label>
    <input type="text" name="cedula" required>
    
    <label>Correo:</label>
    <input type="email" name="correo" required>
    
    <label>Dirección:</label>
    <input type="text" name="direccion">
    
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    
    <button type="submit">Registrarse</button>
</form>
<p>¿Ya tienes cuenta? <a href="<?= $base ?>usuario/iniciarSesion">Inicia sesión aquí</a>.</p>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
