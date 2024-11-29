<?php
   include "conexion_be.php"; 

  if(!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql = $conexion->query("delete from solicitud where id = '$id'");
    if($sql == 1){
       echo '<div>Solicitud eliminada correctamente</div>';
       header("location: ../html/sistema_adm/solicitudes/solicitudes.php");
    } else {
        echo '<div>Error al intentar eliminar la solicitud</div>';
    }
 }
?>