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
                <li><a href="../inicio/inicio.php">Inicio</a></li>
                <li><a href="../solicitudes/solicitudes.php">Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
                <li><a href="recursos.php">Recursos</a></li>
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
        <li><a class="waves-effect default" href="../inicio/inicio.php"><i class="material-icons">home</i>Inicio</a></li>
        <li><a class="waves-effect default" href="../solicitudes/solicitudes.php"><i class="material-icons">assignment</i>Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
        <li><a class="waves-effect default" href="recursos.php"><i class="material-icons">devices</i>Recursos</a></li>
        <li><a class="waves-effect default" href="../estadisticas/estadisticas.php"><i class="material-icons">assessment</i>Estadísticas</a></li>
        <li><a class="waves-effect default" href="../historial/historial.php"><i class="material-icons">history</i>Historial</a></li>
        <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons">people</i>Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
    <div class="container">
        <h1>Recursos</h1>
        <div class="divider"></div> 
        <!-- Sección para Estudiantes -->
        <h4>Equipos Disponibles para Estudiantes</h4>
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/laptop.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Laptops<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Equipos portátiles para trabajos académicos, investigaciones y presentaciones. Ejemplos disponibles incluyen:
                            <ul>
                                <li>Lenovo ThinkPad E14</li>
                                <li>Dell Inspiron 3501</li>
                                <li>HP Pavilion x360</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/desktop.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">PC de Escritorio<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Computadoras de alto rendimiento para edición, diseño y programación. Ejemplos disponibles incluyen:
                            <ul>
                                <li>HP EliteDesk 800 G5</li>
                                <li>Dell OptiPlex 5070</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Más tarjetas para estudiantes según sea necesario -->
        </div>

        <!-- Sección para Profesores -->
        <div class="divider"></div> 
        <h4>Equipos Disponibles para Profesores</h4>
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/laptop2.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Laptops<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Equipos portátiles para trabajos académicos, investigaciones y presentaciones. Ejemplos disponibles incluyen:
                            <ul>
                                <li>Lenovo ThinkPad E14</li>
                                <li>Dell Inspiron 3501</li>
                                <li>HP Pavilion x360</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/desktop2.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">PC de Escritorio<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Computadoras de alto rendimiento para edición, diseño y programación. Ejemplos disponibles incluyen:
                            <ul>
                                <li>HP EliteDesk 800 G5</li>
                                <li>Dell OptiPlex 5070</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/camara.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Cámaras<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Cámaras digitales para documentación de eventos y clases prácticas. Ejemplos disponibles incluyen:
                            <ul>
                                <li>Canon EOS Rebel T7</li>
                                <li>Nikon D3500</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/proyector.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Proyectores<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Proyectores para presentaciones en clases y eventos académicos. Ejemplos disponibles incluyen:
                            <ul>
                                <li>Epson PowerLite X49</li>
                                <li>BenQ MS535A</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="../../../img/sistema_adm/recursos/router.webp">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Routers<i class="material-icons right">more_vert</i></span>
                        <p><a href="tel:01 228 8421700">Reportar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Detalles<i class="material-icons right">close</i></span>
                        <p>Funcionalidad: Proveer conectividad de red de alta velocidad y seguridad para facilitar el acceso a internet y el trabajo en red de los dispositivos en el centro de cómputo. Ejemplo disponibles incluyen:</p>
                        <ul>
                            <li>Cisco Catalyst 9000</li>
                            <li>TP-Link Archer AX6000</li>
                            <li>Netgear Nighthawk AX12</li>
                        </ul>

                    </div>
                </div>
            </div>
            <!-- Más tarjetas para profesores según sea necesario -->
        </div>
                
    </div>
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/sistema_adm/recursos/recursos.js"></script>
</body>
</html>