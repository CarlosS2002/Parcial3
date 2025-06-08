<?php
// controllers/UsuarioController.php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;
    private $base;

    public function __construct() {
        $this->base = '/PARCIAL3/'; // Cambia según tu carpeta
        $this->usuarioModel = new Usuario();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Registro de usuario
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre    = trim($_POST['nombre'] ?? '');
            $cedula    = trim($_POST['cedula'] ?? '');
            $correo    = trim($_POST['correo'] ?? '');
            $direccion = trim($_POST['direccion'] ?? '');
            $password  = $_POST['password'] ?? '';

            // Validaciones básicas
            $errores = [];
            if ($nombre == '' || $cedula == '' || $correo == '' || $password == '') {
                $errores[] = "Todos los campos marcados son obligatorios.";
            }
            if ($correo !== '' && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El correo no es válido.";
            }

            if ($errores) {
                $_SESSION['error_msg'] = implode('<br>', $errores);
                require __DIR__ . '/../views/usuarios/registrar.php';
                return;
            }

            // Registrar usuario (contraseña SIN hash, solo para pruebas)
            $exito = $this->usuarioModel->registrar($nombre, $cedula, $correo, $direccion, $password);
            if ($exito) {
                $_SESSION['success_msg'] = "Registro exitoso. Inicia sesión.";
                header('Location: ' . $this->base . 'usuario/iniciarSesion');
                exit;
            } else {
                $_SESSION['error_msg'] = "No se pudo registrar. Puede que el correo ya exista.";
                require __DIR__ . '/../views/usuarios/registrar.php';
            }
        } else {
            require __DIR__ . '/../views/usuarios/registrar.php';
        }
    }

    // Iniciar sesión (sin hash)
    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo   = trim($_POST['correo'] ?? '');
            $password = $_POST['password'] ?? '';
            $usuario = $this->usuarioModel->buscarPorCorreo($correo);

            if ($usuario && $password === $usuario['password']) {
                session_regenerate_id(true);
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];
                header('Location: ' . $this->base . 'producto/listar');
                exit;
            } else {
                $_SESSION['error_msg'] = "Correo o contraseña incorrectos.";
                require __DIR__ . '/../views/usuarios/iniciarSesion.php';
            }
        } else {
            require __DIR__ . '/../views/usuarios/iniciarSesion.php';
        }
    }

    // Cerrar sesión
    public function salir() {
        session_destroy();
        header('Location: ' . $this->base . 'producto/listar');
        exit;
    }
    public function listar() {
    // Asegúrate que tienes este método en tu modelo Usuario:
    // public function obtenerTodos() { ... }
    $usuarios = $this->usuarioModel->obtenerTodos();
    require __DIR__ . '/../views/usuarios/listar.php';
}
}
?>
