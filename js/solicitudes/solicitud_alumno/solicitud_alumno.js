document.addEventListener('DOMContentLoaded', function() {
    var elemsDatepicker = document.querySelectorAll('.datepicker');


    var datepickerOptions = {
        format: 'yyyy-mm-dd',
        autoClose: true,
        i18n: {
            cancel: 'Cancelar',
            clear: 'Borrar',
            done: 'Ok',
            previousMonth: '‹',
            nextMonth: '›',
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
            weekdaysAbbrev: ['D', 'L', 'M', 'X', 'J', 'V', 'S']
        },
        onClose: function() {
            console.log('Fecha seleccionada:', this.date);
        },
       
    };

    var instancesDatepicker = M.Datepicker.init(elemsDatepicker, datepickerOptions);

    // Inicialización de los selectores de hora
    var timepickerOptions = {
        twelveHour: false, // Formato de 24 horas
        vibrate: true,
        showClearBtn: true,
        i18n: {
            cancel: 'Cancelar',
            clear: 'Borrar',
            done: 'Ok',
        },
        onCloseEnd: function() {
            validateTime(this.el.id);
        }
    };
    

    // Inicializa los selectores de hora
    var horaEntrada = M.Timepicker.init(document.getElementById('hora-entrada'), timepickerOptions);
    var horaSalida = M.Timepicker.init(document.getElementById('hora-salida'), timepickerOptions);

    // Deshabilitar "Hora de salida" hasta que la hora de entrada sea válida
    document.getElementById('hora-entrada').addEventListener('change', function() {
        var horaEntradaValue = this.value;

        if (validateTime('hora-entrada')) {
            document.getElementById('hora-salida').disabled = false; // Habilitar "Hora de salida"
        } else {
            document.getElementById('hora-salida').disabled = true;  // Mantener deshabilitada
        }
    });

    // Validar la hora de salida al seleccionarla
    document.getElementById('hora-salida').addEventListener('change', function() {
        if (validateTimeDifference()) {
            M.toast({html: 'La diferencia de horas no puede ser mayor a 2 horas.', classes: 'red darken-1'});
            document.getElementById('hora-salida').value = '';  // Limpiar el campo si la diferencia es mayor
        } else if (!validateExitTime()) {
            M.toast({html: 'La hora de salida no puede ser menor o igual que la hora de entrada.', classes: 'red darken-1'});
            document.getElementById('hora-salida').value = '';  // Limpiar el campo si es menor
        }
    });

    // Función para validar si la hora está dentro del rango laboral
    function validateTime(id) {
        var timeValue = document.getElementById(id).value;

        if (timeValue) {
            var timeParts = timeValue.split(':');
            var hour = parseInt(timeParts[0]);
            var minute = parseInt(timeParts[1]);

            // Verificar si la hora está fuera del rango de 7:00 a 22:00
            if (hour < 7 || (hour >= 22 && minute > 0)) {
                M.toast({html: 'Selecciona una hora entre 07:00 y 22:00.', classes: 'red darken-1'}); // Mostrar el toast
                document.getElementById(id).value = '';  // Limpiar el campo si la hora está fuera del rango
                return false;  // No es válida
            } else {
                return true;  // Es válida
            }
        }
        return false;  // Si no hay valor, no es válida
    }

    // Función para validar que la diferencia entre la hora de entrada y salida no sea mayor a 2 horas
    function validateTimeDifference() {
        var horaEntrada = document.getElementById('hora-entrada').value;
        var horaSalida = document.getElementById('hora-salida').value;

        if (horaEntrada && horaSalida) {
            var entradaParts = horaEntrada.split(':');
            var salidaParts = horaSalida.split(':');

            var entradaDate = new Date();
            entradaDate.setHours(parseInt(entradaParts[0]), parseInt(entradaParts[1]));

            var salidaDate = new Date();
            salidaDate.setHours(parseInt(salidaParts[0]), parseInt(salidaParts[1]));

            var differenceInHours = (salidaDate - entradaDate) / (1000 * 60 * 60);

            // Verificar si la diferencia es mayor a 2 horas
            if (differenceInHours > 2) {
                return true;  // Es mayor a 2 horas
            }
        }
        return false;  // No es mayor a 2 horas
    }

    // Función para validar que la hora de salida no sea menor que la hora de entrada
    function validateExitTime() {
        var horaEntrada = document.getElementById('hora-entrada').value;
        var horaSalida = document.getElementById('hora-salida').value;
    
        if (horaEntrada && horaSalida) {
            var entradaParts = horaEntrada.split(':');
            var salidaParts = horaSalida.split(':');
    
            var entradaDate = new Date();
            entradaDate.setHours(parseInt(entradaParts[0]), parseInt(entradaParts[1]));
    
            var salidaDate = new Date();
            salidaDate.setHours(parseInt(salidaParts[0]), parseInt(salidaParts[1]));
    
            if (salidaDate <= entradaDate) {
                return false;  // La hora de salida es menor que la hora de entrada
            }
        }
        return true;  // Si no hay valores o la hora de salida es válida
    }

    // Inicializar el select
    var elemsSelect = document.querySelectorAll('select');
    var instancesSelect = M.FormSelect.init(elemsSelect);
});

$(document).ready(function() {
    $('input#input_text, textarea#textarea2').characterCounter();
});
