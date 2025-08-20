<?php
include 'connection.php';
$conn = connection();

// Validar que se recibió un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido o no especificado.");
}

$id = intval($_GET['id']); // Sanitiza el ID

// Usar sentencia preparada para seguridad
$stmt = $conn->prepare("DELETE FROM producto WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Redirigir al listado si se eliminó correctamente
    header("Location: index.php");
    exit();
} else {
    echo "❌ Error al eliminar: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

