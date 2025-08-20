<?php
include 'connection.php';
$conn = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO producto (producto, cantidad, estado) VALUES ('$producto', '$cantidad', '$estado')";
    $conn->query($sql);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2>Agregar Producto</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Producto</label>
            <input type="text" name="producto" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select">
                <option value="Faltante">Faltante</option>
                <option value="Comprado">Comprado</option>
                <option value="No se encontró">No se encontro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>

    <footer class="text-center mt-4">
        © Todos los derechos reservados por Carlos Manuel Buezo Vidaurre
    </footer>

</body>
</html>