<?php
require_once __DIR__ . '/../models/Factura.php';
require_once __DIR__ . '/../models/Producto.php';
// require TCPDF aquí si vas a generar PDF

class FacturaController {
    private $facturaModel;
    private $productoModel;
    private $base;

    public function __construct() {
        $this->facturaModel = new Factura();
        $this->productoModel = new Producto();
        $this->base = '/PARCIAL3/'; // Cambia esto si tu carpeta es diferente
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Generar factura y mostrar PDF o confirmación
    public function generar() {
        if (!isset($_SESSION['id_usuario']) || empty($_SESSION['carrito'])) {
            $_SESSION['error_msg'] = "Debe iniciar sesión y tener productos en el carrito.";
            header('Location: ' . $this->base . 'carrito/ver');
            exit;
        }

        $total = 0;
        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            $prod = $this->productoModel->buscarPorId($id);
            if ($prod) {
                $total += $prod['precio'] * $cantidad;
            }
        }

        $id_factura = $this->facturaModel->crear($_SESSION['id_usuario'], $total);

        foreach ($_SESSION['carrito'] as $id => $cantidad) {
            $prod = $this->productoModel->buscarPorId($id);
            if ($prod) {
                $this->facturaModel->agregarDetalle($id_factura, $id, $cantidad, $prod['precio']);
            }
        }

        // Aquí puedes generar el PDF con TCPDF si lo deseas, o mostrar un mensaje de éxito:
        $_SESSION['success_msg'] = "¡Compra exitosa! Se generó su factura.";
        $_SESSION['carrito'] = [];
        header('Location: ' . $this->base . 'factura/exito/' . $id_factura);
        exit;
    }

   public function exito($id_factura) {
    $factura = $this->facturaModel->obtenerFacturaConDetalles($id_factura);
    require __DIR__ . '/../views/facturas/exito.php';
}
}
?>
