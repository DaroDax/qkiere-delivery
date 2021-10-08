<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class detalle_orden_compra extends utilidad {
	
		
	
public $cod_det_ord_com;
public $inventario_cod_inv;
public $orden_compra_cod_ord_com;
public $can_det_ord_com;
public $obs_det_ord_com;
public $mon_det_ord_com;
public $mon_tot_det_ord_com;


	/*VARIABLES EXTERNAS */

	public $cod_mun;
	public $cod_cat_tie;


	
	public function consultar(){
			$this->que_dba="SELECT * FROM inventario i, detalle_orden_compra doc
				WHERE i.cod_inv=doc.inventario_cod_inv
				AND i.tienda_cod_tie='".$_SESSION['cod_tie']."'
				AND doc.orden_compra_cod_ord_com='".$this->cod_ord_com."'; ";

		return $this->ejecutar();

	}
		public function consultar_orden_pendientes(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u
			WHERE 
			 oc.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.estatu_pedido_cod_est_ped=1
			AND t.cod_tie='".$_SESSION['cod_tie']."'; ";
		return $this->ejecutar();

		

	}

	public function consultar_orden_compra_pendiente(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u
			WHERE 
			 oc.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.estatu_pedido_cod_est_ped=1
			AND oc.cod_ord_com='".$this->cod_ord_com."'
			AND t.cod_tie='".$_SESSION['cod_tie']."'; ";
		return $this->ejecutar();

		

	}




	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>