<?php

if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

		require_once("../../clase/horario_tienda.class.php");

		$obj_horario_tienda= new horario_tienda;
		$obj_horario_tienda->asignar_valor();


		/* ACCION ME DIRA QUE DEBO HACER*/
		switch ($_REQUEST["accion"]) {
			
			case 'actualizar_dia': $obj_horario_tienda->resultado=$obj_horario_tienda->horario_semana(); 
				break;

			case 'actualizar_hora': $obj_horario_tienda->resultado=$obj_horario_tienda->horas(); 
				break;

			case 'activar_horario': $obj_horario_tienda->resultado=$obj_horario_tienda->new_horario(); 
				break;



			
}

}else {
	header("location: ../../../index.php");
}	

?>