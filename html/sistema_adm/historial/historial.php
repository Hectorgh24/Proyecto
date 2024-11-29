<?php
session_start();
include "../../../php/archivo.php";
?>


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
   <style>
    .tabs .indicator {
    background-color: #1565c0; /* Color personalizado, aquí un naranja */
    }

    .tabs {
    background-color: white; /* Color gris claro como ejemplo */
    }   

    /* Cambiar el color de fondo de la pestaña activa */
    .tabs .tab a.active {
        background-color: #e3eaf1; /* Verde para la pestaña activa */
        color: #ffffff; /* Texto blanco para mejor visibilidad */
    }

   </style>

   <title>Historial</title>
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
                <li><a href="../inicio/inicio.php">Inicio</a></li>
                <li><a href="../solicitudes/solicitudes.php">Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
                <li><a href="../recursos/recursos.php">Recursos</a></li>
                <li><a href="../estadisticas/estadisticas.php">Estadísticas</a></li>
                <li><a href="historial.php">Historial</a></li>
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
        <li><a class="waves-effect default" href="../inicio/inicio.php"><i class="material-icons">home</i>Inicio</a></li>
        <li><a class="waves-effect default" href="../solicitudes/solicitudes.php"><i class="material-icons">assignment</i>Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
        <li><a class="waves-effect default" href="../recursos/recursos.php"><i class="material-icons">devices</i>Recursos</a></li>
        <li><a class="waves-effect default" href="../estadisticas/estadisticas.php"><i class="material-icons">assessment</i>Estadísticas</a></li>
        <li><a class="waves-effect default" href="historial.php"><i class="material-icons">history</i>Historial</a></li>
        <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons">people</i>Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
        
    <div class="container">
        <h1>Historial</h1>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s6"><a href="#tab-accepted" class="blue-text text-darken-2">Aceptadas</a></li>
                    <li class="tab col s6"><a href="#tab-not-accepted" class="blue-text text-darken-2">No aceptadas</a></li>
                </ul>
            </div>
            <!-- Tab para solicitudes aceptadas -->
            <div id="tab-accepted" class="col s12">
                <ul class="collapsible" id="acceptedRequestList">
                    <?php
                    // Conexión a la base de datos y recuperación de solicitudes
                        include "../../../php/conexion_be.php";
                         $sql = $conexion->query("SELECT usuario.*, solicitud.* FROM usuario INNER JOIN solicitud ON usuario.correo_institucional = solicitud.correo_usuario WHERE solicitud.estado='Aceptada' ORDER BY solicitud.id");
                         while($datos = $sql->fetch_object()) { ?>               
                    <li data-type="alumno">
                        <div class="collapsible-header">
                            <i class="material-icons">assignment</i>
                            Solicitud de equipo :&nbsp;<?= $datos->id ?></p> 
                            <i class="material-icons right">arrow_drop_down</i>
                        </div>

                        <div class="collapsible-body">
                            <p><strong>Tipo de Usuario:</strong><?= $datos->tipo_usuario ?></p>
                            <p><strong>Nombre:</strong><?= $datos->nombre ?></p>
                            <p><strong>Apellido Paterno:</strong><?= $datos->apellido_paterno ?></p>
                            <p><strong>Apellido Materno:</strong><?= $datos->apellido_materno ?></p>
                            <p><strong>Correo del Usuario:</strong><?= $datos->correo_institucional ?></p>
                            <p><strong>Fecha de solicitud:</strong> <?= $datos->fecha_solicitud ?></p>
                            <p><strong>Hora de Inicio:</strong> <?= $datos->hora_inicio ?></p>
                            <p><strong>Hora Final:</strong> <?= $datos->hora_final ?></p>
                            <p><strong>Equipo:</strong> <?= $datos->equipo ?></p>
                            <p><strong>Espacio de Uso:</strong> <?= $datos->espacio_uso ?></p>
                            <p><strong>Estado de Solicitud:</strong> <?= $datos->estado ?></p>
                        <div class="card-action">
                            <!-- <a href="../../../php/aceptar_solicitud.php?id=<?= $datos->id ?>" class="btn green waves-effect waves-light" class="btn btn-small btn-warning" >Aceptar</a> --> 
                            <a href="../../../php/eliminar_solicitud2.php?id=<?= $datos->id ?>" onclick="return eliminar()" class="btn red waves-effect waves-light" class="btn btn-samll btn-danger">Eliminar</a>
                            </div>
                    </li>
                
                  <?php } 
                     $conexion->close();
                  ?>
                </ul>
            </div>
        
            <!-- Tab para solicitudes no aceptadas -->
            <div id="tab-not-accepted" class="col s12">
                <ul class="collapsible" id="notAcceptedRequestList">
                <?php
                    // Conexión a la base de datos y recuperación de solicitudes
                        include "../../../php/conexion_be.php";
          
                         $sql = $conexion->query("SELECT usuario.*, solicitud.* FROM usuario INNER JOIN solicitud ON usuario.correo_institucional = solicitud.correo_usuario WHERE solicitud.estado='Rechazada' ORDER BY solicitud.id");
                         while($datos = $sql->fetch_object()) { ?>               
                    <li data-type="alumno">
                        <div class="collapsible-header">
                            <i class="material-icons">assignment</i>
                            Solicitud de equipo :&nbsp;<?= $datos->id ?></p> 
                            <i class="material-icons right">arrow_drop_down</i>
                        </div>

                        <div class="collapsible-body">
                            <p><strong>Tipo de Usuario:</strong><?= $datos->tipo_usuario ?></p>
                            <p><strong>Nombre:</strong><?= $datos->nombre ?></p>
                            <p><strong>Apellido Paterno:</strong><?= $datos->apellido_paterno ?></p>
                            <p><strong>Apellido Materno:</strong><?= $datos->apellido_materno ?></p>
                            <p><strong>Correo del Usuario:</strong><?= $datos->correo_institucional ?></p>
                            <p><strong>Fecha de solicitud:</strong> <?= $datos->fecha_solicitud ?></p>
                            <p><strong>Hora de Inicio:</strong> <?= $datos->hora_inicio ?></p>
                            <p><strong>Hora Final:</strong> <?= $datos->hora_final ?></p>
                            <p><strong>Equipo:</strong> <?= $datos->equipo ?></p>
                            <p><strong>Espacio de Uso:</strong> <?= $datos->espacio_uso ?></p>
                            <p><strong>Estado de Solicitud:</strong> <?= $datos->estado ?></p>
                        <div class="card-action">

                            <!-- <a href="../../../php/aceptar_solicitud.php?id=<?= $datos->id ?>" class="btn green waves-effect waves-light" class="btn btn-small btn-warning" >Aceptar</a> --> 
                            <a href="../../../php/eliminar_solicitud2.php?id=<?= $datos->id ?>" onclick="return eliminar()" class="btn red waves-effect waves-light" class="btn btn-samll btn-danger">Eliminar</a> 
                        </div>
                    </li>
                
                  <?php } 
                     $conexion->close();
                  ?>
                </ul>
            </div>

        </div>
    </div>
        
        <script>
            // Inicializar las pestañas y collapsible
            document.addEventListener('DOMContentLoaded', function() {
                var tabs = document.querySelectorAll('.tabs');
                M.Tabs.init(tabs);
        
                var collapsibles = document.querySelectorAll('.collapsible');
                M.Collapsible.init(collapsibles);
            });
        </script>
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/sistema_adm/inicio/inicio.js"></script>
</body>
</html>