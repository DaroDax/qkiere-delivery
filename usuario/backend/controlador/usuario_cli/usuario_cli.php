<?php

require_once("../../clase/reg_cli_pub.class.php");
	


$obj_registro_cli= new registro_cli;
$obj_registro_cli->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	case 'insertar':  $obj_registro_cli->resultado=$obj_registro_cli->insertar(); 
	header ("location: ../../../frontend/cliente.php?val=1");
					break;
}
	

?>