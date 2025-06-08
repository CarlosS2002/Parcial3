<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>¡Compra realizada con éxito!</h2>
<p>Factura N°: <?= $factura['id'] ?> | Fecha: <?= $factura['fecha'] ?></p>
<p>Cliente: <?= htmlspecialchars($factura['usuario']) ?></p>

<table>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
    </tr>
    <?php foreach($factura['detalles'] as $item): ?>
    <tr>
        <td><?= htmlspecialchars($item['producto']) ?></td>
        <td><?= $item['cantidad'] ?></td>
        <td>$<?= number_format($item['precio_unitario'],2) ?></td>
        <td>$<?= number_format($item['cantidad']*$item['precio_unitario'],2) ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3"><strong>Total:</strong></td>
        <td><strong>$<?= number_format($factura['total'],2) ?></strong></td>
    </tr>
</table>
<br>
<a href="<?= $base ?>producto/listar">Volver a la tienda</a>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
