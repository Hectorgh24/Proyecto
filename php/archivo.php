<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_proyecto";
$port = "3307";


$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener el número de solicitudes pendientes
$sql = "SELECT COUNT(*) AS pendientes FROM solicitud WHERE estado = 'Pendiente'";
$result = $conn->query($sql);

$pendientes = 0;
if ($result->num_rows > 0) {
    // Obtener el número de solicitudes pendientes
    $row = $result->fetch_assoc();
    $pendientes = $row['pendientes'];
}

// Cerrar la conexión
$conn->close();

// Devolver el resultado en formato JSON
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['ajax'])) {
    echo json_encode(array('pendientes' => $pendientes));
    exit;
}
?>
