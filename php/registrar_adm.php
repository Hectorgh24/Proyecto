<?php


if(!empty($_POST["btnregistrar"])){
  if(!empty($_POST["nombre"]) && !empty($_POST["apellidop"]) && !empty($_POST["apellidom"]) && !empty($_POST["tipo"]) && !empty($_POST["email"]) && !empty($_POST["contrasena"])){
   $nombre = $_POST["nombre"];
   $apellidop = $_POST["apellidop"];
   $apellidom = $_POST["apellidom"];
   $tipo = $_POST["tipo"];
   $email = $_POST["email"];
   $contrasena = $_POST["contrasena"];
   
   // Verificar usuario en la tabla usuario
   $sql_usuario = "SELECT * FROM usuario WHERE correo_institucional = '$email' AND contrasena='$contrasena'";
   $resultado_usuario = $conexion->query($sql_usuario);

   if(($resultado_usuario->num_rows > 0)){
    echo "Current directory: " . __DIR__;
    echo '<script>alert("Ya se encuentra una usuario registrado con ese correo y contrasena ");</script>';
    echo '<script>setTimeout(function() { window.location.href = "../html/sistema_adm/inicio/inicio.php"; }, 1000);</script>';
    exit();
   } else{
    $sql = $conexion->query("INSERT INTO usuario(correo_institucional,contrasena, nombre, apellido_paterno, apellido_materno, tipo_usuario) VALUES ('$email','$contrasena','$nombre','$apellidop','$apellidom','$tipo')");

     if($sql){
        echo '<script>alert("Usuario registrado exitosamente");</script>';
        echo '<script>setTimeout(function() { window.location.href = "gestionar_adm.php"; }, 1000);</script>';
        //header("Location: ../html/sistema_adm/gestionar_adm/gestionar_adm.php");
     } else{
        die("Error en la inserción de la solicitud: " . $conexion->error);
     }

      exit();
   }

  }else{

  }
}

?>