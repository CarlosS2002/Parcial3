<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Lista de Usuarios</h2>
<table>
    <tr>
        <th>Nombre</th>
        <th>Cédula</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Rol</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
        <td><?= htmlspecialchars($usuario['cedula']) ?></td>
        <td><?= htmlspecialchars($usuario['correo']) ?></td>
        <td><?= htmlspecialchars($usuario['direccion']) ?></td>
        <td><?= htmlspecialchars($usuario['rol']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
