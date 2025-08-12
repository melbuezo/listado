<?php
include 'connection.php';
$conn = connection();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1 class="mb-4 text-center">Listado de Productos</h1>

    <!-- Botón para agregar nuevo producto -->
    <a href="insertar_SQL.php" class="btn btn-primary mb-3">Agregar Producto</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre Producto</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM producto");
            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['producto'] ?></td>
                <td><?= $row['cantidad'] ?></td>
                <td><?= $row['estado'] ?></td>
                <td>
                    <a href="edit_SQL.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                </td>
            </tr>
            <?php
                endwhile;
            else:
            ?>
            <tr>
                <td colspan="6" class="text-center">No hay productos registrados</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <footer class="text-center mt-4">
        © Todos los derechos reservados por Carlos Manuel Buezo Vidaurre
    </footer>

</body>
</html>