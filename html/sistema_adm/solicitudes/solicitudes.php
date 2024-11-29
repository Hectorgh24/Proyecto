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

   <title>Solicitudes</title>
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
                <li><a href="solicitudes.php">Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
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
        <li><a class="waves-effect default" href="../inicio/inicio.php"><i class="material-icons">home</i>Inicio</a></li>
        <li><a class="waves-effect default" href="solicitudes.php"><i class="material-icons">assignment</i>Solicitudes<span class="new badge red" data-badge-caption="+"><?php echo $pendientes; ?></span></a></li>
        <li><a class="waves-effect default" href="../recursos/recursos.php"><i class="material-icons">devices</i>Recursos</a></li>
        <li><a class="waves-effect default" href="../estadisticas/estadisticas.php"><i class="material-icons">assessment</i>Estadísticas</a></li>
        <li><a class="waves-effect default" href="../historial/historial.php"><i class="material-icons">history</i>Historial</a></li>
        <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons">people</i>Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
    <div class="container">
        <h1>Solicitudes</h1>
        <div class="input-field col s12">
            <select id="filterSelect" name="usuarioescogido">
                <option value="all" selected>Todas</option> <!-- Nueva opción para mostrar todas -->
                <option value="alumno">Alumnos</option>
                <option value="academico">Académicos</option>
                <option value="tecnico">Técnico Académico</option>
            </select>
            <label>Selecciona un tipo</label>
        </div>
        
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
        <script type="text/javascript">
        emailjs.init('-wFB8OHqlUmAXLkeq'); // Inicializa emailjs con tu clave pública
        
        function sendEmail(name, paternalSurname, maternalSurname, email, equipment, id) {
        var template;
        
         
        // Validar el dominio del correo
        var tipo_correo = email;
        for (let i = 0; i < email.length; i++) {
        if (email[i] === '@') {
        tipo_correo = email.substring(i); // Extraer el dominio desde el arroba
        break; // Salir del bucle al encontrar el '@'
        }
        }

        // Verificar el tipo de correo
        if (tipo_correo == "@estudiantes.uv.mx" ){
          template = "template_xy2nxsb";
        } else if(tipo_correo == "@uv.mx"){
          template = "template_s1pxvax";
        }
        

        emailjs.send("service_ouum60t", template, {
            emailjs_name: name,
            emailjs_Paternalsurname: paternalSurname,
            emailjs_Maternalsurname: maternalSurname,
            emailjs_email: email,
            emailjs_equipment: equipment
        }).then(function(response) {
            console.log("Correo enviado", response.status, response.text);
            // Redirige a la URL de aceptar solicitud solo si el correo se envió correctamente
            window.location.href = "../../../php/aceptar_solicitud.php?id=" + id;
        }, function(error) {
            console.log("Error al enviar el correo", error);
            alert("No se pudo enviar el correo. Intenta nuevamente.");
        });
        }
        </script>

        
<ul class="collapsible" id="requestList">
    <?php
        include "../../../php/conexion_be.php";
        
        // Modificar la consulta para obtener todos los registros únicos y agrupar en un solo ciclo
        $sql = $conexion->query("SELECT usuario.*, solicitud.* FROM usuario 
                                 INNER JOIN solicitud ON usuario.correo_institucional = solicitud.correo_usuario 
                                 WHERE estado='Pendiente' ORDER BY solicitud.id");

        while($datos = $sql->fetch_object()) { 
            $data_type = '';
            // Asignar data-type según el tipo de usuario
            switch($datos->tipo_usuario) {
                case 'alumno':
                    $data_type = 'alumno';
                    break;
                case 'profesor':
                    $data_type = 'academico';
                    break;
                case 'tecnico_academico':
                    $data_type = 'tecnico';
                    break;
                default:
                    $data_type = 'all';
            }
    ?> 

    <li data-type="<?= $data_type ?>">
        <div class="collapsible-header">
            <i class="material-icons">assignment</i>
            Solicitud de equipo :<?= $datos->id ?> 
            <i class="material-icons right">arrow_drop_down</i>
        </div>
        <div class="collapsible-body">
            <p><strong>Tipo de Usuario:</strong> <?= $datos->tipo_usuario ?></p>
            <p><strong>Nombre:</strong> <?= $datos->nombre ?></p>
            <p><strong>Apellido Paterno:</strong> <?= $datos->apellido_paterno ?></p>
            <p><strong>Apellido Materno:</strong> <?= $datos->apellido_materno ?></p>
            <p><strong>Correo del Usuario:</strong> <?= $datos->correo_institucional ?></p>
            <p><strong>Fecha de solicitud:</strong> <?= $datos->fecha_solicitud ?></p>
            <p><strong>Hora de Inicio:</strong> <?= $datos->hora_inicio ?></p>
            <p><strong>Hora Final:</strong> <?= $datos->hora_final ?></p>
            <p><strong>Equipo:</strong> <?= $datos->equipo ?></p>
            <p><strong>Espacio de Uso:</strong> <?= $datos->espacio_uso ?></p>
            <p><strong>Estado de Solicitud:</strong> <?= $datos->estado ?></p>

            <input type="hidden" name="emailjs_name" id="emailjs_name" value="<?= $datos->nombre ?>">
            <input type="hidden" name="emailjs_Paternalsurname" id="emailjs_Paternalsurname" value="<?= $datos->apellido_paterno ?>">
            <input type="hidden" name="emailjs_Maternalsurname" id="emailjs_Maternalsurname" value="<?= $datos->apellido_materno ?>">
            <input type="hidden" name="emailjs_equipment" id="emailjs_equipment" value="<?= $datos->equipo ?>">

            <div class="card-action">
                <a href="javascript:void(0);" onclick="sendEmail('<?= $datos->nombre ?>', '<?= $datos->apellido_paterno ?>', '<?= $datos->apellido_materno ?>', '<?= $datos->correo_institucional ?>', '<?= $datos->equipo ?>', '<?= $datos->id ?>')" class="btn green waves-effect waves-light">Aceptar</a>
                <a href="../../../php/rechazar_solicitud.php?id=<?= $datos->id ?>" class="btn amber darken-4 waves-effect waves-light">Rechazar</a> 
                <a href="../../../php/eliminar_solicitud.php?id=<?= $datos->id ?>" onclick="return eliminar()" class="btn red waves-effect waves-light">Eliminar</a>
            </div>
        </div>
    </li>

    <?php 
        } 
        $conexion->close();
    ?>
</ul>

    </div>
      <script>

        function eliminar(){
            var respuesta = confirm("Estas seguro de que deseas eliminarla?");
            return respuesta;
        }

        function aceptar(){
            var respuesta = confirm("Estas seguro de que deseas eliminarla?");
            return respuesta;
        }

      </script>

    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/sistema_adm/solicitudes/solicitudes.js"></script>
</body>
</html>