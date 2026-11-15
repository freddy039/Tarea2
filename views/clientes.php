<?php
$clientes = Cliente::leer();
$editar = null;
$idEditar = (string) ($_GET['editar'] ?? '');
if ($idEditar !== '' && isset($clientes[$idEditar])) {
    $editar = $clientes[$idEditar];
}
function e(string $valor): string {
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD de Clientes - POO</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="contenedor">
    <h1>CRUD de Clientes</h1>
    <p>Aplicaciones Web | PHP y Programación Orientada a Objetos</p>

    <section class="tarjeta">
        <h2><?= $editar ? 'Actualizar cliente' : 'Registrar cliente' ?></h2>
        <?php if (!empty($_SESSION['error'])): ?>
            <p class="error"><?= e($_SESSION['error']) ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <form method="post" action="index.php">
            <input type="hidden" name="accion" value="<?= $editar ? 'actualizar' : 'crear' ?>">
            <?php if ($editar): ?>
                <input type="hidden" name="id" value="<?= e($editar->id) ?>">
            <?php endif; ?>
            <label>Nombre</label>
            <input type="text" name="nombre" required maxlength="100" value="<?= e($editar->nombre ?? '') ?>">
            <label>Correo</label>
            <input type="email" name="correo" required maxlength="150" value="<?= e($editar->correo ?? '') ?>">
            <button type="submit"><?= $editar ? 'Guardar cambios' : 'Agregar cliente' ?></button>
            <?php if ($editar): ?><a href="index.php">Cancelar</a><?php endif; ?>
        </form>
    </section>

    <section class="tarjeta">
        <h2>Clientes registrados</h2>
        <?php if (!$clientes): ?>
            <p>No hay clientes registrados.</p>
        <?php else: ?>
            <div class="tabla"><table>
                <thead><tr><th>Nombre</th><th>Correo</th><th>Acciones</th></tr></thead>
                <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= e($cliente->nombre) ?></td>
                        <td><?= e($cliente->correo) ?></td>
                        <td class="acciones">
                            <a href="?editar=<?= urlencode($cliente->id) ?>">Editar</a>
                            <form method="post" action="index.php" onsubmit="return confirm('¿Eliminar este cliente?');">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?= e($cliente->id) ?>">
                                <button class="eliminar" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table></div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
