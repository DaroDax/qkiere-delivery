<?php
session_start();

if (isset($_SESSION['cod_dom'])){

require_once("../../clase/notificacion_domicilio.class.php");
	
$obj_notificacion_domicilio =  new notificacion_domicilio;
$obj_notificacion_domicilio->asignar_valor();

/* ACCION ME DIRA QUE DEBO HACER*/
	switch ($_REQUEST["accion"]) {


		case 'actualizar':  
		$obj_notificacion_domicilio->resultado=$obj_notificacion_domicilio->cambio_estatus(); 
		break;

		case 'desactivar':  
		$obj_notificacion_domicilio->resultado=$obj_notificacion_domicilio->inactivar(); 
		break;

		
		
	}
	

}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>