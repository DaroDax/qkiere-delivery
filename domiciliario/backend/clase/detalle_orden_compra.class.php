<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

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
				AND doc.orden_compra_cod_ord_com='".$this->cod_ord_com."'; ";

		return $this->ejecutar();

	}
	




	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>