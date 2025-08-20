<?php
function connection() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "listado_de_productos"; // nombre corregido sin espacios
    $port = 3307;

    // Crear conexión
    $connect = mysqli_connect($host, $user, $pass, $db, $port);

    // Verificar conexión
    if (!$connect) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $connect;
}
?>
