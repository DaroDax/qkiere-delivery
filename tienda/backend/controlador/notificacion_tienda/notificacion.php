<?php
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("../../clase/notificacion_tienda.class.php");
	
$obj_notificacion_tienda =  new notificacion_tienda;
$obj_notificacion_tienda->asignar_valor();

/* ACCION ME DIRA QUE DEBO HACER*/
	switch ($_REQUEST["accion"]) {


		case 'actualizar':  
		$obj_notificacion_tienda->resultado=$obj_notificacion_tienda->cambio_estatus(); 
		break;

		
		
	}
	

}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>