<?php

include 'conexion.php';

require_once('includes/includes_top.php');

$_GET = array_merge($_GET, $_POST);

$action = $_GET['action'];

switch ($action) {


	case 'list':
		$id = $_POST['id'];
		//ahora hago el join apra trare los serivcos que le corresponden al cliente ese
		$con = conexion();
		$sql = "SELECT servicios.id, servicios.nombre, servicios.vdescarga, servicios.vsubida FROM asignaciones INNER JOIN clientes ON asignaciones.id_cliente = clientes.id
		INNER JOIN servicios ON asignaciones.id_servicio = servicios.id WHERE asignaciones.id_cliente = $id ORDER BY id ASC;";
		$obj = pg_query($con, $sql);
		//ahora que tengo la info la voy appenando al array
		$arr = array();
		while ($fila = pg_fetch_array($obj)){
			$arr[] = array (
				"idServicio" => $fila['id'],
				"nameServicio" => $fila['nombre'],
				"vdescarga" => $fila['vdescarga'],
				"vsubida" => $fila['vsubida'],
			);
		};

		$sql = "SELECT * FROM SERVICIOS WHERE ID NOT IN (SELECT servicios.id FROM asignaciones
		JOIN servicios ON asignaciones.id_servicio = servicios.id 
		WHERE asignaciones.id_cliente = $id) ORDER BY id ASC";

		$obj = pg_query($con, $sql);
		$arr2 = array();
		while ($fila = pg_fetch_array($obj)){
			$arr2[] = array (
				"idServicio" => $fila['id'],
				"nameServicio" => $fila['nombre'],
				"vdescarga" => $fila['vdescarga'],
				"vsubida" => $fila['vsubida'],
			);
		};

		$smarty->assign('clienteId', $id);
		$smarty->assign('servicios', $arr);
		$smarty->assign('serviciosFaltantes', $arr2);
		$smarty->display('asignacioneslistado.html');
	break;

	/*
		toggleServicio recibe un Id de servicio Id cliente y una accion y si la accion es ASignar, asigna ese servicio aese cliente, si es desasignar, lo contrario.
	*/
	case 'toogleServicio':
		$idServicio = $_POST['idServicio'];
		$idCliente = $_POST['idCliente'];
		$accion = $_POST['accion'];

		$con = conexion();

		if ($accion == 'asignar'){
			$sql = "INSERT INTO asignaciones(id_cliente, id_servicio) VALUES ('$idCliente', $idServicio);";
			$result = pg_query($con, $sql);
			echo "El servicio se le asigno al cliente correctamente";
		}

		if ($accion == 'desasignar'){
			$sql = "DELETE FROM asignaciones WHERE id_cliente = '$idCliente' and id_servicio = $idServicio;";
			$result = pg_query($con, $sql);
			echo "El servicio fue desasignado del cliente correctamente";
		}

	break;

    default:
		/* 
			Funcion default displayea el index.
		*/

		//get all the clientes to display on the asignaciones.html drop dwon select
		$con = conexion();
		$sql = "SELECT id, nombre, apellido FROM clientes ORDER BY id ASC;";
		$obj = pg_query($con, $sql);

		//creo que lo que mas me conviente es conctaneralo, y no tengo ID igual para despues seleccionarlo a menos que le ponog un hidden al select
		$arr = array();
		//Aca lo que hago es que mientras haya ROWS para traer, voy appendeando con la sintaxis $arr[], a la array que cree, y dentro tengo un array asociativa. 
		while ($fila = pg_fetch_array($obj)){
			$arr[] = array (
				"id" => $fila['id'],
				"fullname" => $fila['nombre'] . " " . $fila['apellido']
			);
		}
		
		$smarty->assign('template', 'asignaciones.html');
		$smarty->assign('highlight', 'asignaciones');
		$smarty->assign('clientes', $arr);	
		$smarty->display('index.html');
    break;
}

?>