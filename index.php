<?php
require_once __DIR__ . '/models/Cliente.php';
session_start();
require_once __DIR__ . '/controllers/ClienteController.php';
$controller = new ClienteController();
$controller->procesar();
require __DIR__ . '/views/clientes.php';
