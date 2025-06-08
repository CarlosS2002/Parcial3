<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $productoModel;
    private $base;

    public function __construct() {
        $this->productoModel = new Producto();
        $this->base = '/PARCIAL3/'; // Cambia si tu carpeta es diferente
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Listar productos (vista pública)
    public function listar() {
        $productos = $this->productoModel->obtenerTodos();
        require __DIR__ . '/../views/producto/listar.php';
    }

    // Mostrar formulario y crear producto (solo admin)
public function crear() {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
        header('Location: ' . $this->base . 'producto/listar');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? 0;

        if ($nombre === '' || $precio === '') {
            $_SESSION['error_msg'] = 'Nombre y precio son obligatorios.';
        } else {
            $this->productoModel->crear($nombre, $descripcion, $precio, $stock);
            $_SESSION['success_msg'] = 'Producto creado correctamente.';
            header('Location: ' . $this->base . 'producto/listar');
            exit;
        }
    }
    // Aquí NO pasas $producto, así el formulario se muestra vacío
    require __DIR__ . '/../views/producto/formulario.php';
}


    // Editar producto (solo admin)
   public function editar($id) {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
        header('Location: ' . $this->base . 'producto/listar');
        exit;
    }
    $producto = $this->productoModel->buscarPorId($id);
    if (!$producto) {
        $_SESSION['error_msg'] = 'Producto no encontrado.';
        header('Location: ' . $this->base . 'producto/listar');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? 0;

        if ($nombre === '' || $precio === '') {
            $_SESSION['error_msg'] = 'Nombre y precio son obligatorios.';
        } else {
            $this->productoModel->actualizar($id, $nombre, $descripcion, $precio, $stock);
            $_SESSION['success_msg'] = 'Producto actualizado.';
            header('Location: ' . $this->base . 'producto/listar');
            exit;
        }
    }
    require __DIR__ . '/../views/producto/formulario.php';
}
    // Eliminar producto (solo admin)
    public function eliminar($id) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
            header('Location: ' . $this->base . 'producto/listar');
            exit;
        }
        $this->productoModel->eliminar($id);
        $_SESSION['success_msg'] = 'Producto eliminado.';
        header('Location: ' . $this->base . 'producto/listar');
        exit;
    }
}
?>
