<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

require_once("utilidad.class.php");


	class notificacion_domicilio extends utilidad {
	
		
public $cod_not_dom;
public $not_ale_dom;
public $estatu_dom;
public $domiciliario_cod_dom;
public $estatu_pedido_cod_est_ped;






	/*VARIABLES EXTERNAS*/
	

	public function not_seguimiento(){
			
		 $this->que_dba="
			SELECT * FROM estatu_pedido e, notificacion_domicilio nd, tienda ti
			WHERE nd.estatu_dom=1
            AND nd.estatu_pedido_cod_est_ped = e.cod_est_ped
            AND nd.tienda_cod_tie = ti.cod_tie
			GROUP BY cod_not_dom";
			    
		return $this->ejecutar();
	}

	public function cambio_estatus(){

		$this->que_dba="
			UPDATE notificacion_domicilio SET 
			domiciliario_cod_dom='".$_SESSION['cod_dom']."'
			WHERE estatu_dom = 1"; 
		return $this->ejecutar();
	}

	public function inactivar(){
			
		 $this->que_dba="
			UPDATE notificacion_domicilio SET 
			estatu_dom= 0
			WHERE domiciliario_cod_dom='".$_SESSION['cod_dom']."';"; 	
			    
		return $this->ejecutar();
	}




	

} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>