<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Productos disponibles</h2>
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
<table>
    <tr>
        <th>Nombre</th><th>Descripción</th><th>Precio</th><th>Stock</th><th>Acciones</th>
    </tr>
    <?php foreach($productos as $prod): ?>
    <tr>
        <td><?= htmlspecialchars($prod['nombre']) ?></td>
        <td><?= htmlspecialchars($prod['descripcion']) ?></td>
        <td>$<?= number_format($prod['precio'],2) ?></td>
        <td><?= $prod['stock'] ?></td>
        <td>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                <a href="<?= $base ?>producto/editar/<?= $prod['id'] ?>">Editar</a> | 
                <a href="<?= $base ?>producto/eliminar/<?= $prod['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['id_usuario']) && $_SESSION['rol'] !== 'administrador'): ?>
                <form action="<?= $base ?>carrito/agregar/<?= $prod['id'] ?>" method="post" style="display:inline;">
    <input type="number" name="cantidad" min="1" value="1" style="width:50px;">
    <button type="submit">Agregar al carrito</button>
</form>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
    <a href="<?= $base ?>producto/crear">Nuevo producto</a>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
