<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class seguimiento_orden_compra extends utilidad {
	
		
public $cod_seg_ord_com;
public $orden_compra_cod_ord_com;
public $estatu_pedido_cod_est_ped;
public $tienda_cod_tie;
public $domiciliario_cod_dom;
public $usuario_cod_usu;
public $fec_seg_ord_com;
public $seg_seg_ord_compublic;

	/*VARIABLES EXTERNAS*/
	public $cod_ord_com;
	public $cod_tie;
	public $direccion;




	public function seguimiento(){
			
		 $this->que_dba="
			SELECT * FROM orden_compra oc, seguimiento_orden_compra soc
				WHERE oc.cod_ord_com=soc.orden_compra_cod_ord_com
				AND oc.tienda_cod_tie='".$this->cod_tie."'
				AND soc.estatu_pedido_cod_est_ped <> 6
			
				AND oc.cod_ord_com='".$this->cod_ord_com."'; "; 	
    
		return $this->ejecutar();
	}




	

} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>