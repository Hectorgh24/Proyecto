<?php
  
    include "conexion_be.php"; 
    if(isset($_POST['btnActualizar'])){
        if(!empty('nombre2') && !empty('tipo2') && !empty('apellidop2') && !empty('apellidom2') && !empty('contrasena2')){
         $correo = $_POST['correo2'];
         $apellidop = $_POST['apellidop2'];
         $apellidom = $_POST['apellidom2'];
         $contrasena = $_POST['contrasena2'];
         $nombre = $_POST['nombre2'];
         $tipo = $_POST['tipo2'];

         $sql = $conexion->query("UPDATE usuario SET nombre='$nombre', apellido_paterno='$apellidop', apellido_materno='$apellidom', contrasena='$contrasena',tipo_usuario='$tipo' WHERE correo_institucional='$correo' AND (tipo_usuario = 'tecnico_academico' OR tipo_usuario = 'jefe_centro_computo')");
          if($sql){
            echo '<script>alert("Usuario modificado exitosamente");</script>';
            echo '<script>setTimeout(function() { window.location.href = "../html/sistema_adm/gestionar_adm/gestionar_adm.php"; }, 1000);</script>';
          }else{
            echo '<script>alert("No se pudo modificar el usuario");</script>';
            echo '<script>setTimeout(function() { window.location.href = "../html/sistema_adm/gestionar_adm/gestionar_adm.php"; }, 1000);</script>';
          }
        }
    }

    
    $conexion->close(); // Cierra la conexión

?>