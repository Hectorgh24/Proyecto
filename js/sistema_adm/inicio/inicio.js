$(document).ready(function(){
    $('.sidenav').sidenav();
    $(".dropdown-trigger").dropdown();
});

function actualizarPendientes() {
    $.ajax({
        url: '../../../html/sistema_adm/inicio/inicio.php', // El archivo PHP que consulta las solicitudes pendientes
        type: 'GET',
        data: { ajax: true }, // Enviar un parámetro de AJAX
        dataType: 'json',
        success: function(data) {
            // Actualizar el número en el badge solo si hay solicitudes pendientes
            if (data.pendientes > 0) {
                $('.new.badge').text(data.pendientes).show(); // Muestra el badge
            } else {
                $('.new.badge').hide(); // Oculta el badge si no hay solicitudes pendientes
            }
        },
        error: function() {
            console.log('Error al obtener los datos');
        }
    });
}

// Llamar a la función para actualizar los datos cada 10 segundos
$(document).ready(function() {
    actualizarPendientes(); // Llamar inmediatamente cuando cargue la página
    setInterval(actualizarPendientes, 1000); // Actualizar cada 10 segundos
});