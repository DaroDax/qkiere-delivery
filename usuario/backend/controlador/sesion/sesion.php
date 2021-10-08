<?php 
require("../../clase/sesion.class.php");
/*  INSTANCIO  UN OBJETO DE LA CLASE USUARIO */

$obj_ses = new sesion;

$obj_ses->asignar_valor();
//Google

switch ($_REQUEST["accion"]) {
	case 'sesion':  
		$obj_ses->puntero=$obj_ses->validar_sesion(); 
		$usuario_sesion=$obj_ses->extraer_dato();
	
		if($usuario_sesion["cod_usu"]>0){
	
		// Variables de session de usuario

			session_start ();
			$_SESSION ["cod_usu"] =  $usuario_sesion["cod_usu"];
			$_SESSION ["ema_usu"] =  $usuario_sesion["ema_usu"];
			$_SESSION ["pas_usu"] =  $usuario_sesion["pas_usu"];
			$_SESSION ["nom_usu"] =  $usuario_sesion["nom_usu"];

			setcookie("cod_usu",$usuario_sesion["cod_usu"],time()+(60*60*24*365),"/");
			setcookie("ema_usu",$usuario_sesion["ema_usu"],time()+(60*60*24*365),"/");
			setcookie("pas_usu",$usuario_sesion["pas_usu"],time()+(60*60*24*365),"/");
			setcookie("nom_usu",$usuario_sesion["nom_usu"],time()+(60*60*24*365),"/");
				
			?>

			<script> Android.getData(email); </script>
			
			<?php
			header("location:  ../../../frontend/pages/menu.php");
		
			
			exit();

		}else{
			
			header("location:  ../../../frontend/pages/login.php?val=2");
		}

	break;


		case 'sesion_email':  
		$obj_ses->puntero=$obj_ses->validar_sesion_email(); 
		$usuario_sesion=$obj_ses->extraer_dato();
	
		if($usuario_sesion["cod_usu"]>0){
	
		// Variables de session de usuario

			session_start ();
			$_SESSION ["cod_usu"] =  $usuario_sesion["cod_usu"];
			$_SESSION ["ema_usu"] =  $usuario_sesion["ema_usu"];
			$_SESSION ["nom_usu"] =  $usuario_sesion["nom_usu"];

			setcookie("cod_usu",$usuario_sesion["cod_usu"],time()+(60*60*24*365),"/");
			setcookie("ema_usu",$usuario_sesion["ema_usu"],time()+(60*60*24*365),"/");
			setcookie("nom_usu",$usuario_sesion["nom_usu"],time()+(60*60*24*365),"/");
				
			?>

			<script> Android.getData(email); </script>

			<?php
			header("location:  ../../../frontend/pages/menu.php");
		
			
			exit();

		}else{

			header("location:  ../../../frontend/index.php?val=2");
		}

	break;


		

	case 'cerrar': $obj_ses->cerrar();
	setcookie("cod_usu","",time()-1000,"/");
	setcookie("ema_usu","",time()-1000,"/");
	setcookie("pas_usu","",time()-1000,"/");
	setcookie("nom_usu","",time()-1000,"/");
	header("location:  ../../../frontend/pages/login.php");
	exit();

	default: 

	header("location: ../../../login.php");
	exit();
}



?>

