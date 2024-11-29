<?php

/*se crea una variable con $ y en esta variable se esta almacenando  */
/*Tiene que estar correctamente escritos todos los datos y tiene que ser puerto,nombre_usuario_contraseña y nombre de base de datos.
En este caso al instalar XAMPP por defecto el usuario es root y no tiene contraseña */


$servidor = "localhost";  // o la dirección IP de tu servidor de base de datos
$usuario = "root";        // tu usuario de base de datos
$contrasena = "";           // tu contraseña de base de datos
$base_datos = "db_proyecto";  // el nombre de la base de datos que estás usando
//puerto en este caso si es el de por defecto no es necesario ponerlo pero como instale MySQL Workbentch tuve que poner el puerto que puse
$puerto = 3307;
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $base_datos, $puerto);
$conexion->set_charset("utf8");

/* se comento porque lo estara mostrando cada vez que nos conectemos y es para pruebas de que todo funciona bien
if($conexion){ en caso de que tenga la conexion 
     es como un alert de javaScript , imprime un texto en la pantalla
 echo 'conectado exitosamente a la Base de Datos';
} else{
    echo 'No se pudo conectar a la base de datos';
}
*/
/*
if($conexion){  
echo 'conectado exitosamente a la Base de Datos';
} else{
   echo 'No se pudo conectar a la base de datos';
}
*/

// Comprobar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>