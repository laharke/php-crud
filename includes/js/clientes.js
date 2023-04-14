/*
    Funcion que trae el Form para register.
    Envia un Get al action 'register' que lo que hace es usar Smarty para hacer display del html donde tengo el Register Form.
    Trae el form sin refreshear la pagina. Con el '?action=register' puedo entrar diferentes switchases en el PHP (Hasta puedo chainear subactions con &.).
    En la variable 'data' tengo todo lo que devuelve ese call get, en este caso el html de register. 
*/
function registerInfo() {
    $.get('clientes.php?action=register', function( data ) {
        $('#register').html(data);
        document.querySelector('#regFormButton').style.visibility = "hidden";
        document.querySelector('#register').style.display = "block";
    })
};
/*
    FUNCOIN GUARDAR que funcoina el mismo form


*/

function guardar(operacion) {
    if (operacion == '') {
        operacion = 'add';
      } 
    //sea agregar o editar guardo los datos en un objeto desde el mismo form y fue
    let datos = {
        id: $("#id").val(),
        name: $("#name").val(),
        apellido: $("#apellido").val(),
        dir: $("#dir").val(),
        tel: $("#tel").val()
    };
    //Post request al action agregar para enviar los datos y se intepreta la respuesta
    //if (operacion = add)
    if (operacion == 'add'){
        fetch("clientes.php?action=agregar&subaction=add", {
            method: "POST",
            body: new URLSearchParams(datos),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
                }
        })
            // Recibe la respuesta
            .then((response) => response.json())
            .then(function(datos) {
                if (datos.result === 'fail'){
                    //Alerta fallo
                    alert(datos.msg);
                }
                else {
                    //Alerta el success
                    alert(datos.msg);
                    cleanForm();
                    document.querySelector('#register').style.display = "none";
                    document.querySelector('#regFormButton').style.visibility = "visible";
                    getList(datos.id);
                }
            });
        }
    else if (operacion == 'edit'){
        //else (es edit)
        fetch("clientes.php?action=agregar&subaction=edit", {
            method: "POST",
            body: new URLSearchParams(datos),
            headers: {
                "X-Requested-With": "XMLHttpRequest"
                }
        })
            // receive la  respuesta
            .then((response) => response.json())
            .then(function(datos) {
                if (datos.result === 'fail'){
                    //Alerta fallo
                    alert(datos.msg);
                }
                else {
                    alert(datos.msg);
                    document.querySelector('#register').style.display = "none";
                    getList(datos.id);
                }
            });
        }
};


/*
    Funcion que llamo cuando se hace click en el boton 'edit' de algun usuario.
    Se encarga de mostrar y esconder los botones y formularios acordes. 
    Hace un post a Editar donde envía el ID del cliente que hay que editar y recibe la respuesta del php con el HTML ya populada por smarty.

*/

function editUser(id){
    //Escondo el formulario register y la lista
    //Muestro el boton de Registraro y el div de ditar
    document.querySelector('#register').style.display = "block";
    document.querySelector('#regFormButton').style.visibility = "visible";
    document.getElementById('table').style.display = "none";
    document.querySelector('#edit').style.display = "block";
    datos = {
        id: id,
    };
    //Envio el ID del cliente que se desea editar al action editar que devuelve la info en Json.
    fetch("clientes.php?action=edit", {
        method: "POST",
        body: new URLSearchParams(datos),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
            }
    })
        // Recibe la respuesta y parsea el Json.
        .then((response) => response.text())
        .then(function(datos) {$('#register').html(datos);})
        };

/*
    Funcion para borrar el usuario de la base de datos segun el ID proveeido como parametro.
    Envia un fetch post al action Borrar que se encarga de borrar el ID.
    Se recive una respuesta en forma de texto. Se avisa que el usuario fue borrado con éxito y se trae la lista de clientes.
*/

function deleteUser(id){
    datos = {
        id: id,
    };
    //Request post para enviar el ID
    fetch("clientes.php?action=borrar", {
        method: "POST",
        body: new URLSearchParams(datos),
        headers: {
            "X-Requested-With": "XMLHttpRequest"
            }
    })
        // Se recibe la respuesta, se alerta el mensaje de success y se displayea la lista.
        .then((response) => response.text())
        .then(function(datos) {
            alert ('El cliente fue borrado con éxito');
            getList();
        });
}


/*
    Funcion para mostrar la list de usuarios, primero tiro un .get al action=list que con Smary se encarga de llenar el HTML y mostrarlo donde esta el div con id table.
    Y ademas hace que el DIV sea BLOCK por las dudas que se haya puesto none.
    Ademas si le pasas un ID, le cambia el color para saber cual se cargo o se edito. 
*/
function getList(id) {
    if (id === undefined) {
        id = 0;
      } 
    $.get('clientes.php?action=list', function( data ) {
        $('#table').html(data);
        document.getElementById(id).style.backgroundColor = '#a33333';
    });
    document.getElementById('table').style.display = "block";
};


/*
    Funcion ocultar a lista de clientes.
*/
function hideList() {
    document.getElementById('table').style.display = "none";
}

/*
    Funcion para limpiar los valores del FROM de REGISTRO.
*/
function cleanForm() {
    $("#id").val('');
    $("#name").val('');
    $("#apellido").val('');
    $("#dir").val('');
    $("#tel").val('');
};

/*
    Funcion que esconde el form register y muestra el boton para mostrar el form register.
*/
function esconderRegistro(){
    document.querySelector('#register').style.display = "none";
    document.querySelector('#edit').style.display = "none";
    document.querySelector('#regFormButton').style.visibility = "visible";
};


/*
    Boton para volver para el top
*/
//Get the button
let myButton2 = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    let y = window.scrollY;
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100 || y > 100) {
        myButton2.style.display = "block";
    } else {
        myButton2.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
