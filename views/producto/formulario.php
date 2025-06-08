<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2><?= isset($producto) ? 'Editar producto' : 'Crear producto' ?></h2>

<?php if (!empty($_SESSION['error_msg'])): ?>
    <div class="msg error"><?= $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?></div>
<?php endif; ?>

<form method="post" action="">
    <label>Nombre:</label>
    <input type="text" name="nombre" required value="<?= isset($producto) ? htmlspecialchars($producto['nombre']) : '' ?>">
    
    <label>Descripción:</label>
    <input type="text" name="descripcion" value="<?= isset($producto) ? htmlspecialchars($producto['descripcion']) : '' ?>">
    
    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required value="<?= isset($producto) ? htmlspecialchars($producto['precio']) : '' ?>">
    
    <label>Stock:</label>
    <input type="number" name="stock" min="0" value="<?= isset($producto) ? htmlspecialchars($producto['stock']) : '1' ?>">
    
    <input type="submit" value="<?= isset($producto) ? 'Actualizar' : 'Crear' ?>">
</form>

<a href="<?= $base ?>producto/listar">&larr; Volver al listado</a>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
