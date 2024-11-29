
<!--fichero index.php -->
<?php
    session_start();
 /*
    if(isset($_SESSION['usuario'])) {
    header("location: ./html/sistema_adm/inicio/inicio.php");
    exit();
    }
*/

    if (isset($_SESSION['usuario']) && $_SESSION['type_user'] !== "alumno" && $_SESSION['type_user'] !== "profesor" && $_SESSION['type_user'] !== "jefe_centro_computo") {
      header("location: html/sistema_adm/menu_opciones/menu_tecnico_academico.html");
      exit();
    }
    
    if (isset($_SESSION['usuario']) && $_SESSION['type_user'] !== "alumno" && $_SESSION['type_user'] !== "profesor" && $_SESSION['type_user'] !== "tecnico_academico"){
      header("location: html/sistema_adm/inicio/inicio.php");
      exit();
    }
      
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/inicio_sesion/inicio_sesion.css">
  <!--<link rel="stylesheet" href="../../css/inicio_sesion/inicio_sesion.css"> -->
   <!-- Compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

   <!-- Compiled and minified JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   
  <title>Iniciar Sesión</title>
  
</head>
<body>
<!-- Div padre que envuelve todo el formulario de login -->
<div class="login">
    <form class="formulario_login" action="./php/login_usuario_be.php" method="POST" class="login" id="loginForm">
        <!-- Div que contiene el logo -->
    <div class="row">
      <div class="logo"></div> <!-- Logo de la página -->
    </div>

    <!-- Div para los títulos de la sección de inicio de sesión -->
    <div class="row center">
      <h5>Iniciar Sesión</h5> <!-- Título principal -->
      <h6>Utiliza tu cuenta institucional UV</h6> <!-- Subtítulo -->
    </div>

    <!-- Div que contiene el formulario -->
    <div class="row">
      <form>

        <!-- Div para el campo de correo electrónico -->
        <div class="input-field col s12">
          <input type="email" class="validate" id="email_input" name="correo"> <!-- Campo para ingresar el correo -->
          <label for="email_input">Correo</label> <!-- Etiqueta para el campo de correo -->
        </div>

    </div>

    <!-- Div para el campo de contraseña y el enlace para recuperar contraseña -->
    <div class="row">
      <div class="input-field col s12">
        <input type="password" id="password_input" class="validate" name="contrasena"> <!-- Campo para ingresar la contraseña -->
        <label for="password_input">Contraseña</label> <!-- Etiqueta para el campo de contraseña -->

        <!-- Div para el enlace de recuperación de contraseña -->
        <div>
         <a href="https://dsia.uv.mx/cuentas/modicont/inicio"><b>Olvidé mi contraseña</b></a>
        </div>

      </div>

      <!-- Div para información adicional con un enlace -->
      <div class="row">
        <div class="col s12">
          ¿Necesitas información?
          <a href="#">Aprende aquí</a> <!-- Enlace a información adicional -->
        </div>
      </div>

      <!-- Div vacío para posibles separaciones o espacios -->
      <div class="row"></div>

      <!-- Div para el botón de iniciar sesión -->
      <div class="row center">
        <div class="col s12">
          <button id="login_btn" type="submit" class="waves-effect waves-light btn green darken-2">Iniciar Sesión</button>
          <!-- se comento porque no funciona con el componente a y no es correcto
          <a href="./inicio_adm.html" class="waves-effect waves-light btn green darken-2">Iniciar Sesión</a>  Botón de inicio de sesión 
          -->
        </div>
      </div>

    </div> <!-- Cierra el div que contiene el formulario -->
    </form><!--Contiene todos los elementos -->
  </div> <!-- Cierra el div padre "login" -->

  <!-- Enlace al archivo de javaScript  -->
  <script>
  document.getElementById('loginForm').addEventListener('submit', function(event) {
    // Obtener los valores de los campos
    const email = document.getElementById('email_input').value.trim();
    const password = document.getElementById('password_input').value.trim();

    // Verificar si los campos están vacíos
    if (email === '' || password === '') {
      event.preventDefault(); // Prevenir el envío del formulario
      M.toast({html: 'Por favor, complete todos los campos.', classes: 'red'}); // Mostrar el toast
    } 
    
    // Validar el dominio del correo
    let tipo_correo = '';
    for (let i = 0; i < email.length; i++) {
      if (email[i] === '@') {
        tipo_correo = email.substring(i); // Extraer el dominio desde el arroba
        break; // Salir del bucle al encontrar el '@'
      }
    }

    // Verificar el tipo de correo
    if (tipo_correo !== "@estudiantes.uv.mx" && tipo_correo !== "@uv.mx") {
      event.preventDefault(); // Prevenir el envío del formulario
      M.toast({html: 'Ingresa un correo institucional valido.', classes: 'red'}); // Mostrar el toast
      return; // Salir de la función
    }


  });
</script>

<script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>

</body>
</html>
