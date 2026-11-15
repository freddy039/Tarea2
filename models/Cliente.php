<?php
class Cliente {
    public string $id;
    public string $nombre;
    public string $correo;

    public function __construct(string $id, string $nombre, string $correo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
    }

    public static function crear(string $nombre, string $correo): void {
        $id = uniqid('cliente_', true);
        $_SESSION['clientes'][$id] = new self($id, $nombre, $correo);
    }

    public static function leer(): array {
        return $_SESSION['clientes'] ?? [];
    }

    public static function actualizar(string $id, string $nombre, string $correo): void {
        if (isset($_SESSION['clientes'][$id])) {
            $_SESSION['clientes'][$id]->nombre = $nombre;
            $_SESSION['clientes'][$id]->correo = $correo;
        }
    }

    public static function eliminar(string $id): void {
        unset($_SESSION['clientes'][$id]);
    }
}
