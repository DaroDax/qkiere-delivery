<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class orden_compra extends utilidad {
	
		
public $cod_ord_com;
public $tienda_cod_tie;
public $fec_ord_ped;
public $mon_ord_ped;
public $mon_del_ord_ped;
public $direccion_usuario_cod_dir_usu;
public $usuario_cod_usu;
public $estatu_pedido_cod_est_ped;
public $act_ord_ped;


	/*VARIABLES EXTERNAS */

	public $cod_mun;
	public $cod_cat_tie;
	public $codigo;
	public $cod_usu;


	
	public function consultar(){
			$this->que_dba="SELECT * FROM tienda t, sector s, municipio m
							WHERE t.sector_cod_sec=s.cod_sec
							AND s.municipio_cod_mun=m.cod_mun
							AND t.cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}
		public function consultar_orden_pendientes(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 direccion_usuario du,
			 sector s,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.direccion_usuario_cod_dir_usu = du.cod_dir_usu
			AND du.sector_cod_sec = s.cod_sec
			AND so.estatu_pedido_cod_est_ped=1
			AND seg_seg_ord_com=0
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND t.cod_tie='".$_SESSION['cod_tie']."'
			ORDER BY orden_compra_cod_ord_com ASC; ";
		return $this->ejecutar();

		

	}

	public function consultar_orden_pendientes_2(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND so.estatu_pedido_cod_est_ped=3
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND t.cod_tie='".$_SESSION['cod_tie']."'; ";
		return $this->ejecutar();

		

	}

	public function consultar_orden_aceptada_tienda(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 direccion_usuario du,
			 sector s,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.direccion_usuario_cod_dir_usu = du.cod_dir_usu
			AND du.sector_cod_sec = s.cod_sec
			AND so.estatu_pedido_cod_est_ped=2
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND so.seg_seg_ord_com=0
			AND t.cod_tie='".$_SESSION['cod_tie']."'
			ORDER BY orden_compra_cod_ord_com ASC; ";
		return $this->ejecutar();
	}

	public function consultar_orden_aceptada_domiciliario(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 direccion_usuario du,
			 sector s,
			 seguimiento_orden_compra so,
			 domiciliario d
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.direccion_usuario_cod_dir_usu = du.cod_dir_usu
			AND du.sector_cod_sec = s.cod_sec
			AND d.cod_dom = so.domiciliario_cod_dom
			AND so.estatu_pedido_cod_est_ped=3
			AND so.seg_seg_ord_com=0
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND t.cod_tie='".$_SESSION['cod_tie']."'
			ORDER BY orden_compra_cod_ord_com ASC; ";
		return $this->ejecutar();
	}



	public function consultar_orden_compra_pendiente(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND so.estatu_pedido_cod_est_ped=3
			AND oc.cod_ord_com='".$this->cod_ord_com."'
			AND t.cod_tie='".$_SESSION['cod_tie']."'; ";
		return $this->ejecutar();

		

	}

	public function cuentas(){
		$query = $this->que_dba="SELECT COUNT(*) AS total FROM orden_compra oc, seguimiento_orden_compra so WHERE so.estatu_pedido_cod_est_ped = 1 
		AND oc.cod_ord_com=so.orden_compra_cod_ord_com
		AND oc.tienda_cod_tie= '".$_SESSION['cod_tie']."' ;";
		
		return $this->ejecutar();
	}

public function new_orden(){
		$this->que_dba="SELECT COUNT(*) AS new_ord FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 direccion_usuario du,
			 sector s,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.direccion_usuario_cod_dir_usu = du.cod_dir_usu
			AND du.sector_cod_sec = s.cod_sec
			AND so.estatu_pedido_cod_est_ped=1
			AND seg_seg_ord_com=0
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND t.cod_tie= '".$_SESSION['cod_tie']."';";
		
		return $this->ejecutar();	
	}

	public function ord_aceptada(){

			$this->que_dba="SELECT COUNT(*) AS acp_ord FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 direccion_usuario du,
			 sector s,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.direccion_usuario_cod_dir_usu = du.cod_dir_usu
			AND du.sector_cod_sec = s.cod_sec
			AND so.estatu_pedido_cod_est_ped=2
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND so.seg_seg_ord_com=0
			AND t.cod_tie='".$_SESSION['cod_tie']."'; ";
		return $this->ejecutar();
	}



public function aceptar_orden(){

		$codigo = $this->cod_ord_com; 

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
			'2',
			'".$_SESSION['cod_tie']."');";
            $this->ejecutar();

            $this->que_dba="INSERT INTO  notificacion_domicilio
			(not_ale_dom,
			estatu_dom,
			estatu_pedido_cod_est_ped,
			orden_compra_cod_ord_com,
			tienda_cod_tie
			)VALUES(
			'Hay una orden disponible para repartir',
			'1',
			'1',
			'".$this->cod_ord_com."',
			'".$_SESSION['cod_tie']."');";
            $this->ejecutar();

            $this->que_dba="INSERT INTO chat_usu(					
				men_chat_usu,
				usuario_cod_usu,
				tienda_cod_tie,
				per_chat_usu,
				lei_chat_usu,
				fec_men_usu,
				estatu_pedido_cod_est_ped)
			VALUES ('Hemos aceptado tu orden, por favor espera mientras la preparamos y te la enviamos!',
			'".$this->cod_usu."',
			'".$_SESSION['cod_tie']."',
			'T',
			'1',
			Now(),
			'1'); ";

		 $this->ejecutar();


      
       


		$this->que_dba="UPDATE inventario i
		INNER JOIN detalle_orden_compra doc ON i.cod_inv = doc.inventario_cod_inv
		SET i.can_inv = i.can_inv - doc.can_det_ord_com
		WHERE doc.orden_compra_cod_ord_com ='".$this->cod_ord_com."'
		AND i.tienda_cod_tie='".$_SESSION['cod_tie']."';";
	
	$this->ejecutar();

		

	$this->que_dba="UPDATE seguimiento_orden_compra SET seg_seg_ord_com=1 
			WHERE orden_compra_cod_ord_com='".$this->cod_ord_com."'  ; ";
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
		 ('".$this->cod_ord_com."',2,'".$_SESSION['cod_tie']."',NULL,
		 '".$this->cod_usu."','".$fecha."', 0); ";
		return $this->ejecutar();

		
	}

	public function eliminar_logico(){
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
			'6',
			'".$_SESSION['cod_tie']."');";
            $this->ejecutar();

		$this->que_dba="UPDATE seguimiento_orden_compra
 SET estatu_pedido_cod_est_ped='6' 
		WHERE tienda_cod_tie='".$_SESSION['cod_tie']."' AND orden_compra_cod_ord_com='".$this->cod_ord_com."'";
		
		return $this->ejecutar();

		
	}
	


public function realizadas(){

			$this->que_dba="SELECT * FROM orden_compra oc ,
			 estatu_pedido ep, 
			 tienda t,
			 usuario u,
			 direccion_usuario du,
			 sector s,
			 seguimiento_orden_compra so
			WHERE 
			 so.estatu_pedido_cod_est_ped= ep.cod_est_ped
			AND t.cod_tie=oc.tienda_cod_tie
			AND u.cod_usu=oc.usuario_cod_usu
			AND oc.direccion_usuario_cod_dir_usu = du.cod_dir_usu
			AND du.sector_cod_sec = s.cod_sec
			AND so.estatu_pedido_cod_est_ped=5
			AND seg_seg_ord_com=0
			AND oc.cod_ord_com=so.orden_compra_cod_ord_com
			AND t.cod_tie='".$_SESSION['cod_tie']."'
			ORDER BY orden_compra_cod_ord_com ASC; ";
		return $this->ejecutar();

		

	}
	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>