<?php

require_once("../../clase/reg_usu.class.php");
	
$obj_registro= new registro_usuario;
$obj_registro->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	case 'insertar':  $obj_registro->resultado=$obj_registro->insertar(); 
					break;

    case 'insertar_email':  $obj_registro->resultado=$obj_registro->insertar_email(); 
					break;
}
	

?>