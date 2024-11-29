<?php
ob_start();

if (!empty($_POST["btnregistrar"])) {
  if (!empty($_POST["nombre"]) && !empty($_POST["correo"])  && !empty($_POST["equipo"]) && !empty($_POST["espacio"]) && !empty($_POST["fechasolicitud"]) && !empty($_POST["horaentrada"]) && !empty($_POST["horasalida"])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $equipo = $_POST["equipo"];
    $espacio = $_POST["espacio"];
    $fechasolicitud = $_POST["fechasolicitud"];
    $horaentrada = $_POST["horaentrada"];
    $horasalida = $_POST["horasalida"];
    $estado = "Pendiente";


    // Verificar usuario en la tabla usuario
    $sql_usuario = "SELECT * FROM usuario WHERE correo_institucional = '$correo'";
    $resultado_usuario = $conexion->query($sql_usuario);

    // Verificar solicitud repetida
    $sql_repetido = "SELECT * FROM solicitud WHERE correo_usuario = '$correo'";
    $resultado_repetido = $conexion->query($sql_repetido);

    if ($equipo === "especializado" && !empty($_POST["detalle_equipo"])) {
        $equipo =  $_POST["detalle_equipo"];
    }
  
    if ($resultado_usuario->num_rows > 0) {
        $sql = $conexion->query("INSERT INTO solicitud (equipo, espacio_uso, fecha_solicitud, hora_inicio, hora_final, estado, correo_usuario, licenciatura) VALUES ('$equipo', '$espacio', '$fechasolicitud', '$horaentrada', '$horasalida', '$estado', '$correo','Ninguna')");

        if ($sql) {
            sleep(3); // Pausa de 2 segundos (ajustar al tiempo deseado)
            echo '<script>alert("Solicitud registrada exitosamente");</script>';
            echo '<script>setTimeout(function() { window.location.href = "../../../index.php"; }, 1000);</script>';
             exit();
            
            
            //exit();
        } else {
            die("Error en la inserción de la solicitud: " . $conexion->error);
        }
    } else {
        echo '<script>alert("No existe un Tecnico Academico con el correo ingresado");</script>';
        echo '<script>setTimeout(function() { window.location.href = "../../../index.php"; }, 1000);</script>';
        exit();
    }
  } 
}
?>
