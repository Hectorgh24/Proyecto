<?php 
  session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/solicitudes/solicitud_academico/solicitud_academico.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

    <title>Solicitud Académico</title>

</head>
<body>
    <div class="container form-container">

        <h5 class="center-align">Solicitud Académico</h5>

        
            
        <?php 
         include "../../../php/conexion_be.php";
         include "../../../php/registro_profesor.php";
        ?>

        <form method="POST" id="solicitud-form">
             <?php
             $correog = $_SESSION['usuario'];
             $contrasenag = $_SESSION['contrasena_user'];
             $sql = $conexion->query("SELECT * FROM usuario WHERE correo_institucional='$correog' AND contrasena='$contrasenag' ");
             while($datos = $sql->fetch_object()) { ?> 
            <div class="input-field">
                <input type="text" id="nombre" required name="nombre" value="<?=$datos->nombre?>">
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field">
                <input type="email" id="matricula" required  name="correo" value="<?=$datos->correo_institucional?>">
                <label for="matricula">Correo</label>
            </div>
            <?php } 
              $conexion->close();
             ?>
            <div class="input-field">
              <select id="equipo" required name="equipo">
                <option value="" disabled selected>Seleccionar equipo</option>
                <option value="pc">PC Escritorio</option>
                <option value="laptop">Laptop</option>
                <option value="proyector">Proyector</option>
                <option value="camara">Cámara</option>
                <option value="especializado">Equipo especializado</option>
              </select>
              <label>Equipo</label>
            </div>
            
            <!-- Nuevo campo para el equipo especializado, inicialmente oculto -->
            <div class="input-field" id="especializado-detalle" style="display: none;">
                <input type="text" id="detalle-equipo" name="detalle_equipo">
                <label for="detalle-equipo">Detalle del equipo especializado</label>
            </div>
            
            <div class="input-field">
                <input id="input_text" type="text" data-length="20" name="espacio">
                <label for="input_text">Espacio donde se usará el equipo</label>
            </div>
          
            <div class="input-field">
                <input type="text" class="datepicker" id="fecha" required name="fechasolicitud">
                <label for="fecha">Fecha de Solicitud</label>
            </div>
            <div class="input-field">
                <input type="text" class="timepicker" id="hora-entrada" required name="horaentrada">
                <label for="hora-entrada">Hora de inicio de solicitud</label>
            </div>
            <div class="input-field">
                <input type="text" class="timepicker" id="hora-salida" required name="horasalida">
                <label for="hora-salida">Hora de fin de solicitud</label>
            </div>
            <div class="row center">
              <button type="submit" class="waves-effect waves-light btn green darken-2" id="submit-btn" value="ok" name="btnregistrar">Enviar Solicitud</button>
              <a class="btn red" href="../../../index.php">Cancelar</a>
            </div>
             
             <!--Parte de la animacion de carga que se mostrata antes de enviar la consulta   -->
            <div class="row center" id="preloader" style="display: none;">
                <div class="preloader-wrapper active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Estamos enviando tu solicitud...</p>
            </div>
            
        </form>
    </div>

    <script>
        document.getElementById("solicitud-form").addEventListener("submit", function() {
            // Mostrar el preloader y ocultar el botón de enviar
            document.getElementById("submit-btn").style.display = "none";
            document.getElementById("preloader").style.display = "block";
        });
    </script>
    

    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/solicitudes/solicitud_academico/solicitud_academico.js"></script>
</body>
</html>
