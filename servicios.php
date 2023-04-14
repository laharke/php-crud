<?php

include 'conexion.php';

require_once('includes/includes_top.php');

$_GET = array_merge($_GET, $_POST);

$action = $_GET['action'];

switch ($action) {

    case 'edit':
        $id = $_POST['id'];
        $con = conexion();
        $sql = "SELECT * FROM servicios WHERE id = '$id'";
        $obj = pg_query($con, $sql);
		$info = pg_fetch_array($obj);

		//4. Asigno las variables con smarty para que el HTML las use
		$smarty->assign('id', $info['id']);
		$smarty->assign('name', $info['nombre']);
		$smarty->assign('vdescarga', $info['vdescarga']);
		$smarty->assign('vsubida', $info['vsubida']);
		$smarty->assign('disabled', 'disabled');
		$smarty->assign('operacion', 'edit');


    case 'register':
        $smarty->assign('formNeeded', 'servicios');
		$smarty->display('form.html');
	break;
    
        // case guardar llego con AGREGAR y CON EDIT
    case 'guardar':

        if ($_GET['subaction'] == 'add'){
			$accion = 'agregado';
		}

        if ($_GET['subaction'] == 'edit'){
            $accion = 'editado';
        }
        //recibo las varaibles
        $id = $_POST['id'];
        $name = $_POST['name'];
		$vdescarga = $_POST['vdescarga'];
		$vsubida = $_POST['vsubida'];

        //Setteo la Conexdion
		$con = conexion();
		
		//Separo dos cases
		// IF agregado: Hago un INSERT en la base de datos con la info
		// IF editado: Hagoun UPDATE en la base de datos con la info

		//AGREGAR
		if ($accion == 'agregado'){
			$sql = "INSERT INTO servicios(nombre, vdescarga, vsubida) VALUES ('$name', '$vdescarga', '$vsubida');";
			$result = pg_query($con, $sql);
		};

        if ($accion == 'editado'){
            $sql = "UPDATE servicios SET nombre = '$name', vdescarga = '$vdescarga', vsubida = '$vsubida' WHERE id = $id;";
            $result = pg_query($con, $sql);
        }

        // mando un menasje de error si falal el agergado o editado del servicio.
        if (!$result) {
			$xx = Array(
				"result" => "fail",
				"response" => 101,
				"msg" => "Error: El nombre $name ya se encuentra en uso"
			);
			echo json_encode($xx);
			break;
		};


        //Si no hay error, hago una query a la base de datos para saber que ID fue asignado al Cliente recien cargado.
		$sql = "SELECT id FROM servicios WHERE nombre = '$name'";
		$result = pg_query($con, $sql);
		$result = pg_fetch_array($result);
		$id = $result['id'];
		
		//Si no tuvo error queire decir que se agrego correctamente, y envio la respuesta positiva.
		$xx = Array(
			"result" => "success",
			"response" => 202,
			"msg" => "El servicio $name fue $accion correctamente",
			"id" => "$id"
		);
		echo json_encode($xx);



				
	break;

    case 'list':
        //ACOMODAR ESTE RQUESTTTTTTTT ESTA COPAIDO DE CLIENTES PERO PREIRMO LETS AMKE DE LISTADO
		// con base de datos
        
		$con = conexion();
		//Hago el query para traer los clientes y ordenarlos por ID.
		$sql = "SELECT * from  servicios ORDER BY id ASC;";
		$obj = pg_query($con, $sql);
		$arr = array();
		//Aca lo que hago es que mientras haya ROWS para traer, voy appendeando con la sintaxis $arr[], a la array que cree, y dentro tengo un array asociativa. 
		while ($fila = pg_fetch_array($obj)){
			$arr[] = array (
				"id" => $fila['id'],
				"name" => $fila['nombre'],
				"vdescarga" => $fila['vdescarga'],
				"vsubida" => $fila['vsubida'],
			);
		}

		$smarty->assign('listadoNeeded', 'servicios');	
		$smarty->assign('servicios', $arr);	
		$smarty->display('listado.html');
	break;


    /*
        Llego aca con un post del JS con el ID que tengo qeu borrar
        Borro la row en la base de datos.
        Vuelvo a cargar la lista con JS. la respuseta de aca no la voy a usar
    */
    case 'borrar':
        $id = $_POST['id'];

		// 2. Me conecto a la base de datos y envio el Delete
		$con = conexion();
		$sql = "DELETE FROM servicios WHERE id = '$id';";
		$obj = pg_query($con, $sql);
		// 3. Muestro la lista actualizada pero con JS.
    break;

    default:
		/* 
			Funcion default displayea el index.
		*/
		
		$smarty->assign('template', 'servicios.html');
		$smarty->assign('highlight', 'servicios');
		$smarty->assign('varaible', 'testo');	
		$smarty->display('index.html');
    break;
}


?>