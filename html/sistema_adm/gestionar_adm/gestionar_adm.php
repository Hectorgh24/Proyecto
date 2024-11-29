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

   <style>
    /* Estilos para la ventana modal */
    #addAdminModal {
        display: none; /* Oculto por defecto */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%; /* Ajuste a pantallas pequeñas */
        max-width: 400px; /* Limitar el ancho máximo para pantallas grandes */
        padding: 20px;
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        overflow-y: auto; /* Añadir scroll en caso de que sea necesario */
        max-height: 80vh; /* Limitar la altura para evitar overflow */
        box-sizing: border-box;
    }

    /* Estilos para los campos de entrada */
    #addAdminModal, .input-field {
        margin-bottom: 15px;
    }

    #addAdminModal,  .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    #overlay, #overlay2{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    /* Media Query para pantallas pequeñas */
    @media (max-width: 600px) {
        #addAdminModal {
            width: 95%; /* Aumentar el ancho en móviles */
            max-width: none; /* Eliminar límite máximo */
            padding: 15px; /* Ajustar padding para dispositivos móviles */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    }
</style>


</head>
<body>
    <ul id="dropdown1" class="dropdown-content">
        <li><a class="waves-effect default" href="gestionar_adm.php"><i class="material-icons">security</i>Gestionar</a></li>
        <li class="divider"></li>
        <li><a class="waves-effect default" href="../../../php/cerrar_sesion.php"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
    </ul>

    <div class="top-bar">
        <span>Universidad Veracruzana</span>
    </div>

    <nav class="navbar blue darken-3">
        <ul id="dropdown1" class="dropdown-content">
            <li><a class="waves-effect default" href="gestionar_adm.php"><i class="material-icons">security</i>Gestionar</a></li>
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
        <li><a class="waves-effect default" href="../recursos/recursos.php"><i class="material-icons">devices</i>Recursos</a></li>
        <li><a class="waves-effect default" href="../estadisticas/estadisticas.php"><i class="material-icons">assessment</i>Estadísticas</a></li>
        <li><a class="waves-effect default" href="../historial/historial.php"><i class="material-icons">history</i>Historial</a></li>
        <li><a class="dropdown-trigger" data-target="dropdown1"><i class="material-icons">people</i>Administrador<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
    <div class="container">
        <h1>Gestionar</h1>
        <div class="card">
            <div class="card-content">
            


            <?php
             include "../../../php/conexion_be.php";
             $correog = $_SESSION['usuario'];
             $contrasenag = $_SESSION['contrasena_user'];
             $sql = $conexion->query("SELECT * FROM usuario WHERE correo_institucional='$correog' AND contrasena='$contrasenag' ");
             while($datos = $sql->fetch_object()) { ?> 
                <span class="card-title">Administrador Actual</span>
                <p><strong>Nombre:</strong><?=$datos->nombre ?></p>
                <p><strong>Email:</strong><?=$datos->correo_institucional ?></p>
                <p><strong>Tipo:</strong><?=$datos->tipo_usuario ?></p>
             <?php } 
             $conexion->close();
             ?>

            </div>
        </div>

        <!-- Tabla para mostrar y gestionar los administradores -->
        <div>
            <table class="responsive-table">
                
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Correo Institucional</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr> 
                </thead>
            <tbody>
            <?php  
            //$contrasenaq = $_SESSION['contrasena_user'];
            include "../../../php/conexion_be.php";
            $sql = $conexion->query("SELECT * FROM usuario WHERE (tipo_usuario = 'tecnico_academico' OR tipo_usuario = 'jefe_centro_computo')");
            while($datos = $sql->fetch_object()) { ?> 
            <div id="editAdminModal" class="modal">
              <div class="modal-content">
        
                <tr>
                    <td>
                  
                    <input type="hidden" name="contrasena" value="<?=$datos->contrasena?>">
                        <p><?=$datos->nombre?>&nbsp;<?=$datos->apellido_paterno?>&nbsp;<?=$datos->apellido_materno?></p>
                    </td>
                    <td>
                        <p><?=$datos->correo_institucional?></p>
                    </td>
                    <td>
                        <p><?=$datos->tipo_usuario?></p>
                    </td>
                    <td>
                    <a class="btn-small blue modal-trigger" href="#miModal" onclick="setEditData('<?=$datos->nombre?>', '<?=$datos->apellido_paterno?>', '<?=$datos->apellido_materno?>', '<?=$datos->correo_institucional?>', '<?=$datos->tipo_usuario?>','<?=$datos->contrasena?>')">
                    <i class="material-icons">edit</i>
                    </a>

                    <a class="btn-small red modal-trigger" href="#deleteAdminModal" onclick="setDeleteData('<?=$datos->correo_institucional?>')" >
                    <i class="material-icons">delete</i>
                    </a>

                    </td>

                </tr>
             </div> 
            </div>    
        <?php }
        $conexion->close();
        ?>  
                </tbody>
            </table>
        </div>

        <!-- Botón flotante para añadir un nuevo administrador -->
        <div class="fixed-action-btn">
            <a class="btn-floating pulse btn-large light-blue darken-3 modal-trigger" href="#miModal2">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </div>

    <?php 
         include "../../../php/conexion_be.php";
         include "../../../php/registrar_adm.php";

    ?>



<div id="overlay2"></div>
<div id="miModal2" class="modal" >
   <form method="POST"> 
    <!-- Modal para agregar administrador -->
    
        <div class="modal-content">
            <h4>Agregar Administrador</h4>
            <div class="input-field">
                <input id="addNombre" type="text" required name="nombre">
                <label for="addNombre">Nombre</label>
            </div>
            <div class="input-field">
                <input id="addPaterno" type="text" required name="apellidop">
                <label for="addPaterno">Apellido Paterno</label>
            </div>
            <div class="input-field">
                <input id="addMaterno" type="text" required name="apellidom">
                <label for="addMaterno">Apellido Materno</label>
            </div>
            <div class="input-field">
                <select id="addTipo" required name="tipo">
                    <option value="" disabled selected>Selecciona el tipo</option>
                    <option value="tecnico_academico">Técnico Académico</option>
                    <option value="jefe_centro_computo">Jefe de Centro de Cómputo</option>
                </select>
                <label>Tipo de Administrador</label>
            </div>
            <div class="input-field">
                <input id="addCorreo" type="email" required name="email">
                <label for="addCorreo">Correo Institucional</label>
            </div>
            <div class="input-field">
                <input id="addContrasena" type="password" required name="contrasena">
                <label for="addContrasena">Contraseña</label>
            </div>
        </div>
        
        <div class="modal-footer">
            <a class="modal-close btn waves-effect waves-light" onclick="cerrarModal2()">Cancelar</a>
            <button class="btn waves-effect waves-light" onclick="addAdmin()" type="submit" name="btnregistrar" value="ok">Agregar</button>
        </div>
</form>
</div>

  

   

    
    <div id="overlay"></div>
    <!-- Modal para editar administrador -->
    <div id="miModal" class="modal" >

    <!-- Formulario para editar administrador (Modal) -->
    <form method="POST" action="../../../php/actualizar_adm.php">
        <div class="modal-content">
            <h4>Editar Administrador</h4>
            <div class="input-field">
                <input id="editNombre" type="text" required name="nombre2" >
                <label for="editNombre">Nombre</label>
            </div>
            <div class="input-field">
                <input id="editPaterno" type="text" required name="apellidop2" >
                <label for="editPaterno">Apellido Paterno</label>
            </div>
            <div class="input-field">
                <input id="editMaterno" type="text" required name="apellidom2" >
                <label for="editMaterno">Apellido Materno</label>
            </div>
            <div class="input-field">
                <select id="editTipo" required name="tipo2">
                    <option value="" disabled selected>Selecciona el tipo</option>
                    <option value="tecnico_academico">Técnico Académico</option>
                    <option value="jefe_centro_computo">Jefe de Centro de Cómputo</option>
                </select>
                <label>Tipo de Administrador</label>
            </div>
            
            <div class="input-field">
                <input id="editCorreo" type="hidden" required name="correo2"> 
                <label for="editCorreo">Correo Institucional</label>
            </div> 
 
            <div class="input-field">
                <input id="editContrasena" type="password" required name="contrasena2" >
                <label for="editContrasena">Vuelve a ingresar la contraseña</label>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-close btn waves-effect waves-light" onclick="cerrarModal()">Cancelar</a>
            <button class="btn waves-effect waves-light" type="submit" name="btnActualizar">Guardar Cambios</button>
            </div>
    </form> 
    </div>







<!-- Modal para confirmar eliminación -->
<div id="deleteAdminModal" class="modal">
    <div class="modal-content">
        <h4>Eliminar Administrador</h4>
        <p>¿Estás seguro de que deseas eliminar a este administrador?</p>
    </div>
    <div class="modal-footer">
        <form method="POST" action="../../../php/eliminar_adm.php">
            <input type="hidden" id="deleteCorreo" name="correo" value="">
            <a class="modal-close btn waves-effect waves-light">Cancelar</a>
            <button type="submit" class="btn red waves-effect waves-light">Eliminar</button>
        </form>
    </div>
</div>





    <!-- JavaScript para manejar el CRUD -->
    <script>
  
   // Función para cerrar la ventana modal
   function cerrarModal() {
        document.getElementById("miModal").style.display = "none";
        document.getElementById("overlay").style.display = "none";
    }
         // Función para mostrar la ventana modal
    function mostrarModal() {
        document.getElementById("miModal").style.display = "block";
        document.getElementById("overlay").style.display = "block";
    }

    function cerrarModal2() {
        document.getElementById("miModal2").style.display = "none";
        document.getElementById("overlay2").style.display = "none";
    }
         // Función para mostrar la ventana modal
    function mostrarModal2() {
        document.getElementById("miModal2").style.display = "block";
        document.getElementById("overlay2").style.display = "block";
    }


   
       document.addEventListener('DOMContentLoaded', function() {
       var modals = document.querySelectorAll('.modal');
       M.Modal.init(modals);
       });
       
       function setDeleteData(correo) {
       document.getElementById('deleteCorreo').value = correo;
       }


       function setEditData(nombre, apellidoP, apellidoM, correo, tipo, contrasena) {
            $('#editNombre').val(nombre);
            $('#editPaterno').val(apellidoP);
            $('#editMaterno').val(apellidoM);
            $('#editCorreo').val(correo); // Asegúrate de tener un campo de correo en tu modal
            $('#editTipo').val(tipo);
            $('#editContrasena').val(contrasena);
            $('select').formSelect(); // Si usas Materialize, esto actualizará el select
    }
    

     
        let currentAdminId = null;
        document.addEventListener('DOMContentLoaded', function() {
            const elems = document.querySelectorAll('select');
            const instances = M.FormSelect.init(elems);
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Inicializar modales
            const modalElems = document.querySelectorAll('.modal');
            M.Modal.init(modalElems);
            loadAdministradores();

            // Función para obtener administradores
            function loadAdministradores() {
                fetch("crud_administradores.php")
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.querySelector("table tbody");
                        tableBody.innerHTML = "";
                        data.forEach(admin => {
                            
                            tableBody.innerHTML += `
                                <tr>
                                    <td>${admin.nombre} ${admin.paterno} ${admin.materno}</td>
                                    <td>${admin.correo_institucional}</td>
                                    <td>${admin.tipo}</td>
                                
                                    <td>
                                        <a class="btn-small blue modal-trigger" href="#editAdminModal" onclick="setEditAdmin('${admin.correo_institucional}', '${admin.nombre}', '${admin.paterno}', '${admin.materno}', '${admin.tipo}')">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a class="btn-small red modal-trigger" href="#deleteAdminModal" onclick="prepareDeleteAdmin('${admin.correo_institucional}')">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                            
                        });
                    });
            }
    
            // Función para guardar el nuevo administrador
            window.addAdmin = function() {
                const nombre = document.getElementById("addNombre").value;
                const paterno = document.getElementById("addPaterno").value;
                const materno = document.getElementById("addMaterno").value;
                const correo = document.getElementById("addCorreo").value;
                const contrasena = document.getElementById("addContrasena").value;
                const tipo = document.getElementById("addTipo").value;

                fetch("crud_administradores.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `nombre=${nombre}&paterno=${paterno}&materno=${materno}&correo=${correo}&contrasena=${contrasena}&tipo=${tipo}`
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadAdministradores();
                    M.Modal.getInstance(document.getElementById('addAdminModal')).close();
                    resetAddModal();
                });
            };
             

             
            // Función para configurar el modal de edición
            window.setEditAdmin = function(correo, nombre, paterno, materno, tipo) {
                currentAdminId = correo;
                document.getElementById("editNombre").value = nombre;
                document.getElementById("editPaterno").value = paterno;
                document.getElementById("editMaterno").value = materno;
                //document.getElementById("editCorreo").value = correo;
                document.getElementById("editContrasena").value = ""; // Opcional: dejar vacío
                document.getElementById("editTipo").value = tipo;
                M.updateTextFields();
            };
            
          
            // Función para actualizar el administrador
            window.updateAdmin = function() {
                const nombre = document.getElementById("editNombre").value;
                const paterno = document.getElementById("editPaterno").value;
                const materno = document.getElementById("editMaterno").value;
                //const correo = document.getElementById("editCorreo").value;
                const contrasena = document.getElementById("editContrasena").value;
                const tipo = document.getElementById("editTipo").value;

                fetch("crud_administradores.php", {
                    method: "PUT",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `correo=${currentAdminId}&nombre=${nombre}&paterno=${paterno}&materno=${materno}&contrasena=${contrasena}&tipo=${tipo}`
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadAdministradores();
                    M.Modal.getInstance(document.getElementById('editAdminModal')).close();
                });
            };

            // Función para preparar la eliminación del administrador
            window.prepareDeleteAdmin = function(correo) {
                currentAdminId = correo;
            };

            // Función para confirmar la eliminación
            window.confirmDeleteAdmin = function() {
                fetch("crud_administradores.php", {
                    method: "DELETE",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `correo=${currentAdminId}`
                }).then(response => response.json())
                .then(data => {
                    alert(data.message);
                    loadAdministradores();
                    M.Modal.getInstance(document.getElementById('deleteAdminModal')).close();
                });
            };

            // Función para reiniciar el modal de agregar
            function resetAddModal() {
                document.getElementById("addNombre").value = "";
                document.getElementById("addPaterno").value = "";
                document.getElementById("addMaterno").value = "";
                document.getElementById("addCorreo").value = "";
                document.getElementById("addContrasena").value = "";
                document.getElementById("addTipo").value = "";
                M.updateTextFields();
            }
        }); 
    </script>

    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
    <script src="../../../js/sistema_adm/inicio/inicio.js"></script>
</body>
</html>