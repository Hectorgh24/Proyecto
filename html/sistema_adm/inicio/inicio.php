<?php
   session_start(); 
   include "../../../php/archivo.php";
?>

<!-- fichero inicio.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

   <!-- Compiled and minified JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   
   <link rel="stylesheet" type="text/css" href="../../../css/sistema_adm/inicio/inicio.css">

   <title>Inicio</title>
</head>
<body>
    <ul id="dropdown1" class="dropdown-content">
        <li><a class="waves-effect default" href="../gestionar_adm/gestionar_adm.php"><i class="material-icons">security</i>Gestionar</a></li>
        <li class="divider"></li>
        <li><a class="waves-effect default" href="../../../php/cerrar_sesion.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
    </ul>

    <div class="top-bar">
        <span>Universidad Veracruzana</span>
    </div>

    <nav class="navbar blue darken-3">
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="waves-effect default" href="../gestionar_adm/gestionar_adm.php"><i class="material-icons">security</i>Gestionar</a></li>
            <li class="divider"></li>
            <li><a class="waves-effect default" href="../../../php/cerrar_sesion.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
        </ul>
        
        <div class="nav-wrapper">
            <a class="brand-logo">UV</a>

            <a href="#" class="sidenav-trigger" data-target="mobile-nav">
                <i class="material-icons">menu</i>
            </a>

            <ul class="right hide-on-med-and-down">
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="../solicitudes/solicitudes.php">Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
                <li><a href="../recursos/recursos.php">Recursos</a></li>
                <li><a href="../estadisticas/estadisticas.php">Estadísticas</a></li>
                <li><a href="../historial/historial.php">Historial</a></li>
                <li><a class="dropdown-trigger" data-target="dropdown1">Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-nav">
        <li><div class="user-view">
            <div class="background">
              <img src="../../../img/sistema_adm/inicio/portada.png">
            </div>
            <img class="circle" src="../../../img/sistema_adm/inicio/uv_profile.png">
            <?php
             include "../../../php/conexion_be.php";
             $correog = $_SESSION['usuario'];
             $contrasenag = $_SESSION['contrasena_user'];
             $sql = $conexion->query("SELECT * FROM usuario WHERE correo_institucional='$correog' AND contrasena='$contrasenag'");
             while($datos = $sql->fetch_object()) { ?> 
            <span class="white-text name"><?=$datos->apellido_paterno?>&nbsp;<?=$datos->apellido_materno?>&nbsp;<?=$datos->nombre?></span>
            <span class="white-text email"><?=$datos->correo_institucional?></span>
            <?php }
              $conexion->close();
            ?> 
          </div>
        </li>
        <li><a class="waves-effect default" href="inicio.php"><i class="material-icons">home</i>Inicio</a></li>
        <li><a class="waves-effect default" href="../solicitudes/solicitudes.php"><i class="material-icons">assignment</i>Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
        <li><a class="waves-effect default" href="../recursos/recursos.php"><i class="material-icons">devices</i>Recursos</a></li>
        <li><a class="waves-effect default" href="../estadisticas/estadisticas.php"><i class="material-icons">assessment</i>Estadísticas</a></li>
        <li><a class="waves-effect default" href="../historial/historial.php"><i class="material-icons">history</i>Historial</a></li>
        <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons">people</i>Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>



    <div class="container">
        <h1>Inicio</h1>
        <!--<div class="card">
            <div class="card-content">
                <span class="card-title">¡Bienvenido!</span>
                <p><strong>Nombre:</strong> Julián Jiménez Christian</p>
                <p><strong>Email:</strong> micorreo@uv.mx</p>
                <p><strong>Tipo:</strong> Técnico Académico</p>
            </div>
        </div>
    -->

        <div class="card">
            <?php
             include "../../../php/conexion_be.php";
             $correog = $_SESSION['usuario'];
             $contrasenag = $_SESSION['contrasena_user'];
             $sql = $conexion->query("SELECT * FROM usuario WHERE correo_institucional='$correog' AND contrasena='$contrasenag'");
             while($datos = $sql->fetch_object()) { ?> 
            <div class="card-content">
            <span class="card-title">Bienvenido,<?=$datos->nombre?>&nbsp;<?=$datos->apellido_paterno?>&nbsp;<?=$datos->apellido_materno?>!</span>
            <p>Estamos encantados de tenerte aquí. Desde este panel podrás gestionar todas tus solicitudes y acceder a los recursos disponibles.</p>
            </div>
            <?php }
            $conexion->close();
            ?>  
            <div class="card-action">
                <a href="../solicitudes/solicitudes.php" class="blue-text">Ver Solicitudes</a>
                <a href="../gestionar_adm/gestionar_adm.php" class="blue-text">Gestionar administradores</a>
            </div>
        </div>

        <div class="carousel carousel-slider center">
            <!--<div class="carousel-fixed-item center">
                <a class="btn waves-effect white grey-text darken-text-2">Vamos</a>
            </div>-->
            <div class="carousel-item blue darken-3 white-text" href="#one!">
                <h2>Conoce el Sistema</h2>
                <p class="white-text">Aquí podrás realizar diversas tareas relacionadas con las solicitudes de equipos, administración de recursos, consulta de estadísticas, y más. Navega a través de las características para conocer más.</p>
            </div>
            <div class="carousel-item red darken-1 white-text" href="#two!">
                <h2>Gestión de Solicitudes</h2>
                <p class="white-text">Los estudiantes y profesores realizan solicitudes de equipos. Los administradores podrán revisar, aprobar o rechazar solicitudes según la disponibilidad de recursos</p>
            </div>
            <div class="carousel-item amber darken-1 white-text" href="#three!">
                <h2>Gestión de Recursos</h2>
                <p class="white-text">Administra todos los recursos del centro de cómputo de la universidad, como equipos de cómputo, proyectores y otros dispositivos. Los administradores pueden ver los recursos disponibles</p>
            </div>
            <div class="carousel-item  green darken-1 white-text" href="#four!">
                <h2>Estadísticas del Sistema</h2>
                <p class="white-text">Obtén información detallada sobre las solicitudes, uso de recursos y otros indicadores clave. Las estadísticas permiten un análisis profundo de la actividad y te ayudan a tomar decisiones informadas para mejorar la eficiencia del sistema.</p>
            </div>
            <div class="carousel-item deep-purple darken-1 white-text" href="#five!">
                <h2>Historial de solicitudes</h2>
                <p class="white-text">Consulta el historial completo de las solicitudes realizadas por los usuarios. Permitiendo un fácil seguimiento de las solicitudes pasadas y la planificación para el futuro.</p>
            </div>
            <div class="carousel-item purple darken-1 white-text" href="#six!">
                <h2>Gestión de Administradores</h2>
                <p class="white-text">Permite a los administradores gestionar las cuentas de los usuarios con permisos de administración. Se pueden agregar, editar y eliminar administradores, garantizando un control adecuado sobre el acceso al sistema.</p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.carousel.carousel-slider').carousel({
                fullWidth: true,
                indicators: true
            });
            // Inicia el carrusel automáticamente
            setInterval(() => {
                $('.carousel').carousel('next');
            }, 6000); // Cambia de panel cada 4 segundos
        });
    </script>

    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/sistema_adm/inicio/inicio.js"></script>
</body>
</html>