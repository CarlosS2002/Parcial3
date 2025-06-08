<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$base = '/PARCIAL3/'; // Cambia aquí si cambias tu carpeta
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Virtual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= $base ?>public/css/styles.css">
    <script src="<?= $base ?>public/js/scripts.js" defer></script>
</head>
<body>
<header>
    <div class="header-content">
        <h1><a href="<?= $base ?>producto/listar" style="color:inherit;text-decoration:none;">Tienda Virtual</a></h1>
        <nav>
            <a href="<?= $base ?>producto/listar">Productos</a>
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a href="<?= $base ?>carrito/ver">Carrito</a>
                <?php if ($_SESSION['rol'] === 'administrador'): ?>
                    <a href="<?= $base ?>producto/crear">Nuevo producto</a>
                    <a href="<?= $base ?>usuario/listar">Usuarios</a>
                <?php endif; ?>
                <span class="user">👤 <?= htmlspecialchars($_SESSION['nombre']) ?></span>
                <a href="<?= $base ?>usuario/salir" style="float:right;">Salir</a>
            <?php else: ?>
                <a href="<?= $base ?>usuario/registrar">Registrarse</a>
                <a href="<?= $base ?>usuario/iniciarSesion">Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<div class="container">
