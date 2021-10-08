<?php

if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

		require_once("../../clase/inventario.class.php");
			


		$obj_inventario= new inventario;
		$obj_inventario->asignar_valor();


		/* ACCION ME DIRA QUE DEBO HACER*/
		switch ($_REQUEST["accion"]) {
			
			case 'agregar':  $obj_inventario->resultado=$obj_inventario->agregar(); 
		    break;

			case 'eliminar_logico':  $obj_inventario->resultado=$obj_inventario->eliminar_logico(); 
			break;

			case 'estatu_producto':  $obj_inventario->resultado=$obj_inventario->estatu_producto(); 
			break;

			case 'actualizar':  $obj_inventario->resultado=$obj_inventario->actualizar(); 
			break;
}

}else {
	header("location: ../../../index.php");
}	

?>