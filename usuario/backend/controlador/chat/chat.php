<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/chat.class.php");
	


$obj_chat_usu =  new chat_usu;
$obj_chat_usu->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {

	case 'new_msj':  $obj_chat_usu->resultado=$obj_chat_usu->new_msj(); 
						break;

	case 'new_msj_dom':  $obj_chat_usu->resultado=$obj_chat_usu->new_msj_dom(); 
						break;

	case 'msj_leido':  $obj_chat_usu->resultado=$obj_chat_usu->msj_leido(); 
						break;

	case 'msj_leido_dom':  $obj_chat_usu->resultado=$obj_chat_usu->msj_leido_dom(); 
						break;

	case 'borrado':  $obj_chat_usu->resultado=$obj_chat_usu->borrado_logico(); 
						break;

	case 'borrado_dom':  $obj_chat_usu->resultado=$obj_chat_usu->borrado_logico_dom(); 
						break;
}
	


}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>