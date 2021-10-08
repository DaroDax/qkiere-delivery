<?php

if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

		require_once("../../clase/domiciliario.class.php");
	
		$obj_dom= new domiciliario;
		$obj_dom->asignar_valor();


		/* ACCION ME DIRA QUE DEBO HACER*/
		switch ($_REQUEST["accion"]) {
			
			case 'cambio_clave':  $obj_dom->resultado=$obj_dom->cambio_clave(); 
			break;

			case 'disponibilidad':  $obj_dom->resultado=$obj_dom->disponibilidad(); 
			break;

			case 'add_chat_id':  $obj_dom->resultado=$obj_dom->add_chat_id(); 
			break;

}

}else {
	header("location: ../../../index.php");
}	

?>