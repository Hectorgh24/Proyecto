<?php
session_start();
include "conexion_be.php"; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];

    // Verificar que el correo no esté vacío
    if (!empty($correo)) {
        // Preparar la consulta para eliminar al usuario
        $stmt = $conexion->prepare("DELETE FROM usuario WHERE correo_institucional = ? AND (tipo_usuario = 'tecnico_academico' OR tipo_usuario = 'jefe_centro_computo')");
        $stmt->bind_param("s", $correo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Verificar que se eliminó al menos un registro
            if ($stmt->affected_rows > 0) {
                echo '<script>alert("Usuario eliminado exitosamente");</script>';
                echo '<script>setTimeout(function() { window.location.href = "../html/sistema_adm/gestionar_adm/gestionar_adm.php"; }, 1000);</script>';
            } else {
                echo '<script>alert("No se encontro el usuario con el correo proporcionado");</script>';
                echo '<script>setTimeout(function() { window.location.href = "../html/sistema_adm/gestionar_adm/gestionar_adm.php"; }, 1000);</script>';
            }
        } else {
            echo "Error al intentar eliminar el usuario.";
        }

        $stmt->close();
    } else {
        echo "El correo no puede estar vacío.";
    }
}

$conexion->close();
?>
