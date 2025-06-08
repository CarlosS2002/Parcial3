<?php
// models/Usuario.php
class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function registrar($nombre, $cedula, $correo, $direccion, $password, $rol = 'usuario') {
    $sql = "INSERT INTO usuarios (nombre, cedula, correo, direccion, password, rol)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$nombre, $cedula, $correo, $direccion, $password, $rol]);
}

    public function buscarPorCorreo($correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTodos() {
    $sql = "SELECT * FROM usuarios";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function actualizar($id, $nombre, $cedula, $correo, $direccion, $rol) {
        $sql = "UPDATE usuarios SET nombre=?, cedula=?, correo=?, direccion=?, rol=?
                WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $cedula, $correo, $direccion, $rol, $id]);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>
