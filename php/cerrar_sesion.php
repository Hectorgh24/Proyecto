<!--fichero cerrar_sesion.php -->

<?php

/*siempre que se va a trabajar con la session se tiene que trabajar */
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy();
header("location: ../index.php");
exit();
?>
