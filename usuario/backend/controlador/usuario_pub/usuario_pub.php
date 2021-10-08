<?php

require_once("../../clase/usuario_pub.class.php");
	


$obj_usuario_pub =  new usuario_pub;
$obj_usuario_pub->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {

	case 'consulta_email':  $obj_usuario_pub->resultado=$obj_usuario_pub->consulta_email(); 
						break;

	case 'add_ip':  $obj_usuario_pub->resultado=$obj_usuario_pub->add_ip(); 
						break;

	case 'upd_cod':  $obj_usuario_pub->resultado=$obj_usuario_pub->upd_cod(); 
						break;
}
	

?>