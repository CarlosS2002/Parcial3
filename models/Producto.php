<?php
// models/Producto.php
class Producto {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function obtenerTodos() {
        return $this->db->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $descripcion, $precio, $stock) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio, $stock]);
    }

    public function actualizar($id, $nombre, $descripcion, $precio, $stock) {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=?
                WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio, $stock, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
