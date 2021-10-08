<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

require_once("utilidad.class.php");


	class orden_compra extends utilidad {
	
		
public $cod_ord_com;
public $tienda_cod_tie;
public $fec_ord_ped;
public $mon_ord_ped;
public $mon_del_ord_ped;
public $cod_qr_ord_com;
public $direccion_usuario_cod_dir_usu;
public $usuario_cod_usu;
public $estatu_pedido_cod_est_ped;
public $act_ord_ped;


	/*VARIABLES EXTERNAS */

	public $cod_mun;
	public $cod_cat_tie;
	public $cod_tie;
	public $cod_usu;


	public function consultar_orden_compra(){
			$this->que_dba="SELECT * FROM orden_compra oc, tienda ti
			WHERE oc.tienda_cod_tie=ti.cod_tie 
			AND oc.cod_qr_ord_com='".$this->cod_qr_ord_com."'; ";

		return $this->ejecutar();
	}

		
	public function consultar(){


		$filtro1=($_SESSION["tienda_cod_tie"]>0)?" 
			* FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='2'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND ti.cod_tie='".$_SESSION ["tienda_cod_tie"]."'
					AND mun.cod_mun='".$_SESSION['cod_mun']."';"
			:"
			* FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='2'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND mun.cod_mun='".$_SESSION['cod_mun']."';";


			$this->que_dba="SELECT $filtro1;";

		return $this->ejecutar();
	}

		public function comparar_codigo(){
			$this->que_dba="SELECT * FROM orden_compra WHERE cod_ord_com = '".$this->cod_ord_com."'; ";
			return $this->ejecutar();
		}

		public function orden_compra_aceptada(){

			$this->que_dba="SELECT * FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='3'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}

	public function orden_compra_recibida(){

			$this->que_dba="SELECT * FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='4'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}

	public function orden_compra_entregada(){

			$this->que_dba="SELECT * FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='5'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}

	/*Barra de busqueda*/
	public function orden_compra_entregada2(){

			$this->que_dba="SELECT * FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='5'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}



	/**/

		public function aceptar_orden(){

			$this->que_dba="UPDATE seguimiento_orden_compra SET seg_seg_ord_com=1 
			WHERE orden_compra_cod_ord_com='".$this->cod_ord_com."'  ; ";
		 $this->ejecutar();

		 $this->que_dba="INSERT INTO  notificacion_usuario
			(not_ale,
			estatus,
			orden_compra_cod_ord_com,
			usuario_cod_usu,
			estatu_pedido_cod_est_ped,
			tienda_cod_tie
			)VALUES(
			'Su orden de compra ha sido',
			'1',
			'".$this->cod_ord_com."',
			'".$this->cod_usu."',
			'3',
			'".$this->cod_tie."');";
            $this->ejecutar();

            $this->que_dba="INSERT INTO chat_dom(					
				men_chat_dom,
				usuario_cod_usu,
				domiciliario_cod_dom,
				per_chat_dom,
				lei_chat_dom,
				fec_chat_dom,
				estatu_pedido_cod_est_ped)
			VALUES ('He aceptado tu pedido para ir a recogerlo, pronto estare en la puerta de tu casa con tu orden',
			'".$this->cod_usu."',
			'".$_SESSION['cod_dom']."',
			'T',
			'1',
			Now(),
			'1'); ";
		 $this->ejecutar();

			$fecha=date("Y-m-d H:m:s");
		$this->que_dba="INSERT INTO seguimiento_orden_compra
		 (orden_compra_cod_ord_com,
		 estatu_pedido_cod_est_ped,
		 tienda_cod_tie,
		 domiciliario_cod_dom,
		 usuario_cod_usu,
		 fec_seg_ord_com,
		 seg_seg_ord_com) VALUES 
		 ('".$this->cod_ord_com."','3','".$this->cod_tie."','".$_SESSION['cod_dom']."',
		 '".$this->cod_usu."','".$fecha."',0); ";
		return $this->ejecutar();

		

	}

			public function recibir_paquete(){

		$this->que_dba="UPDATE seguimiento_orden_compra SET seg_seg_ord_com=1 
			WHERE orden_compra_cod_ord_com='".$this->cod_ord_com."'  ; ";
		 $this->ejecutar();

		  $this->que_dba="INSERT INTO  notificacion_usuario
			(not_ale,
			estatus,
			orden_compra_cod_ord_com,
			usuario_cod_usu,
			estatu_pedido_cod_est_ped,
			tienda_cod_tie
			)VALUES(
			'Su orden de compra ha sido',
			'1',
			'".$this->cod_ord_com."',
			'".$this->cod_usu."',
			'4',
			'".$this->cod_usu."');";
            $this->ejecutar();

			$fecha=date("Y-m-d H:m:s");
		$this->que_dba="INSERT INTO seguimiento_orden_compra
		 (orden_compra_cod_ord_com,
		 estatu_pedido_cod_est_ped,
		 tienda_cod_tie,
		 domiciliario_cod_dom,
		 usuario_cod_usu,
		 fec_seg_ord_com,
		 seg_seg_ord_com) VALUES 
		 ('".$this->cod_ord_com."','4','".$this->cod_tie."','".$_SESSION['cod_dom']."',
		 '".$this->cod_usu."','".$fecha."',0); ";
		return $this->ejecutar();

		

	}

	public function entregar_paquete(){

		$this->que_dba="UPDATE seguimiento_orden_compra SET seg_seg_ord_com=1 
			WHERE orden_compra_cod_ord_com='".$this->cod_ord_com."'  ; ";
		 $this->ejecutar();

		   $this->que_dba="INSERT INTO  notificacion_usuario
			(not_ale,
			estatus,
			orden_compra_cod_ord_com,
			usuario_cod_usu,
			estatu_pedido_cod_est_ped,
			tienda_cod_tie
			)VALUES(
			'Su orden de compra ha sido',
			'1',
			'".$this->cod_ord_com."',
			'".$this->cod_usu."',
			'5',
			'".$this->cod_usu."');";
            $this->ejecutar();

             $this->que_dba="INSERT INTO  notificacion_tienda
			(not_ale_tie,
			estatu_tie,
			tienda_cod_tie,
			estatu_pedido_cod_est_ped,
			orden_compra_cod_ord_com
			)VALUES(
			'La orden ha sido entregada al cliente =',
			'1',
			'".$this->cod_tie."',
			'5',
			'".$this->cod_ord_com."');";
            $this->ejecutar();

			$fecha=date("Y-m-d H:m:s");
		$this->que_dba="INSERT INTO seguimiento_orden_compra
		 (orden_compra_cod_ord_com,
		 estatu_pedido_cod_est_ped,
		 tienda_cod_tie,
		 domiciliario_cod_dom,
		 usuario_cod_usu,
		 fec_seg_ord_com,
		 seg_seg_ord_com) VALUES 
		 ('".$this->cod_ord_com."','5','".$this->cod_tie."','".$_SESSION['cod_dom']."',
		 '".$this->cod_usu."','".$fecha."',0); ";
		return $this->ejecutar();

		

	}

/*Contadores*/

public function cont_orden_aceptadas(){

			$this->que_dba="SELECT COUNT(*) AS acepted FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='3'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}

	public function cont_orden_recibidas(){

			$this->que_dba="SELECT COUNT(*) AS recibed FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='4'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}

	public function entregadas(){

			$this->que_dba="SELECT * FROM orden_compra oc, usuario us, direccion_usuario du, tienda ti, seguimiento_orden_compra soc, sector sec, municipio mun
					WHERE ti.cod_tie=oc.tienda_cod_tie
					AND oc.direccion_usuario_cod_dir_usu=du.cod_dir_usu
					AND du.usuario_cod_usu=us.cod_usu
					AND oc.cod_ord_com=soc.orden_compra_cod_ord_com
					AND ti.cod_tie=soc.tienda_cod_tie
					AND soc.estatu_pedido_cod_est_ped='5'
					AND soc.seg_seg_ord_com=0
					AND ti.sector_cod_sec=sec.cod_sec
					AND sec.municipio_cod_mun=mun.cod_mun
					AND soc.domiciliario_cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();

		

	}











	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>