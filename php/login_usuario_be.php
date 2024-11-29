
<!-- fichero login_usuario_be.php -->

<?php
session_start();


include '../php/conexion_be.php';

$correo = trim($_POST['correo']);
$contrasena = trim($_POST['contrasena']);
$longitud = strlen($correo);  // Obtener la longitud de la cadena
$tipo_correo = "";
$tipo_usuario = 0;
$tipo_usuario2 = "";
$ad = 1;


for($i=0;$i<$longitud; $i++){
  if($correo[$i] === '@'){
     $tipo_correo .= substr($correo, $i); // Extraer el dominio desde el arroba
     break; // Salir del bucle al encontrar el '@'
  }
}

/*
if($tipo_correo !== "@estudiantes.uv.mx" && $tipo_correo !== "@uv.mx"){
    echo 'Solo se pueden ingresar correos Estudiantiles o de personal de la UV';
    exit();
}
*/

if($tipo_correo === "@estudiantes.uv.mx"){
 $tipo_usuario = 1;
} else if($tipo_correo === "@uv.mx"){
 $tipo_usuario = 2;
}


$validar_login = null;

$sqlUsuario = mysqli_query($conexion, "SELECT tipo_usuario FROM usuario WHERE correo_institucional='$correo'");


if(mysqli_num_rows($sqlUsuario) > 0 ){
  $row = $sqlUsuario->fetch_assoc();
  $tipo_usuario2 = $row['tipo_usuario'];
}

if($tipo_usuario2 == "alumno"){
  $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo' AND contrasena='$contrasena' and tipo_usuario='$tipo_usuario2'");
} else if($tipo_usuario2 == "profesor"){
  $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo' AND contrasena='$contrasena' and tipo_usuario='$tipo_usuario2'");
} else if($tipo_usuario2 == "tecnico_academico"){
  $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo' AND contrasena='$contrasena' and tipo_usuario='$tipo_usuario2'");
} else if($tipo_usuario2 == "jefe_centro_computo"){
  $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo'  AND contrasena='$contrasena' and tipo_usuario='$tipo_usuario2'");
}
/*
// Realizar la consulta en función del tipo de usuario
if ($tipo_usuario === 1) {
    // Validar si es un alumno
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo' AND contrasena='$contrasena'");
} else if ($tipo_usuario === 2) {
    // Validar primero si es un profesor
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo' AND contrasena='$contrasena'");
    
    // Si no se encuentra en la tabla profesor, verificar si es un administrador
    if (mysqli_num_rows($validar_login) === 0) {
        $validar_login = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo_institucional='$correo' AND contrasena='$contrasena'");

    }
}
*/

// Verificar si la consulta tiene resultados
if (!$validar_login) {
    die('Error en la consulta: ' . mysqli_error($conexion));
}
    



if(mysqli_num_rows($validar_login) > 0){
  $_SESSION['usuario'] = $correo;
  $_SESSION['type_user'] = $tipo_usuario2; 
  $_SESSION['contrasena_user'] = $contrasena;

  //dependiendo del valor que tenga la variable del tipo de usuario va  a redirigir al formulario correspondiente
  if($tipo_usuario2 == "alumno"){
    header("location: ../html/solicitudes/solicitud_alumno/solicitud_alumno.php");
  } else if($tipo_usuario2 == "profesor"){
    header("location: ../html/solicitudes/solicitud_academico/solicitud_academico.php");
  } else if($tipo_usuario2 == "tecnico_academico"){
    header("location:  ../html/sistema_adm/menu_opciones/menu_tecnico_academico.html");
  } else if($tipo_usuario2 == "jefe_centro_computo"){
    header("location:  ../html/sistema_adm/inicio/inicio.php");
  }

  //para que termine la ejecucion del codigo de comparacion y no siga evaluando las credenciales
  exit();

} else{
   echo '<script>
   alert("Usuario no existe, por favor verifique los datos introducidos");
   window.location = "../index.php";
   </script>
   ';
  
   exit();
}
?>