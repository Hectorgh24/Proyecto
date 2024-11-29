$(document).ready(function(){
    $('.sidenav').sidenav();
    $(".dropdown-trigger").dropdown();
});

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    M.Collapsible.init(elems);
    var selectElems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(selectElems);

    // Filter functionality
    document.getElementById('filterSelect').addEventListener('change', function() {
        var selectedValue = this.value;
        var items = document.querySelectorAll('#requestList li');
        
        items.forEach(function(item) {
            // Si se selecciona "all", mostramos todos los elementos
            if (selectedValue === 'all' || item.getAttribute('data-type') === selectedValue) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
