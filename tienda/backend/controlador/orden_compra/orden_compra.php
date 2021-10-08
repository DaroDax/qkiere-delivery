<?php

if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

		require_once("../../clase/orden_compra.class.php");
			


		$obj_ord_com= new orden_compra;
		$obj_ord_com->asignar_valor();


		/* ACCION ME DIRA QUE DEBO HACER*/
		switch ($_REQUEST["accion"]) {
			
			case 'aceptar_orden':  $obj_ord_com->resultado=$obj_ord_com->aceptar_orden();
				break;

			case 'eliminar_logico':  $obj_ord_com->resultado=$obj_ord_com->eliminar_logico(); 
			break;

			case 'actualizar':  $obj_ord_com->resultado=$obj_ord_com->actualizar(); 
			break;
}

}else {
	header("location: ../../../index.php");
}	

?>