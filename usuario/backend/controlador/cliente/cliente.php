<?php
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("../../clase/cliente.class.php");
	


$obj_cliente= new cliente;
$obj_cliente->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	case 'insertar':  $obj_cliente->resultado=$obj_cliente->insertar(); 
						$cedula=$obj_cliente->cedula;
	header ("location: ../../../frontend/pages/datos_habitacion.php?cedula=".$cedula."&&val=1");
					
						break;

	case 'modificar_cliente': $obj_cliente->resultado=$obj_cliente->modificar_cliente(); 
	header ("location: ../../../frontend/pages/estudios_viabilidad.php?val=1");
						
						break;


	case 'modificar': $obj_cliente->resultado=$obj_cliente->modificar_todo(); 
						$contrato=$obj_cliente->contrato;
	header ("location: ../../../frontend/pages/perfil_cliente.php?contrato=".$contrato."&&val=1");
						
						break;

	case 'eliminar':  $obj_cliente->resultado=$obj_cliente->eliminar(); 
						$obj_cliente->mensaje();
						break;
}
	


}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>