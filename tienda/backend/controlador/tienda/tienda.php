<?php

if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

		require_once("../../clase/tienda.class.php");

		$obj_tienda= new tienda;
		$obj_tienda->asignar_valor();


		/* ACCION ME DIRA QUE DEBO HACER*/
		switch ($_REQUEST["accion"]) {
			
			case 'actualizar':  $obj_tienda->resultado=$obj_tienda->actualizar(); 
				break;

			case 'cambio_clave':  $obj_tienda->resultado=$obj_tienda->cambiar_clave(); 
			break;

			case 'cambio_foto':  $obj_tienda->resultado=$obj_tienda->cambiar_foto(); 
			break;

			case 'add_chat_id':  $obj_tienda->resultado=$obj_tienda->add_chat_id(); 
			break;


			
}

}else {
	header("location: ../../../index.php");
}	

?>