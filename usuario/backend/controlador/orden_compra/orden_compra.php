<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/orden_compra.class.php");
	


$obj_orden_compra =  new orden_compra;
$obj_orden_compra->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {


	case 'insertar':  $obj_orden_compra->resultado=$obj_orden_compra->insertar(); 
						$tienda_cod_tie=$obj_orden_compra->tienda_cod_tie;
					
						break;

	case 'eliminar_orden_compra':  $obj_orden_compra->resultado=$obj_orden_compra->eliminar_orden_compra(); 
						break;
	
}
	


}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>