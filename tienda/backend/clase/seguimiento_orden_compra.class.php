<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class seguimiento_orden_compra extends utilidad {
	
		
public $cod_seg_ord_com;
public $orden_compra_cod_ord_com;
public $estatu_pedido_cod_est_ped;
public $tienda_cod_tie;
public $domiciliario_cod_dom;
public $usuario_cod_usu;
public $fec_seg_ord_com;



	/*VARIABLES EXTERNAS */

	public $cod_ord_com;
	public $cod_cat_tie;


	
	public function insertar(){
			

			$this->que_dba="INSERT INTO seguimiento_orden_compra
			(orden_compra_cod_ord_com,
			estatu_pedido_cod_est_ped,
			tienda_cod_tie,
			domiciliario_cod_dom,
			usuario_cod_usu,
			fec_seg_ord_com
			)VALUES(
			'".$this->cod_ord_com."',
			'".$this->estatu."',
			'".$this->cod_tie."',
			'".$this->cod_dom."',
			'".$this->cod_usu."',
			Now()
			);";

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




	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>