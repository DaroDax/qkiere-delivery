<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class notificacion_tienda extends utilidad {
	
		
public $cod_not_tie;
public $not_ale_tie;
public $estatu_tie;
public $tienda_cod_tie;
public $estatu_pedido_cod_est_ped;
public $orden_compra_cod_ord_com;




	/*VARIABLES EXTERNAS*/
	

	public function not_seguimiento(){
			
		 $this->que_dba="
			SELECT * FROM estatu_pedido e, notificacion_tienda nt, tienda ti
			WHERE nt.estatu_tie=1
            AND nt.estatu_pedido_cod_est_ped = e.cod_est_ped
            AND nt.tienda_cod_tie = ti.cod_tie
			AND nt.tienda_cod_tie= '".$_SESSION['cod_tie']."'
			GROUP BY cod_not_tie";
			    
		return $this->ejecutar();
	}

	public function cambio_estatus(){
			
		 $this->que_dba="
			UPDATE notificacion_tienda SET 
			estatu_tie= 0
			WHERE tienda_cod_tie='".$_SESSION['cod_tie']."';"; 	
			    
		return $this->ejecutar();
	}




	

} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>