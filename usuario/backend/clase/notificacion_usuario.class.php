<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class notificacion_usuario extends utilidad {
	
		
public $cod_not;
public $not_ale;
public $estatus;
public $orden_compra_cod_ord_com;
public $domiciliario_cod_dom;
public $usuario_cod_usu;




	/*VARIABLES EXTERNAS*/
	

	public function not_seguimiento(){
			
		 $this->que_dba="
			SELECT * FROM estatu_pedido e, notificacion_usuario nu, orden_compra oc, tienda ti
			WHERE nu.orden_compra_cod_ord_com=oc.cod_ord_com
			AND oc.tienda_cod_tie=ti.cod_tie
			AND nu.estatus=1
            AND nu.estatu_pedido_cod_est_ped = e.cod_est_ped
			AND nu.usuario_cod_usu='".$_SESSION['cod_usu']."';"; 	
			    
		return $this->ejecutar();
	}

	public function cambio_estatus(){
			
		 $this->que_dba="
			UPDATE notificacion_usuario SET 
			estatus= 0
			WHERE usuario_cod_usu='".$_SESSION['cod_usu']."';"; 	
			    
		return $this->ejecutar();
	}




	

} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>