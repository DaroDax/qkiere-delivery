<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/usuario.class.php");
	


$obj_usuario =  new usuario;
$obj_usuario->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	
	case 'insertar':  $obj_usuario->resultado=$obj_usuario->insertarDireccion(); 
						$cliente_cod_cli=$obj_usuario->cliente_cod_cli;
	header ("location: ../../../frontend/pages/Myaccount.php?val=1");
	break;


	case 'eliminar_direccion':  $obj_usuario->resultado=$obj_usuario->eliminar_direccion(); 
						$obj_cliente->mensaje();
						break;

	case 'cambio_clave':  $obj_usuario->resultado=$obj_usuario->cambio_clave(); 
					
						break;

	case 'modificar_datos': $obj_usuario->resultado=$obj_usuario->modificar_datos(); 
					
						break;

	case 'modificar_direccion':  $obj_usuario->resultado=$obj_usuario->editar_direccion(); 
					
						break;

	case 'consulta_email':  $obj_usuario->resultado=$obj_usuario->consulta_email(); 
					
						break;

	case 'add_chat_id':  $obj_usuario->resultado=$obj_usuario->add_chat_id(); 
					
						break;

	case 'select_inicio':  $obj_usuario->resultado=$obj_usuario->select_inicio(); 
					
						break;

	case 'select_cat':  $obj_usuario->resultado=$obj_usuario->select_cat(); 
					
						break;
}
	


}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>