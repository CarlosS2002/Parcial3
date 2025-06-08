<?php
// models/Factura.php
class Factura {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function crear($id_usuario, $total) {
        $sql = "INSERT INTO facturas (id_usuario, total)
                VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario, $total]);
        return $this->db->lastInsertId();
    }

    public function agregarDetalle($id_factura, $id_producto, $cantidad, $precio_unitario) {
        $sql = "INSERT INTO detalle_factura (id_factura, id_producto, cantidad, precio_unitario)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_factura, $id_producto, $cantidad, $precio_unitario]);
    }

    public function obtenerFacturaConDetalles($id_factura) {
        $stmt = $this->db->prepare(
            "SELECT f.*, u.nombre as usuario 
             FROM facturas f
             JOIN usuarios u ON f.id_usuario = u.id
             WHERE f.id = ?");
        $stmt->execute([$id_factura]);
        $factura = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->db->prepare(
            "SELECT d.*, p.nombre as producto
             FROM detalle_factura d
             JOIN productos p ON d.id_producto = p.id
             WHERE d.id_factura = ?");
        $stmt->execute([$id_factura]);
        $factura['detalles'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $factura;
    }
}
?>
