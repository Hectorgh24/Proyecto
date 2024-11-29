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
    <link rel="stylesheet" type="text/css" href="../../../css/solicitudes/solicitud_alumno/solicitud_alumno.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Solicitud Alumno</title>
</head>
<body>
    <div class="container form-container">

        <h5 class="center-align">Solicitud Alumno</h5>
            <!-- para incluir la conexion y el archivo de registro alumno-->
            
        <?php 
         include "../../../php/conexion_be.php";
         include "../../../php/registro_alumno.php";
        ?>
         <!-- Formulario de las solicitudes de los alumnos-->
          
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
                <input type="email" id="correo" required name="correo" value="<?=$datos->correo_institucional?>">
                <label for="correo">Correo Institucional</label>
            </div>
            <?php } 
              $conexion->close();
             ?>

            <div class="input-field">
                <select id="programa" required name="programa">
                    <option value="" disabled selected>Seleccionar programa</option>
                    <option value="cienciadatos">Lic. en Ingeniería en Ciencia de Datos</option>
                    <option value="software">Lic. en Ingeniería de Software</option>
                    <option value="ciberseguridad">Lic. en Ingeniería de Ciberseguridad e Infraestructura de Cómputo</option>
                    <option value="ingenieria">Lic. en Ingeniería en Sistemas y Tecnologías de la Información</option>
                    <option value="tecnologias">Lic. Tecnologías Computacionales</option>
                    <option value="redes">Lic. en Redes y Servicios de Cómputo</option>
                    <option value="estadistica">Lic. en Estadística</option>
                </select>
                <label>Programa Educativo</label>
            </div>
            <div class="input-field">
              <select id="equipo" required name="equipo">
                <option value="" disabled selected>Seleccionar equipo</option>
                <option value="pc">PC Escritorio</option>
                <option value="laptop">Laptop</option>
              </select>
              <label>Equipo</label>
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
                <label for="hora-entrada">Hora de entrada</label>
            </div>
            <div class="input-field">
                <input type="text" class="timepicker" id="hora-salida" required disabled name="horasalida">
                <label for="hora-salida">Hora de salida</label>
            </div>


            <div class="row center">
              <button type="submit" class="waves-effect waves-light btn green darken-2" value="ok" id="submit-btn" name="btnregistrar">Enviar Solicitud</button>
              <button onclick="location.href='../../../index.php'" type="submit" class="waves-effect waves-light btn red darken-2" id="submit-btn2">Cancelar</button>  
              <!--<a class="btn red" href="../../../index.php">Cancelar</a> -->
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
            document.getElementById("submit-btn2").style.display = "none";
            document.getElementById("preloader").style.display = "block";
        });
    </script>
    
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/solicitudes/solicitud_alumno/solicitud_alumno.js"></script> 
</body>
</html>
