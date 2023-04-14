console.log('asdfasdf');

/*
    Funcion que trae el Form para register.
    Envia un Get al action 'register' que lo que hace es usar Smarty para hacer display del html donde tengo el Register Form.
    Trae el form sin refreshear la pagina. Con el '?action=register' puedo entrar diferentes switchases en el PHP (Hasta puedo chainear subactions con &.).
    En la variable 'data' tengo todo lo que devuelve ese call get, en este caso el html de register. 
*/
function registerInfo() {
    $.get('servicios.php?action=register', function( data ) {
        $('#registerService').html(data);
        document.querySelector('#regFormButton').style.visibility = "hidden";
        document.querySelector('#registerService').style.display = "block";
    })
};

// GUARDAR LA INFO DE SERVICIOS
function guardar(operacion) {
    if (operacion == '') {
        operacion = 'add';
      } 
    //sea agregar o editar guardo los datos en un objeto desde el mismo form y fue
    let datos = {
        id: $("#id").val(),
        name: $("#name").val(),
        vdescarga: $("#vdescarga").val(),
        vsubida: $("#vsubida").val()
    };
    // POST REQUESET A SERVICIOS.PHP AL INDEX PARA ENVIAR LOS DATOS Y SE INTERPETA LA RESPUESTA, ESTO ES SI ES ADD PERO BUENO
    if (operacion == 'add'){
        fetch("servicios.php?action=guardar&subaction=add", {
            method: "POST",
            body: new URLSearchParams(datos),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
                }
        })
        .then((response) => response.json())
        .then(function(datos) {
            if (datos.result === 'fail'){
                //Alerta fallo
                alert(datos.msg);
            }
            else {
                //Alerta el success
                alert(datos.msg);
                document.querySelector('#registerService').style.display = "none";
                document.querySelector('#regFormButton').style.visibility = "visible";
                getList(datos.id);
            }
        });
    };
    // SI AL OPERACION ES EDIT TENGO QUE ACOMDOAR ESTO
    if (operacion == 'edit'){
        fetch("servicios.php?action=guardar&subaction=edit", {
            method: "POST",
            body: new URLSearchParams(datos),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
                }
        })
        .then((response) => response.json())
        .then(function(datos) {
            if (datos.result === 'fail'){
                //Alerta fallo
                alert(datos.msg);
            }
            else {
                //Alerta sucess]

                alert(datos.msg);
                document.querySelector('#registerService').style.display = "none";
                getList(datos.id);
            }
        })
    };
};


//gets the service info]
//tengo que ocutlar ciertos botones y envair el ID
//populo el FORM con la INFO que ya tengo
function editServiceInfo(id) {
    document.querySelector('#registerService').style.display = "block";
    document.querySelector('#regFormButton').style.visibility = "visible";
    document.getElementById('tableService').style.display = "none";
    document.querySelector('#editService').style.display = "block";
    datos = {
        id: id,
    };
    fetch("servicios.php?action=edit", {
        method: "POST",
        body: new URLSearchParams(datos),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
            }
    })
    .then((response) => response.text())
    .then(function(datos) {$('#registerService').html(datos);})
}

function deleteService(id){
    datos = {
        id: id,
    };
    fetch("servicios.php?action=borrar", {
        method: "POST",
        body: new URLSearchParams(datos),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
            }
    })
    .then((response) => response.text())
    .then(function(datos) {
            alert('El servicio fue borrado con éxito');
            getList();
        });
}


function getList(id) {
    if (id === undefined) {
        id = 0;
      } 
    $.get('servicios.php?action=list', function( data ) {
        $('#tableService').html(data);
        document.getElementById(id).style.backgroundColor = '#a33333';
    });
    document.getElementById('tableService').style.display = "block";
};

function hideList() {
    document.getElementById('tableService').style.display = "none";
}


/*
    Funcion que esconde el form register y muestra el boton para mostrar el form register.
*/
function esconderRegistro(){
    document.querySelector('#registerService').style.display = "none";
    document.querySelector('#editService').style.display = "none";
    document.querySelector('#regFormButton').style.visibility = "visible";
};

