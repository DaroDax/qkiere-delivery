<?php

if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

		require_once("../../clase/delivery.class.php");
			


		$obj_domicilio= new domicilio;
		$obj_domicilio->asignar_valor();


		/* ACCION ME DIRA QUE DEBO HACER*/
		switch ($_REQUEST["accion"]) {
			
			case 'agregar':  $obj_domicilio->resultado=$obj_domicilio->agregar(); 
		    break;

			case 'eliminar_logico':  $obj_domicilio->resultado=$obj_domicilio->eliminar_logico(); 
			break;

			case 'estatu_producto':  $obj_domicilio->resultado=$obj_domicilio->estatu_producto(); 
			break;

			case 'actualizar_delivery':  $obj_domicilio->resultado=$obj_domicilio->actualizar_delivery(); 
			break;
}

}else {
	header("location: ../../../index.php");
}	

?>