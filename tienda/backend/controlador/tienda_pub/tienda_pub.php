<?php

require_once("../../clase/tienda_pub.class.php");
	


$obj_tienda_pub =  new tienda_pub;
$obj_tienda_pub->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {

	case 'cambio_clave':  $obj_tienda_pub->resultado=$obj_tienda_pub->cambio_clave(); 
						break;
}
	

?>