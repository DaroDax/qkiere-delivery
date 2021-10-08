<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class orden_compra extends utilidad {

	public $cod_ord_com;
	public $tienda_cod_tie;
	public $fec_ord_com;
	public $mon_ord_com;
	public $mon_del_ord_com;
	public $direccion_usuario_cod_dir_usu;
	public $usuario_cod_usu;
	public $estatu_pedido_cod_est_com;
	public $act_ord_com;

	/*VARIABLES EXTERNAS*/
	public $cod_inv;
	public $cod_tie;
	public $direccion;




	public function insertar(){

		$this->que_dba="INSERT INTO  notificacion_tienda
			(not_ale_tie,
			estatu_tie,
			tienda_cod_tie,
			estatu_pedido_cod_est_ped,
			orden_compra_cod_ord_com
			)VALUES(
			'Se ha generado la orden',
			'1',
			'".$this->cod_tie."',
			'1',
			Null);";
            $this->ejecutar();

		/*GENERADOR DE CODIGO*/
		 $alpha = "1234567890";
		$code = "";
		$longitud=5;
		for($i=0;$i<$longitud;$i++){
		    $code .=$alpha[rand(1, strlen($alpha)-1)];
		}
		$fecha=date("Y-m-d H:m:s");

			$this->que_dba="INSERT INTO orden_compra(
				tienda_cod_tie,
				fec_ord_ped,
				mon_ord_ped,
				mon_del_ord_ped,
				cod_qr_ord_com,
				direccion_usuario_cod_dir_usu,
				usuario_cod_usu,
				act_ord_ped)
			VALUES ('".$this->cod_tie."',
			Now(),
			'".$this->mon_ord_ped."',
			'".$this->mon_del_ord_ped."',
			'".$code."',
			'".$this->direccion."',
			'".$_SESSION['cod_usu']."',
			Now()); ";
			 $this->ejecutar();

			$this->que_dba="INSERT INTO chat_usu(					
				men_chat_usu,
				usuario_cod_usu,
				tienda_cod_tie,
				per_chat_usu,
				lei_chat_usu,
				fec_men_usu,
				estatu_pedido_cod_est_ped)
			VALUES ('Has realizado un pedido en nuestra tienda, por cualquier duda escribenos!',
			'".$_SESSION['cod_usu']."',
			'".$this->cod_tie."',
			'T',
			'1',
			Now(),
			'1'); ";

		 $this->ejecutar();


/* INSERTA EL DETALLE DE LA ORDEN DE COMPRA */


			$this->que_dba="
			SELECT *
			FROM orden_compra
			estatu_pedido_cod_est_ped='1'
			usuario_cod_usu='".$_SESSION['cod_usu']."'
			tienda_cod_tie='".$this->cod_tie."'
			ORDER BY cod_ord_com DESC ";

		 $this->ejecutar();


			$this->que_dba="INSERT INTO detalle_orden_compra(inventario_cod_inv,
				orden_compra_cod_ord_com,
				can_det_ord_com,
				obs_det_ord_com,
				mon_det_ord_com,
				mon_tot_det_ord_com)

			SELECT i.cod_inv, oc.cod_ord_com, tp.can_tem_ped, tp.obs_tem_ped, tp.pre_tem_ped, tp.tot_tem_ped
			FROM temp_pedido tp, inventario i JOIN orden_compra oc ON oc.tienda_cod_tie=i.tienda_cod_tie
			WHERE tp.inventario_cod_inv=i.cod_inv
			AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND i.tienda_cod_tie='".$this->cod_tie."'
			AND oc.cod_ord_com = (SELECT MAX(cod_ord_com) FROM orden_compra)
			ORDER BY oc.cod_ord_com DESC ";

		 $this->ejecutar();


/* BORRA LOS DATOS DE LA TABLA TEMPORAL DEL PEDIDO */
	 $this->que_dba="
    	DELETE tp FROM  temp_pedido tp JOIN  inventario i
		ON i.cod_inv=tp.inventario_cod_inv
    	WHERE i.tienda_cod_tie= '".$this->cod_tie."'
    AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."';";
		 $this->ejecutar();




/* INSERT DE TABLA SEGUIMIENTO ORDEN COMPRA */
		$this->que_dba="

			INSERT INTO seguimiento_orden_compra
			(orden_compra_cod_ord_com,
					estatu_pedido_cod_est_ped,
					tienda_cod_tie,
					domiciliario_cod_dom,
					usuario_cod_usu,
					fec_seg_ord_com,
					seg_seg_ord_com
			)

			SELECT oc.cod_ord_com, 1,oc.tienda_cod_tie,Null,oc.usuario_cod_usu,Now(),0
			 FROM orden_compra oc
			 WHERE oc.tienda_cod_tie='".$this->cod_tie."'
			 AND oc.usuario_cod_usu='".$_SESSION['cod_usu']."'
			 ORDER  BY oc.cod_ord_com DESC LIMIT 1;";
		return $this->ejecutar();
	}


	/* CONSULTA EL CARRO DE CADA TIENDA */
	public function consulta_carrito(){

	    $this->que_dba="SELECT * FROM   t, inventario i
	    where
	    t.inventario_cod_inv=i.cod_inv
	    AND t.usuario_cod_usu='".$_SESSION['cod_usu']."' AND t.cod_tem_ped='".$this->cod_tem_ped."'; ";

		return $this->ejecutar();
	}

	public function listar_carrito(){

		 $this->que_dba="
			SELECT * FROM temp_pedido tp, inventario i
				WHERE tp.inventario_cod_inv=i.cod_inv
				AND i.tienda_cod_tie='".$this->cod_tie."'
				AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'; ";

		return $this->ejecutar();
	}

	public function sumatoria_tem_pedido(){

    $this->que_dba="SELECT SUM(tot_tem_ped) AS total_pedido
    FROM temp_pedido tp, inventario i
    WHERE
    tp.inventario_cod_inv=i.cod_inv
    AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'
    AND i.tienda_cod_tie='".$this->cod_tie."'; ";
		return $this->ejecutar();
	}


	public function eliminar_orden_compra(){

	    $this->que_dba="
	    		UPDATE seguimiento_orden_compra
		SET estatu_pedido_cod_est_ped=6
		WHERE orden_compra_cod_ord_com = '".$this->cod_ord_com."';";

		return $this->ejecutar();
			/*	UPDATE orden_compra oc
		INNER JOIN seguimiento_orden_compra soc
		ON soc.orden_compra_cod_ord_com = oc.cod_ord_com
		SET oc.estatu_pedido_cod_est_ped=6 , soc.estatu_pedido_cod_est_ped=6
		WHERE oc.cod_ord_com = '".$this->cod_ord_com."' */
	}






	public function checkout(){

	    $this->que_dba="SELECT * FROM  temp_pedido tp, inventario i
	    WHERE tp.inventario_cod_inv=i.cod_inv
	    AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'
	    AND i.tienda_cod_tie='".$this->cod_tie."'; ";
		return $this->ejecutar();
	}

	public function orden_compra_p(){

	    $this->que_dba= "SELECT * FROM orden_compra oc , tienda t, seguimiento_orden_compra so 
			WHERE t.cod_tie=oc.tienda_cod_tie
			AND so.orden_compra_cod_ord_com = oc.cod_ord_com
			AND so.estatu_pedido_cod_est_ped < 6
			AND so.seg_seg_ord_com = 0
      
			AND oc.usuario_cod_usu = '".$_SESSION['cod_usu']."' ORDER BY cod_ord_com DESC; ";
		return $this->ejecutar();

		/* ESTO SIRVE PARA MOSTRAR LOS ESTATUS 1,3,5 */
		//AND oc.estatu_pedido_cod_est_ped in ( 1, 3, 5)
	}

	public function orden_compra_p_contador(){

	    $this->que_dba= "SELECT COUNT(*) as ped FROM orden_compra oc , tienda t, seguimiento_orden_compra so 
			WHERE t.cod_tie=oc.tienda_cod_tie
			AND so.orden_compra_cod_ord_com = oc.cod_ord_com
			AND so.estatu_pedido_cod_est_ped < 6
			AND so.seg_seg_ord_com = 0
      
			AND oc.usuario_cod_usu = '".$_SESSION['cod_usu']."'; ";
		return $this->ejecutar();

		/* ESTO SIRVE PARA MOSTRAR LOS ESTATUS 1,3,5 */
		//AND oc.estatu_pedido_cod_est_ped in ( 1, 3, 5)
	}

	public function mostrar_monto(){

	    $this->que_dba= "SELECT * FROM orden_compra oc
			WHERE oc.cod_ord_com = '".$this->cod_ord_com."'; ";
		return $this->ejecutar();

		/* ESTO SIRVE PARA MOSTRAR LOS ESTATUS 1,3,5 */
		//AND oc.estatu_pedido_cod_est_ped in ( 1, 3, 5)
	}

	public function mostrar_domi(){

	    $this->que_dba= "SELECT * FROM  domiciliario d
			WHERE d.cod_dom = '".$this->domiciliario_cod_dom."'; ";

		return $this->ejecutar();

		/* ESTO SIRVE PARA MOSTRAR LOS ESTATUS 1,3,5 */
		//AND oc.estatu_pedido_cod_est_ped in ( 1, 3, 5)
	}






	public function consulta_detalle_orden_compra(){

	  	$this->que_dba="SELECT * FROM inventario i, detalle_orden_compra doc
				WHERE i.cod_inv=doc.inventario_cod_inv
				AND doc.orden_compra_cod_ord_com='".$this->cod_ord_com."'; ";
		return $this->ejecutar();
				//AND i.tienda_cod_tie='".$_SESSION['cod_usu']."'
		//AND oc.estatu_pedido_cod_est_ped=1
	}




} /// FIN DE CLASE


}else {
	header("location: ../../../index.php");
}
?>
