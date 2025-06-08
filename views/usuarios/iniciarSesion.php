<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Iniciar sesión</h2>
<?php
if (!empty($_SESSION['error_msg'])) {
    echo '<div class="msg error">' . $_SESSION['error_msg'] . '</div>';
    unset($_SESSION['error_msg']);
}
?>
<form method="POST" action="<?= $base ?>usuario/iniciarSesion">
    <label>Correo:</label><br>
    <input type="email" name="correo" required><br><br>
    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Ingresar</button>
</form>
<p>¿No tienes cuenta? <a href="<?= $base ?>/usuario/registrar">Regístrate aquí</a>.</p>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
