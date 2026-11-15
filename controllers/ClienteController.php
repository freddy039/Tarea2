<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    public function procesar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        $accion = $_POST['accion'] ?? '';
        $id = (string) ($_POST['id'] ?? '');
        $nombre = trim((string) ($_POST['nombre'] ?? ''));
        $correo = trim((string) ($_POST['correo'] ?? ''));

        if ($accion === 'eliminar') {
            Cliente::eliminar($id);
        } elseif (in_array($accion, ['crear', 'actualizar'], true)) {
            if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Ingrese un nombre y un correo válido.';
            } elseif ($accion === 'crear') {
                Cliente::crear($nombre, $correo);
            } else {
                Cliente::actualizar($id, $nombre, $correo);
            }
        }
        header('Location: index.php');
        exit;
    }
}
