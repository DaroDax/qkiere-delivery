<?php 
require("../../clase/sesion.class.php");
/*  INSTANCIO  UN OBJETO DE LA CLASE USUARIO */

$obj_ses = new sesion;

$obj_ses->asignar_valor();


switch ($_REQUEST["accion"]) {
	case 'sesion':  
	$obj_ses->puntero=$obj_ses->validar_sesion(); 
	$usuario_sesion=$obj_ses->extraer_dato();

		if($usuario_sesion["cod_tie"]>0){
	
	
		// Variables de session de usuario

		session_start ();
		$_SESSION ["cod_tie"] = $usuario_sesion["cod_tie"];
		$_SESSION ["raz_tie"] =  $usuario_sesion["raz_tie"];
		$_SESSION ["ema_tie"] =  $usuario_sesion["ema_tie"];
		$_SESSION ["pas_tie"] =  $usuario_sesion["pas_tie"];
		$_SESSION ["cha_id_tie"] =  $usuario_sesion["cha_id_tie"];

			setcookie("cod_tie",$usuario_sesion["cod_tie"],time()+(60*60*24*365),"/");
			setcookie("ema_tie",$usuario_sesion["ema_tie"],time()+(60*60*24*365),"/");
			setcookie("pas_tie",$usuario_sesion["pas_tie"],time()+(60*60*24*365),"/");
			setcookie("raz_tie",$usuario_sesion["raz_tie"],time()+(60*60*24*365),"/");
			setcookie("cha_id_tie",$usuario_sesion["cha_id_tie"],time()+(60*60*24*365),"/");

			$obj_ses->cod_tie=$usuario_sesion["cod_tie"];
			$obj_ses->asignar_valor();
			$obj_ses->puntero=$obj_ses->contador(); 
			$cont=$obj_ses->extraer_dato();

			header("location: ../../../../tienda/frontend/pages/menu.php");
			exit();

		}else{

			header("location:  ../../../index.php?val=2");
			
		}

		break;

	case 'cerrar': $obj_ses->cerrar();
	setcookie("cod_tie","",time()-1000,"/");
	setcookie("ema_tie","",time()-1000,"/");
	setcookie("pas_tie","",time()-1000,"/");
	setcookie("raz_tie","",time()-1000,"/");
	setcookie("cha_id_tie","",time()-1000,"/");
	header("location:  ../../../index.php?val=3");
	exit();

	default: 

	header("location: ../../../index.php?val=5");
	exit();


}
