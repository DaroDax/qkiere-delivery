<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/notificacion_usuario.class.php");
	
$obj_notificacion_usuario =  new notificacion_usuario;
$obj_notificacion_usuario->asignar_valor();

/* ACCION ME DIRA QUE DEBO HACER*/
	switch ($_REQUEST["accion"]) {


		case 'actualizar':  
		$obj_notificacion_usuario->resultado=$obj_notificacion_usuario->cambio_estatus(); 
		break;

		
		
	}
	

}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>