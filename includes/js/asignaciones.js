

//vamos a hacer la funcion GET SERVICIOS, que cuando hagas click en el boton, BUSQUE EL VALUE (id del cliente)( del select y eso lo mande en un fetch post al php
//desde el php hare un join or something para encontrar todos los servicios asignados al cliente y los mando en un array al html
// y el html va a ser uno similar a SERVICIOS pero con los campso que necesite yo y mando al resopne
//y dsp con el JS hago lo de siempre de agarrar el div serviceListAsignaciones.html(response);
//y bueno eso seria traer el list 

function getServicios(id) {
    //clientID = $('#clientesDropdown').val();
    if (id === undefined) {
        id = 0;
      } 
    //prefecot lo de arriba
    datos = {
        id: $('#clientesDropdown').val(),
    };
    fetch("asignaciones.php?action=list", {
        method: "POST",
        body: new URLSearchParams(datos),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
            }
    })
    .then((response) => response.text())
    .then(function(datos) {$('#serviceListAsignaciones').html(datos);
    document.getElementById(id).style.backgroundColor = '#a33333';})
}


/*

*/
function toogleServicio(idServicio, idCliente, accion){
    let datos2 = {
        idServicio: idServicio,
        idCliente: idCliente,
        accion: accion,
    }
        fetch("asignaciones.php?action=toogleServicio", {
            method: "POST",
            body: new URLSearchParams(datos2),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
                }
        })
        .then((response) => response.text())
        .then(function(datos) {
            alert(datos);
            getServicios(idServicio);
        })
    }