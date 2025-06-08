<?php
require_once __DIR__ . '/../models/Producto.php';

class CarritoController {
    private $productoModel;
    private $base;

    public function __construct() {
        $this->productoModel = new Producto();
        $this->base = '/PARCIAL3/'; // Cambia esto según tu carpeta
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    // Agregar producto al carrito
  public function agregar($id_producto) {
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: ' . $this->base . 'usuario/iniciarSesion');
        exit;
    }
    // Obtener cantidad, por defecto 1 si no está
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;
    if ($cantidad < 1) $cantidad = 1;

    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }
    $_SESSION['success_msg'] = "Producto agregado al carrito.";
    header('Location: ' . $this->base . 'carrito/ver');
    exit;
}

    // Quitar producto del carrito
    public function quitar($id_producto) {
        if (isset($_SESSION['carrito'][$id_producto])) {
            unset($_SESSION['carrito'][$id_producto]);
            $_SESSION['success_msg'] = "Producto eliminado del carrito.";
        }
        header('Location: ' . $this->base . 'carrito/ver');
        exit;
    }

    // Ver carrito
    public function ver() {
        $items = [];
        $total = 0;
        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            $prod = $this->productoModel->buscarPorId($id);
            if ($prod) {
                $prod['cantidad'] = $cantidad;
                $prod['subtotal'] = $cantidad * $prod['precio'];
                $total += $prod['subtotal'];
                $items[] = $prod;
            }
        }
        require __DIR__ . '/../views/carrito/ver.php';
    }

    // Vaciar carrito
    public function vaciar() {
        $_SESSION['carrito'] = [];
        $_SESSION['success_msg'] = "Carrito vaciado.";
        header('Location: ' . $this->base . 'carrito/ver');
        exit;
    }
}
?>
