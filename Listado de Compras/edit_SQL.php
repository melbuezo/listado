<?php
include 'connection.php';
$conn = connection();

// Validar que el parámetro 'id' exista y sea numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']); // Sanitizar el ID

// Obtener el producto usando consulta preparada
$stmt = $conn->prepare("SELECT * FROM producto WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Producto no encontrado.");
}

$row = $result->fetch_assoc();
$stmt->close();

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = trim($_POST['producto']);
    $cantidad = intval($_POST['cantidad']);
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE producto SET producto = ?, cantidad = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("sisi", $producto, $cantidad, $estado, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar el producto: " . htmlspecialchars($stmt->error) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2>Editar Producto</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Producto</label>
            <input type="text" name="producto" class="form-control" value="<?= htmlspecialchars($row['producto']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="<?= htmlspecialchars($row['cantidad']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select">
                <option value="Faltante" <?= $row['estado'] === 'Faltante' ? 'selected' : '' ?>>Faltante</option>
                <option value="Comprado" <?= $row['estado'] === 'Comprado' ? 'selected' : '' ?>>Comprado</option>
                <option value="No se encontró" <?= $row['estado'] === 'No se encontró' ? 'selected' : '' ?>>No se encontró</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>

    <footer class="text-center mt-4">
        © Todos los derechos reservados por Carlos Manuel Buezo Vidaurre
    </footer>

</body>
</html>

