<?php

include 'conexion.php';

require_once('includes/includes_top.php');

$_GET = array_merge($_GET, $_POST);

$action = $_GET['action'];

switch ($action) {

	//testeo de pagination funciona pero hasta ahi 
	case 'pagination':
		//Agarro que pagina me mandan en el get, si no me mandan nada asigno 1
		if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {

            $page = 1;
        }
	


		$con = conexion();
		$sql_count = 'select count(*) as count from clientes';
		$obj = pg_query($con, $sql_count);
		$count = pg_fetch_array($obj);
		//aca me queda EL TOTAL DE CLIENTES cargados
		$count = $count['count'];
		
		//cuantos quiero mostrar PER PAGE
		$per_page = 5;
		//paginas totales que voy atener que mostrar redoneandoa rriba
		$total_pages = ceil($count / $per_page);
		//ahora el quilombo, defiinri un OFFSET, es decir cuantas se saltean, esto es
		$offset = ($page - 1) * $per_page;
		
		$sql = "SELECT * from clientes ORDER BY id ASC LIMIT '$per_page' OFFSET '$offset';";
		$obj = pg_query($con, $sql);
		$arr = array();
		//Aca lo que hago es que mientras haya ROWS para traer, voy appendeando con la sintaxis $arr[], a la array que cree, y dentro tengo un array asociativa. 
		while ($fila = pg_fetch_array($obj)){
			$arr[] = array (
				"id" => $fila['id'],
				"name" => $fila['nombre'],
				"apellido" => $fila['apellido'],
				"dir" => $fila['direccion'],
				"tel" => $fila['telefono'],
			);
		}

		//tengo que hacer esto para mandar el total de paginas porque en smarty solo se usar for each el for comun no me anda
		$pagelist = [];
		for ($i = 1; $i <= $total_pages; $i++){
			$pagelist[] = $i;
		}
		
		$smarty->assign('clientes', $arr);	
		$smarty->assign('pages', $pagelist);
		$smarty->assign('currentPage', $page);
		$smarty->assign('listadoNeeded', 'clientes');	
		$smarty->display('pagination.html');
	break;


	/*
		Esto es el Case Edit y register.
		Trae el FORM, ya que uso uno para Register y Edit.
		Si el case es Edit, busca la info del POST a la base datos con el ID que envia el Js y trae la info del cliente, asigandola a varaibles smarty.
		Como no hay break, sigue directo al case Register, que displayea el form con smarty y rellena las variables en los values del form.

		Si directametne se llama al case Register, se trae el Form vacio y las variables quedan vacias.
	*/
    case 'edit':
		
		//traigo los datos y asigno los valores a los inputs del html
		//si vengo a EDIT, cargo los vaores y me voy al register que llama al html pero con los datos
		//si no caigo al edit fui directo al register y lama el html con values VACIOS
		
		//1. Recibo el ID desde el fetch y lo guardo
		$id = $_POST['id'];
		
		// CON base de datos
		$con = conexion();
		$sql = "SELECT * from  clientes WHERE id = '$id';";
		$obj = pg_query($con, $sql);
		$info = pg_fetch_array($obj);

		//4. Asigno las variables con smarty para que el HTML las use
		$smarty->assign('id', $info['id']);
		$smarty->assign('name', $info['nombre']);
		$smarty->assign('apellido', $info['apellido']);
		$smarty->assign('dir', $info['direccion']);
		$smarty->assign('tel', $info['telefono']);
		$smarty->assign('disabled', 'disabled');
		$smarty->assign('operacion', 'edit');
		
	case 'register':
		$smarty->assign('formNeeded', 'clientes');
		$smarty->display('form.html');
	break;

    
	/*
		A este case voy a acceder con un FETCH desde el JS para displayear la Tabla con la info. Debo:
			1. Leer la base de datos con los clientes
			2. While voy leyendo las filas del array, voy agregando a esa array una array associativa con los datos.
			3. Asignar esa array a una variable para enviarla al listado.html
			3. Displayear el listado.html donde:
				3.a. Creo la tabla dinamicamente utilizando un for each y pasando por cada uno de los key values en el HTML con SMARTY.

		Investigar: Pagination si hay muchos clientes!!
	*/
	case 'list':
		// con base de datos
		$con = conexion();
		//Hago el query para traer los clientes y ordenarlos por ID.
		$sql = "SELECT * from  clientes ORDER BY id ASC;";
		$obj = pg_query($con, $sql);

		$arr = array();
		//Aca lo que hago es que mientras haya ROWS para traer, voy appendeando con la sintaxis $arr[], a la array que cree, y dentro tengo un array asociativa. 
		while ($fila = pg_fetch_array($obj)){
			$arr[] = array (
				"id" => $fila['id'],
				"name" => $fila['nombre'],
				"apellido" => $fila['apellido'],
				"dir" => $fila['direccion'],
				"tel" => $fila['telefono'],
			);
		}

		$smarty->assign('listadoNeeded', 'clientes');	
		$smarty->assign('users', $arr);	
		$smarty->display('listado.html');
	break;
    

	/* 
		Case Guardar deberia ser.
		A este case llego desde posts con info del ID que hay que Agregar o Editar y los valores de los campos del input.
		Si es Agregar/Editar está indicado por un Sub Action:
			1. Leo el archivo con los clientes que ya estan agregados y lo decodeo en una array asociativa
				2.a) Si el Sub Action es Add => Chequeo que el ID no este usado, si lo esta, mando response Error en una array asociativa y lo envio con json econde, que decodeo en el js.
				2.b) Si el Sub Action es Edit => Borro el ID que me mandan de la array.
			3. Si el ID se puede usar, lo agrego al array que cree. Encodeo a Json y sobreescribo el archivo.
			4. Envio la respuesta que esta OK y el usuario fue agregado.
			5. Muestro la lista desde JS.

		Case Guardar deberia ser.
		A este case llego desde posts con la info del ID que hay que Agregar o Editar y los valores del los campos del input.
		Para agregar no me interesa el ID, pero para editar si porque con el ID distingo que valor tengo que UPDATE.
		Si es Agregar/Editar está indicado por el Sub Action.
			1. 
	*/
	case 'agregar':


		// Esto no tiene MUCHO sentido pero bueno.
		if ($_GET['subaction'] == 'add'){
			$accion = 'agregado';
		}
		if ($_GET['subaction'] == 'edit'){
			$accion = 'editado';
		}
		//2. Cargo las variables del input sueltas no necesitan estar en un array.
		
		$id = $_POST['id'];
		$name = $_POST['name'];
		$apellido = $_POST['apellido'];
		$dir = $_POST['dir'];
		$tel = $_POST['tel'];
		
		

		//Setteo la Conexdion
		$con = conexion();
		
		//Separo dos cases
		// IF agregado: Hago un INSERT en la base de datos con la info
		// IF editado: Hagoun UPDATE en la base de datos con la info

		//AGREGAR
		if ($accion == 'agregado'){
			$sql = "INSERT INTO clientes(nombre, apellido, direccion, telefono) VALUES ('$name', '$apellido', '$dir', $tel);";
			$result = pg_query($con, $sql);
		};
		//EDITAR
		if ($accion == 'editado'){
			$sql = "UPDATE clientes SET nombre = '$name', apellido = '$apellido', direccion = '$dir', telefono = $tel WHERE id = $id;";
			$result = pg_query($con, $sql);
		}
		//Si el INSERT o el UPDATE dan error, lo hago aca y BREAK, sino sigo todo OK.
		if (!$result) {
			$xx = Array(
				"result" => "fail",
				"response" => 101,
				"msg" => "Error: La combinacion de nombre y apellido '$name $apellido' ya se encuentra en uso"
			);
			echo json_encode($xx);
			break;
		};
		
		//Si no hay error, hago una query a la base de datos para saber que ID fue asignado al Cliente recien cargado.
		$sql = "SELECT id FROM clientes WHERE nombre = '$name' AND apellido = '$apellido'";
		$result = pg_query($con, $sql);
		$result = pg_fetch_array($result);
		$id = $result['id'];
		
		//Si no tuvo error queire decir que se agrego correctamente, y envio la respuesta positiva.
		$xx = Array(
			"result" => "success",
			"response" => 202,
			"msg" => "El cliente $name $apellido fue $accion correctamente",
			"id" => "$id"
		);
		echo json_encode($xx);
		
	break;

	case 'borrar':
		/* Para borrar:
			1. Recibo el ID desde el fetch y lo guardo.
			2. Borro la row que corresponde a ese ID de la base de datos. 
			3. Muestro la lista con JS.
		*/
		// 1. Recibo el ID desde el fetch y lo guardo
		$id = $_POST['id'];
		
		// 2. Me conecto a la base de datos y envio el Delete
		$con = conexion();
		$sql = "DELETE FROM clientes WHERE id = '$id';";
		$obj = pg_query($con, $sql);
		// 3. Muestro la lista actualizada pero con JS.
	break;

    default:
		/* 
			Funcion default displayea el index.
		*/
		$smarty->assign('highlight', 'index');
		$smarty->assign('varaible', 'testo');	
		$smarty->display('index.html');
    break;
}


?>