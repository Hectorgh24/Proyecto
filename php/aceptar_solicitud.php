<?php
  include "conexion_be.php";  
  
  if (isset($_GET['id'])) {
    $id = $_GET["id"];
  //que traiga los datos que coincidan con el id
    // Preparar la consulta para actualizar el estado de la solicitud
    //$sql = $conexion->prepare("UPDATE solicitud SET estado = 1 WHERE id = '$id'");
    //$sql->bind_param("i", $id); // Asocia el ID como un entero
    $sql = $conexion->query("UPDATE solicitud SET estado = 'Aceptada' WHERE id = $id");
    
    if($sql == 1){
        header("location: ../html/sistema_adm/solicitudes/solicitudes.php");
     }else{
        echo '<div class="alert alert-danger">Error al modificar la solicitud</div>';
     }
  }
    $conexion->close(); // Cierra la conexión
?>

