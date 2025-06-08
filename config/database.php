<?php
class Database {
    private static $instance = null;
    public static function getConnection() {
        if (self::$instance === null) {
            $host = "localhost";
            $dbname = "tienda_virtual";   // Nombre de la base de datos
            $username = "root";           // Usuario de la BD
            $password = "";               // Contraseña de la BD (vacía por defecto en XAMPP)
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];
            try {
                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname",
                    $username,
                    $password,
                    $options
                );
            } catch (PDOException $e) {
                die("Error de conexión a la BD: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>
