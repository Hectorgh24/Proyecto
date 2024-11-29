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
   
   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script> -->



   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  



    <title>Estadísticas</title>
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
                <li><a href="../solicitudes/solicitudes.php">Solicitudes</a></li>
                <li><a href="../recursos/recursos.php">Recursos</a></li>
                <li><a href="estadisticas.php">Estadísticas</a></li>
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
        <li><a class="waves-effect default" href="../solicitudes/solicitudes.php"><i class="material-icons">assignment</i>Solicitudes</a></li>
        <li><a class="waves-effect default" href="../recursos/recursos.php"><i class="material-icons">devices</i>Recursos</a></li>
        <li><a class="waves-effect default" href="estadisticas.php"><i class="material-icons">assessment</i>Estadísticas</a></li>
        <li><a class="waves-effect default" href="../historial/historial.php"><i class="material-icons">history</i>Historial</a></li>
        <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons">people</i>Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
    <div class="container">
        <h1>Estadísticas</h1>
            <!-- Card con gráfico de ejemplo -->
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Resumen de Estadísticas</span>
                            <p>A continuación, se presentan las gráficas de asistencias, solicitudes y la distribución de uso de equipos.</p>
                            <ul>
                                <!--Cambialo por datos que consideres que se pueden recuperar -->
                                <li><strong>Total de Solicitudes Aceptadas en todo el tiempo:&nbsp;<strong id="cantidad_meses"></strong></strong></li>
                                <li><strong>Total de Solicitudes Rechazadas en todo el tiempo:&nbsp;<strong id="cantidad_meses2"></strong></strong></li>
                                <li><strong>Total de Solicitudes Realizadas por Licenciatura:&nbsp;<strong id ="cantidad_licenciatura"></strong></strong></li>
                                <li><strong>Total de Solicitudes Realizadas por Equipo:&nbsp;<strong id = "cantidad_equipo"></strong></strong></li>

                            </ul>
                            <button class="btn blue" onclick="generateReport()">
                                <i class="material-icons left">file_download</i> Descargar Informe
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>     

        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Gráfico de Solicitudes Aceptadas Realizadas cada mes</span>
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Gráfico de Solicitudes Rechazadas Realizadas cada mes</span>
                        <canvas id="attendanceChart2"></canvas>
                    </div>
                </div>
            </div>

            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Gráfico de Solicitudes Realizadas por Licenciatura</span>
                        <canvas id="requestsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Distribución de Uso de Equipos</span>
                        <canvas id="usagePieChart"></canvas>
                    </div>
                </div>
            </div>        
        </div>



    </div>
    
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@latest/dist/jspdf.plugin.autotable.min.js"></script>


    <!--Script para generar PDF-->    
     

    
    <!--Te pongo como se crean las gráficas con datos aleatorios, puedes elegir la que más se acomode a los datos que puedes extraer de la bd-->
    <?php
    include "../../../php/conexion_be.php";  
    $cantidad_meses = []; // Inicializar el arreglo para almacenar los resultados
    // Llenar el arreglo con los datos de cada mes
    for($i = 0; $i <= 11; $i++){
        $j=$i+1;
    $result = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE MONTH(fecha_solicitud) = $j AND estado = 'Aceptada'");
    if ($result && $row = $result->fetch_assoc()) {
    // Guardar el valor de la cantidad como un entero en el arreglo de $cantidad_meses
    $cantidad_meses[] = (int) $row['cantidad'];
    } else {
        // En caso de fallo en la consulta, asignar 0 al mes correspondiente
        $cantidad_meses[] = 0;
      }
    }
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_meses_json = json_encode($cantidad_meses);
    ?>

    <?php
    include "../../../php/conexion_be.php";  
    $cantidad_meses = []; // Inicializar el arreglo para almacenar los resultados
    // Llenar el arreglo con los datos de cada mes
    for($i = 0; $i <= 11; $i++){
        $j=$i+1;
    $result = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE MONTH(fecha_solicitud) = $j AND estado = 'Rechazada'");
    if ($result && $row = $result->fetch_assoc()) {
    // Guardar el valor de la cantidad como un entero en el arreglo de $cantidad_meses
    $cantidad_meses[] = (int) $row['cantidad'];
    } else {
        // En caso de fallo en la consulta, asignar 0 al mes correspondiente
        $cantidad_meses[] = 0;
      }
    }
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_meses2_json = json_encode($cantidad_meses);
    ?>
    

    <?php
    include "../../../php/conexion_be.php";  
    $cantidad_equipos = []; // Inicializar el arreglo para almacenar los resultados
    // Llenar el arreglo con los datos de cada mes
    
    $result1 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE equipo = 'pc' AND estado = 'Aceptada'");
    $result2 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE equipo = 'laptop' AND estado = 'Aceptada'");
    $result3 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE equipo = 'proyector' AND estado = 'Aceptada'");
    $result4 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE equipo = 'camara' AND estado = 'Aceptada'");
    $result5 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE equipo <> 'pc' AND equipo <> 'laptop' AND equipo <> 'proyector' AND equipo <> 'camara'  AND estado = 'Aceptada'");
    
    $resultados = [$result1,$result2,$result3,$result4,$result5];
    
    for($i=0;$i<=4;$i++){
        if ($resultados[$i] && $row = $resultados[$i]->fetch_assoc()) {
        // Guardar el valor de la cantidad como un entero en el arreglo de $cantidad_meses
        $cantidad_equipos[] = (int) $row['cantidad'];
        } 
    }
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_equipos_json = json_encode($cantidad_equipos);
    ?>
    
    <?php
    include "../../../php/conexion_be.php";  
    $cantidadMesesTotalesAceptadas;
    // Ejecuta la consulta
    $resultMesesTotales = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE  estado = 'Aceptada'");

    // Verifica que la consulta se ejecute correctamente y obtén el valor
    if ($resultMesesTotales && $row = $resultMesesTotales->fetch_assoc()) {
    $cantidadMesesTotalesAceptadas = (int) $row['cantidad']; // Solo guarda el valor como entero
    } else {
    $cantidadMesesTotalesAceptadas = 0; // En caso de error, asigna 0
    }
    
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_MesesTotalesAceptadas_json = json_encode($cantidadMesesTotalesAceptadas);
    ?>

    <?php
    include "../../../php/conexion_be.php";  
    $cantidadMesesTotalesNoAceptadas;
    // Ejecuta la consulta
    $resultMesesTotales = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE  estado = 'Rechazada'");

    // Verifica que la consulta se ejecute correctamente y obtén el valor
    if ($resultMesesTotales && $row = $resultMesesTotales->fetch_assoc()) {
    $cantidadMesesTotalesNoAceptadas = (int) $row['cantidad']; // Solo guarda el valor como entero
    } else {
    $cantidadMesesTotalesNoAceptadas = 0; // En caso de error, asigna 0
    }
    
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_MesesTotalesNoAceptadas_json = json_encode($cantidadMesesTotalesNoAceptadas);
    ?>

    <?php
    include "../../../php/conexion_be.php";  
    $cantidadLicenciaturasTotales;
    // Ejecuta la consulta
    $resultLT = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura <> 'Ninguna' AND estado = 'Aceptada'");

    // Verifica que la consulta se ejecute correctamente y obtén el valor
    if ($resultLT && $row = $resultLT->fetch_assoc()) {
    $cantidadLicenciaturasTotales = (int) $row['cantidad']; // Solo guarda el valor como entero
    } else {
    $cantidadLicenciaturasTotales = 0; // En caso de error, asigna 0
    }
    
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_licenciaturasTotales_json = json_encode($cantidadLicenciaturasTotales);
    ?>

    <?php
    include "../../../php/conexion_be.php";  
    $cantidadEquiposTotales;
    // Ejecuta la consulta
    $resultEQ = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE equipo IS NOT NULL AND estado = 'Aceptada'");

    // Verifica que la consulta se ejecute correctamente y obtén el valor
    if ($resultEQ && $row = $resultEQ->fetch_assoc()) {
    $cantidadEquiposTotales = (int) $row['cantidad']; // Solo guarda el valor como entero
    } else {
    $cantidadEquiposTotales = 0; // En caso de error, asigna 0
    }
    
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_EquiposTotales_json = json_encode($cantidadEquiposTotales);
    ?>




    <?php
    include "../../../php/conexion_be.php";  
    $cantidad_licenciaturas = []; // Inicializar el arreglo para almacenar los resultados
    // Llenar el arreglo con los datos de cada mes
    
    $result6 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'cienciadatos'  AND estado = 'Aceptada'");
    $result7 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'software' AND estado = 'Aceptada'");
    $result8 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'ciberseguridad' AND estado = 'Aceptada'");
    $result9 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'ingenieria' AND estado = 'Aceptada'");
    $result10 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'tecnologias' AND estado = 'Aceptada'");
    $result11 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'redes' AND estado = 'Aceptada'");
    $result12 = $conexion->query("SELECT COUNT(id) AS cantidad FROM solicitud WHERE licenciatura = 'estadistica' AND estado = 'Aceptada'");

    
    $resultados = [$result6,$result7,$result8,$result9,$result10,$result11,$result12];
    
    for($i=0;$i<=6;$i++){
        if ($resultados[$i] && $row = $resultados[$i]->fetch_assoc()) {
        // Guardar el valor de la cantidad como un entero en el arreglo de $cantidad_meses
        $cantidad_licenciaturas[] = (int) $row['cantidad'];
        } 
    }
    // Cerrar la conexión después de usarla
    $conexion->close();
    // Convertir el arreglo de PHP en formato JSON para usarlo en JavaScript
    $cantidad_licenciaturas_json = json_encode($cantidad_licenciaturas);
    ?>



    <script>
       // 1. Configuración del gráfico de Asistencias
    // Obtenemos el contexto del lienzo (canvas) donde se dibujará el gráfico
        var ctx1 = document.getElementById('attendanceChart').getContext('2d');
        
        // Obtener los datos generados en PHP
        var cantidadMeses = <?php echo $cantidad_meses_json; ?>;
        // Creamos una nueva instancia de un gráfico de tipo 'bar' (barras)
        var attendanceChart = new Chart(ctx1, {
            type: 'bar',  // Tipo de gráfico: 'bar' (barras)
            
            // Datos que se mostrarán en el gráfico
            data: {
                // Etiquetas para el eje X (meses)
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                
                
                // Conjunto de datos para las barras del gráfico
                datasets: [{
                    label: 'Solicitudes',  // Etiqueta que se mostrará en la leyenda
                    //data: [12, 19, 3, 5, 2],  // Datos de las asistencias por mes
                    data: cantidadMeses,
                    backgroundColor: 'rgba(33, 150, 243, 0.7)',  // Color de las barras (transparente)
                    borderColor: 'rgba(33, 150, 243, 1)',  // Color del borde de las barras
                    borderWidth: 1  // Ancho del borde de las barras
                    
                }]
            
            },
            
            // Opciones de configuración del gráfico
            options: {
                responsive: true,  // Hace que el gráfico sea responsivo a diferentes tamaños de pantalla
                scales: {
                    y: {
                        beginAtZero: true  // Hace que el eje Y comience desde cero
                    }
                }
            }
        });



        var ctx1 = document.getElementById('attendanceChart2').getContext('2d');
        
        // Obtener los datos generados en PHP
        var cantidadMeses2 = <?php echo $cantidad_meses2_json; ?>;
        // Creamos una nueva instancia de un gráfico de tipo 'bar' (barras)
        var attendanceChart = new Chart(ctx1, {
            type: 'bar',  // Tipo de gráfico: 'bar' (barras)
            
            // Datos que se mostrarán en el gráfico
            data: {
                // Etiquetas para el eje X (meses)
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                
                
                // Conjunto de datos para las barras del gráfico
                datasets: [{
                    label: 'Solicitudes',  // Etiqueta que se mostrará en la leyenda
                    //data: [12, 19, 3, 5, 2],  // Datos de las asistencias por mes
                    data: cantidadMeses2,
                    backgroundColor: 'rgba(33, 150, 243, 0.7)',  // Color de las barras (transparente)
                    borderColor: 'rgba(33, 150, 243, 1)',  // Color del borde de las barras
                    borderWidth: 1  // Ancho del borde de las barras
                    
                }]
            
            },
            
            // Opciones de configuración del gráfico
            options: {
                responsive: true,  // Hace que el gráfico sea responsivo a diferentes tamaños de pantalla
                scales: {
                    y: {
                        beginAtZero: true  // Hace que el eje Y comience desde cero
                    }
                }
            }
        });


        // 2. Configuración del gráfico de Solicitudes
        // Obtenemos el contexto del lienzo (canvas) para el gráfico de solicitudes
        var ctx2 = document.getElementById('requestsChart').getContext('2d');

        var cantidadLicenciaturas = <?php echo $cantidad_licenciaturas_json; ?>;

        // Creamos una nueva instancia de un gráfico de tipo 'line' (línea)
        var requestsChart = new Chart(ctx2, {
            type: 'pie',  // Tipo de gráfico: 'line' (línea)
            
            // Datos que se mostrarán en el gráfico
            data: {
                // Etiquetas para el eje X (meses)
                labels: [
                'Lic. en Ingeniería en Ciencia de Datos', 
                'Lic. en Ingeniería de Software', 
                'Lic. en Ingeniería de Ciberseguridad e Infraestructura de Cómputo', 
                'Lic. en Ingeniería en Sistemas y Tecnologías de la Información', 
                'Lic. Tecnologías Computacionales',
                'Lic. en Redes y Servicios de Cómputo',
                'Lic. en Estadística'
                ],
                // Conjunto de datos para la línea del gráfico
                datasets: [{
                    label: 'Solicitudes',  // Etiqueta que se mostrará en la leyenda
                    data: cantidadLicenciaturas,  // Datos de las solicitudes por mes
                    backgroundColor: [  // Colores de cada sección del pastel
                        'rgba(255, 99, 132, 0.7)',  // Color para la primera sección
                        'rgba(54, 162, 235, 0.7)',  // Color para la segunda sección
                        'rgba(255, 206, 86, 0.7)',  // Color para la tercera sección
                        'rgba(75, 192, 192, 0.7)',   // Color para la cuarta sección
                        'rgba(153, 102, 255, 0.7)',  // Color para la quinta sección (tono púrpura)
                        'rgba(255, 120, 86, 0.7)',    // Borde para la sexta sección (tono naranja oscuro)
                        'rgba(100, 100, 100, 0.7)'   // Borde para la séptima sección (tono gris oscuro)


                    ],  // Ancho de la línea
                    //fill: true  // Rellena el área debajo de la línea con color
                    borderColor: [  // Color de los bordes de cada sección
                        'rgba(255, 99, 132, 1)',  // Borde para la primera sección
                        'rgba(54, 162, 235, 1)',  // Borde para la segunda sección
                        'rgba(255, 206, 86, 1)',  // Borde para la tercera sección
                        'rgba(75, 192, 192, 1)',  // Borde para la cuarta sección
                        'rgba(153, 102, 255, 1)',  // Borde para la quinta sección (tono púrpura)
                        'rgba(255, 159, 64, 1)',   // Borde para la sexta sección (tono naranja)
                        'rgba(201, 203, 207, 1)'   // Borde para la séptima sección (tono gris claro)
                    ],
                    borderWidth: 1  // Ancho de los bordes de cada sección
                }]
            }, options: {
                responsive: true,  // Hace que el gráfico sea responsivo a diferentes tamaños de pantalla
                plugins: {
                    legend: {
                        position: 'top'  // Posición de la leyenda en la parte superior del gráfico
                    }
                }
            }

            

            /*
            // Opciones de configuración del gráfico
            options: {
        responsive: true,
        maintainAspectRatio: true,   // Mantiene la relación de aspecto
        aspectRatio: 0.8,            // Ajusta la relación de aspecto para aumentar la altura del gráfico
        layout: {
            padding: {
                bottom: 50           // Añade espacio adicional en la parte inferior para las etiquetas
            }
        },  // Hace que el gráfico sea responsivo a diferentes tamaños de pantalla
                scales: {
                    x: {
                    ticks: {
                    autoSkip: false,  // Muestra todas las etiquetas sin saltar ninguna
                    maxRotation: 45,  // Rota las etiquetas en el eje X a 45 grados
                    minRotation: 45   // Define el ángulo mínimo de rotación en 45 grados
                    }
                    },
                    y: {
                        beginAtZero: true  // Hace que el eje Y comience desde cero
                    }
                }
            }*/
        });
   
        // 3. Configuración del gráfico de Pastel (pie chart)
        // Obtenemos el contexto del lienzo (canvas) para el gráfico de pastel
        var ctx3 = document.getElementById('usagePieChart').getContext('2d');
        
        var cantidadEquipos = <?php echo $cantidad_equipos_json; ?>;
        // Creamos una nueva instancia de un gráfico de tipo 'pie' (pastel)
        var usagePieChart = new Chart(ctx3, {
            type: 'pie',  // Tipo de gráfico: 'pie' (pastel)
            
            // Datos que se mostrarán en el gráfico
            data: {
                // Etiquetas para cada sección del gráfico de pastel
                labels: ['PC Escritorio', 'Laptop', 'Proyector', 'Cámara','Otros'],
                
                // Conjunto de datos para el gráfico de pastel
                datasets: [{
                    label: 'Uso de Equipos',  // Etiqueta que se mostrará en la leyenda
                    data: cantidadEquipos,  // Datos del uso de equipos en porcentaje
                    backgroundColor: [  // Colores de cada sección del pastel
                        'rgba(255, 99, 132, 0.7)',  // Color para la primera sección
                        'rgba(54, 162, 235, 0.7)',  // Color para la segunda sección
                        'rgba(255, 206, 86, 0.7)',  // Color para la tercera sección
                        'rgba(75, 192, 192, 0.7)',   // Color para la cuarta sección
                        'rgba(153, 102, 255, 1)'  // Borde para la quinta sección (tono púrpura)
                    ],
                    borderColor: [  // Color de los bordes de cada sección
                        'rgba(255, 99, 132, 1)',  // Borde para la primera sección
                        'rgba(54, 162, 235, 1)',  // Borde para la segunda sección
                        'rgba(255, 206, 86, 1)',  // Borde para la tercera sección
                        'rgba(75, 192, 192, 1)',   // Borde para la cuarta sección
                        'rgba(153, 102, 255, 1)'  // Borde para la quinta sección (tono púrpura)
                    ],
                    borderWidth: 1  // Ancho de los bordes de cada sección
                }]
            },
            
            // Opciones de configuración del gráfico
            options: {
                responsive: true,  // Hace que el gráfico sea responsivo a diferentes tamaños de pantalla
                plugins: {
                    legend: {
                        position: 'top'  // Posición de la leyenda en la parte superior del gráfico
                    }
                }
            }
        });
        
       
       var cantidadMesesTotalesAceptadasN = <?php echo $cantidad_MesesTotalesAceptadas_json; ?>;
       var cantidadMesesTotalesNoAceptadasN = <?php echo $cantidad_MesesTotalesNoAceptadas_json; ?>;
       var cantidadLicenciaturasTotalesN = <?php echo $cantidad_licenciaturasTotales_json; ?>;
       var cantidadEquiposTotalesN = <?php echo $cantidad_EquiposTotales_json; ?>;
      
    
       var cantidadEquipoN = 0;
       for(var i=0;i<=5;i++){
        if(cantidadEquipos[i] != 0){
            cantidadEquipoN = cantidadEquipos[i];
            break;
        }
       }

        document.getElementById("cantidad_meses").textContent = cantidadMesesTotalesAceptadasN;
        document.getElementById("cantidad_meses2").textContent = cantidadMesesTotalesNoAceptadasN;
        document.getElementById("cantidad_licenciatura").textContent = cantidadLicenciaturasTotalesN;
        document.getElementById("cantidad_equipo").textContent = cantidadEquiposTotalesN;

        var contador = 0;
         function generateReport() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            

            // Títulos y otros datos
            doc.setFontSize(20);
            doc.text('Informe de Estadisticas de Solicitudes', 14, 10);

            doc.setFontSize(15);
            doc.text('Cantidad de Solicitudes Aceptadas por mes', 14, 20);
            

    
            var head = [['Mes', 'Cantidad']];
            var body =  [
            ['Enero', cantidadMeses[i]],
            
            ['Febrero',  cantidadMeses[i+1]],
            
            ['Marzo',  cantidadMeses[i+2]],
            
            ['Abril',  cantidadMeses[i+3]],
            
            ['Mayo',  cantidadMeses[i+4]],
            
            ['Junio',  cantidadMeses[i+5]],
            
            ['Julio',  cantidadMeses[i+6]],
            
            ['Agosto',  cantidadMeses[i+7]],
            
            ['Septiembre',  cantidadMeses[i+8]],
            
            ['Octubre',  cantidadMeses[i+9]],
          
            ['Noviembre',  cantidadMeses[i+10]],
           
            ['Diciembre',  cantidadMeses[i+11]],
        
        ];
            doc.autoTable({head: head, body: body, startY: 25 });

            var finalY = doc.previousAutoTable.finalY;
            contador = 0;
        
            doc.setFontSize(15);
            doc.text('Cantidad de Solicitudes Rechazadas por mes', 14, finalY+10);
            
            var head2 = [['Mes','Cantidad']];
            var body2 =  [
            ['Enero', cantidadMeses2[i]],
            
            ['Febrero',  cantidadMeses2[i+1]],
            
            ['Marzo',  cantidadMeses2[i+2]],
            
            ['Abril',  cantidadMeses2[i+3]],
            
            ['Mayo',  cantidadMeses2[i+4]],
            
            ['Junio',  cantidadMeses2[i+5]],
            
            ['Julio',  cantidadMeses2[i+6]],
            
            ['Agosto',  cantidadMeses2[i+7]],
            
            ['Septiembre',  cantidadMeses2[i+8]],
            
            ['Octubre',  cantidadMeses2[i+9]],
          
            ['Noviembre',  cantidadMeses2[i+10]],
           
            ['Diciembre',  cantidadMeses2[i+11]],
            ];

            doc.autoTable({head: head2, body: body2, startY: finalY + 15 });
            
            
            finalY = doc.previousAutoTable.finalY;
            contador = 0;
            // Título de la tercera tabla
            var titleY = finalY + 60;
            if (titleY + 10 > doc.internal.pageSize.height) {
            // Si el título está muy cerca del final de la página, saltar a la siguiente página
            doc.addPage();
            titleY = 20; // Reiniciar el valor Y en la nueva página
}

            doc.setFontSize(15);
            doc.text('Cantidad de Solicitudes Realizadas por Licenciatura ', 14, titleY);
            
            var head3 = [['Licenciatura','Cantidad']];
            var body3 =  [
            ['Lic. en Ingeniería en Ciencia de Datos', cantidadLicenciaturas[i]],
            
            ['Lic. en Ingeniería de Software',cantidadLicenciaturas[i+1]],
            
            ['Lic. en Ingeniería de Ciberseguridad e Infraestructura de Cómputo',  cantidadLicenciaturas[i+2]],
            
            ['Lic. en Ingeniería en Sistemas y Tecnologías de la Información',  cantidadLicenciaturas[i+3]],
            
            ['Lic. Tecnologías Computacionales',  cantidadLicenciaturas[i+4]],
            
            ['Lic. en Redes y Servicios de Cómputo',  cantidadLicenciaturas[i+5]],
            
            ['Lic. en Estadística',  cantidadLicenciaturas[i+6]],
            
            ];

            doc.autoTable({head: head3, body: body3, startY: titleY + 5 });

            finalY = doc.previousAutoTable.finalY;
            contador = 0;

            doc.setFontSize(15);
            doc.text('Cantidad de Solicitudes Realizadas por Equipo ', 14, finalY + 10);

            var head4 = [['Equipo','Cantidad']];
            var body4 =  [
            ['PC Escritorio', cantidadEquipos[i]],
            
            ['Laptop',cantidadEquipos[i+1]],
            
            ['Proyector',  cantidadEquipos[i+2]],
            
            ['Cámara',  cantidadEquipos[i+3]],
            
            ['Otros',  cantidadEquipos[i+4]]
              
            ];

            doc.autoTable({head: head4, body: body4, startY: finalY + 15 });
        
        // Guardar el PDF
        doc.save('informe_estadisticas.pdf');
    }

    </script>

    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    
    <script src="../../../js/sistema_adm/inicio/inicio.js"></script>
</body>
</html>