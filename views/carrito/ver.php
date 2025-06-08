<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Mi Carrito</h2>
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
<?php if (empty($items)): ?>
    <p>El carrito está vacío.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acción</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['nombre']) ?></td>
            <td>$<?= number_format($item['precio'],2) ?></td>
            <td><?= $item['cantidad'] ?></td>
            <td>$<?= number_format($item['subtotal'],2) ?></td>
            <td>
                <a href="<?= $base ?>carrito/quitar/<?= $item['id'] ?>">Quitar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>$<?= number_format($total,2) ?></strong></td>
            <td></td>
        </tr>
    </table>
    <form action="<?= $base ?>factura/generar" method="post">
        <button type="submit">Finalizar Compra</button>
    </form>
    <a href="<?= $base ?>carrito/vaciar" onclick="return confirm('¿Vaciar carrito?')">Vaciar carrito</a>
<?php endif; ?>
<a href="<?= $base ?>producto/listar">Volver a la tienda</a>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
