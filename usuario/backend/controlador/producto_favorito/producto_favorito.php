<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/producto_favorito.class.php");
	
$obj_produ_fav =  new producto_favorito;
$obj_produ_fav->asignar_valor();

/* ACCION ME DIRA QUE DEBO HACER*/
	switch ($_REQUEST["accion"]) {


		case 'insertar':  
		$obj_produ_fav->resultado=$obj_produ_fav->insertar(); 
							$cliente_cod_cli=$obj_produ_fav->cliente_cod_cli;
						
						break;

		case 'eliminar':  $obj_produ_fav->resultado=$obj_produ_fav->eliminar(); 
							$obj_produ_fav->mensaje();
		
							break;
		
	}
	

}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>