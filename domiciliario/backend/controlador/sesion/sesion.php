<?php 
require("../../clase/sesion.class.php");
/*  INSTANCIO  UN OBJETO DE LA CLASE USUARIO */

$obj_ses = new sesion;

$obj_ses->asignar_valor();


switch ($_REQUEST["accion"]) {
	case 'sesion':  
	$obj_ses->puntero=$obj_ses->validar_sesion(); 
	$usuario_sesion=$obj_ses->extraer_dato();

		if($usuario_sesion["cod_dom"]>0){
	
	
		// Variables de session de usuario

		session_start ();
		$_SESSION ["cod_dom"] = $usuario_sesion["cod_dom"];
		$_SESSION ["nom_dom"] =  $usuario_sesion["nom_dom"];
		$_SESSION ["ape_dom"] =  $usuario_sesion["ape_dom"];
		$_SESSION ["ema_dom"] =  $usuario_sesion["ema_dom"];
		$_SESSION ["pas_dom"] =  $usuario_sesion["pas_dom"];
		$_SESSION ["chat_id_dom"] =  $usuario_sesion["chat_id_dom"];
		$_SESSION ["cod_mun"] =  $usuario_sesion["cod_mun"];
		$_SESSION ["tienda_cod_tie"] =  $usuario_sesion["tienda_cod_tie"];

		setcookie("cod_dom",$usuario_sesion["cod_dom"],time()+(60*60*24*365),"/");
		setcookie("nom_dom",$usuario_sesion["nom_dom"],time()+(60*60*24*365),"/");
		setcookie("ape_dom",$usuario_sesion["ape_dom"],time()+(60*60*24*365),"/");
		setcookie("ema_dom",$usuario_sesion["ema_dom"],time()+(60*60*24*365),"/");
		setcookie("pas_dom",$usuario_sesion["pas_dom"],time()+(60*60*24*365),"/");
		setcookie("chat_id_dom",$usuario_sesion["chat_id_dom"],time()+(60*60*24*365),"/");
		setcookie("cod_mun",$usuario_sesion["cod_mun"],time()+(60*60*24*365),"/");
		setcookie("tienda_cod_tie",$usuario_sesion["tienda_cod_tie"],time()+(60*60*24*365),"/");
		
		

			header("location:  ../../../frontend/pages/menu.php");
			exit();

		}else{

			header("location:  ../../../index.php?val=2");
			
		}


	break;

	case 'cerrar': 

	$obj_ses->cerrar();
		
	setcookie("cod_dom","",time()-1000,"/");
	setcookie("ema_dom","",time()-1000,"/");
	setcookie("pas_dom","",time()-1000,"/");
	setcookie("nom_dom","",time()-1000,"/");
	setcookie("ape_dom","",time()-1000,"/");
	setcookie("chat_id_dom","",time()-1000,"/");
	setcookie("cod_mun","",time()-1000,"/");
	setcookie("tienda_cod_tie","",time()-1000,"/");
	header("location:  ../../../index.php");
	break;

	default: 

	header("location: ../../../index.php");
	exit();


}



?>