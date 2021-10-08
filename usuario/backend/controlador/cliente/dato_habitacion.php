<?php
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("../../clase/dato_habitacion.class.php");
	


$obj_dato_habitacion= new dato_habitacion;
$obj_dato_habitacion->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	case 'insertar':  $obj_dato_habitacion->resultado=$obj_dato_habitacion->insertar(); 
	header ("location: ../../../frontend/pages/nuevo_cliente.php?val=1");
						break;

	case 'modificar': $obj_dato_habitacion->resultado=$obj_dato_habitacion->modificar(); 
						$obj_dato_habitacion->mensaje();
						break;

	case 'eliminar':  $obj_dato_habitacion->resultado=$obj_dato_habitacion->eliminar(); 
						$obj_dato_habitacion->mensaje();
						break;
}
	


}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>