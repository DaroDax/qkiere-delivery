<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/sitio_favorito.class.php");
	
$obj_sitio_favorito =  new sitio_favorito;
$obj_sitio_favorito->asignar_valor();

/* ACCION ME DIRA QUE DEBO HACER*/
	switch ($_REQUEST["accion"]) {


		case 'insertar':  
		$obj_sitio_favorito->resultado=$obj_sitio_favorito->insertar(); 
							$cliente_cod_cli=$obj_sitio_favorito->cliente_cod_cli;
						
						break;

		case 'eliminar':  $obj_sitio_favorito->resultado=$obj_sitio_favorito->eliminar(); 
							$obj_sitio_favorito->mensaje();
		
							break;
		
	}
	

}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>