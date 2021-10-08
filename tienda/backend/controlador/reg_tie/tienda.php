<?php

require_once("../../clase/reg_tie.class.php");
	


$obj_registro_tienda= new registro_tienda;
$obj_registro_tienda->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	case 'insertar':  $obj_registro_tienda->resultado=$obj_registro_tienda->insertar(); 
	
					break;
}
	

?>