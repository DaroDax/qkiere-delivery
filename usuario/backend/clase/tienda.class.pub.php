<?php

require_once("utilidad.class.php");


	class tienda_pub extends utilidad {
	public $cod_tie;
	public $tip_doc_tie;
	public $ced_tie;
	public $raz_tie;
	public $dir_tie;
	public $pun_ref_tie;
	public $tel_tie;
	public $tel2_tie;
	public $ema_tie;
	public $log_tie;
	public $fec_tie;
	public $categoria_tienda_cod_cat_tie;
	public $estatu_cod_est;
	public $municipio_cod_mun;
	public $company_cod_com;
	public $act_cli;


	/*VARIABLES EXTERNAS */

	public $cod_mun;
	public $cod_inv;
	public $cod_cat_tie;
	public $cod_cat_pro;




	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			   tienda t,
			   categoria_tienda ct
			   WHERE t.categoria_tienda_cod_cat_tie=ct.cod_cat_tie
			   AND  t.estatu_cod_est = '1'; ";

		return $this->ejecutar();

	}

	public function tienda()
	{

		$this->que_dba = "SELECT 
			*
			FROM 
			   tienda t,
			   categoria_tienda ct,
			   horario_tienda ht
			   WHERE t.categoria_tienda_cod_cat_tie=ct.cod_cat_tie
			   AND ht.tienda_cod_tie = t.cod_tie
			   AND  t.estatu_cod_est = '1'
			   AND t.cod_tie = '".$this->cod_tie."'; ";

		return $this->ejecutar();
	}

	public function cat_producto()
	{

		$this->que_dba = "SELECT 
			*
			FROM 
			   tienda t,
			   categoria_tienda ct,
			   categoria_producto cp,
			   inventario i
			   WHERE t.categoria_tienda_cod_cat_tie=ct.cod_cat_tie
			   AND cp.categoria_tienda_cod_cat_tie = ct.cod_cat_tie
			   AND  t.estatu_cod_est = '1'
			   AND i.categoria_producto_cod_cat_pro = cp.cod_cat_pro
			   AND i.tienda_cod_tie = t.cod_tie
			   AND t.cod_tie = '" . $this->cod_tie . "' GROUP BY nom_cat_pro; ";

		return $this->ejecutar();
	}


	public function mostrar(){
			$this->que_dba= "SELECT * FROM tienda t, sector s, municipio m, horario_tienda hr, categoria_tienda ct WHERE s.municipio_cod_mun = cod_mun
				AND ct.cod_cat_tie = t.categoria_tienda_cod_cat_tie
				AND hr.tienda_cod_tie = t.cod_tie
				AND t.sector_cod_sec = s.cod_sec
				AND m.cod_mun = '".$this->cod_mun. "' ORDER BY RAND();"; 
			return $this->ejecutar();
	}

	public function inventario_tienda()
	{
		$this->que_dba = "SELECT * FROM inventario i, tienda t, categoria_producto cp 
			WHERE i.tienda_cod_tie = t.cod_tie
			AND cp.cod_cat_pro = i.categoria_producto_cod_cat_pro
			AND i.estatu_cod_est = '1'
			AND t.cod_tie = '".$this->cod_tie. "' 
			AND cp.cod_cat_pro like '%" . $this->cod_cat_pro . "%'
			ORDER BY nom_inv ASC;";
		return $this->ejecutar();
	}

	public function consultar(){

			$this->que_dba="SELECT 
			*
			FROM 
			   tienda t,
			   categoria_tienda ct
			   WHERE t.categoria_tienda_cod_cat_tie=ct.cod_cat_tie
			   AND t.cod_tie='".$this->cod_tie."'
			   AND  t.estatu_cod_est = '1'; ";

		return $this->ejecutar();

	}
	public function filtrar(){



			$filtro1=($this->cod_tie>0)? " *
				FROM tienda t,sector s, municipio m ,categoria_tienda ct,inventario i, categoria_producto cp
				WHERE t.categoria_tienda_cod_cat_tie=ct.cod_cat_tie 
				AND s.cod_sec=t.sector_cod_sec 
				AND s.municipio_cod_mun= m.cod_mun 
				AND i.tienda_cod_tie=t.cod_tie 
				AND i.categoria_producto_cod_cat_pro=cp.cod_cat_pro 
				AND t.cod_tie='".$this->cod_tie."' AND  t.estatu_cod_est = '1'  GROUP by t.raz_tie;":"";


			/* SI CUMPLE MUESTRA CATEGORIA Y MUNICIPIO 
				CASO CONTRARIO SOLO POR MUNICIPIO
			*/
				
	//echo "AQUI->".$this->cod_cat_tie;
			$filtro2=($this->cod_cat_tie>0 && $this->cod_mun>0)? "*
				FROM tienda t, sector s, municipio m, categoria_tienda ct, inventario i, categoria_producto cp, horario_tienda h
			WHERE t.sector_cod_sec=s.cod_sec
			AND s.municipio_cod_mun=m.cod_mun
			AND ct.cod_cat_tie=t.categoria_tienda_cod_cat_tie
			AND t.cod_tie=i.tienda_cod_tie
			AND m.cod_mun='".$this->cod_mun."' 
			AND i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
			AND h.tienda_cod_tie = t.cod_tie
			AND ct.cod_cat_tie='".$this->cod_cat_tie."'  GROUP by t.raz_tie; ":"";
				
/*
			$filtro3=($this->cod_mun>0)?"*
			FROM tienda t, sector s, municipio m, inventario i, categoria_producto cp, horario_tienda h
				WHERE t.sector_cod_sec=s.cod_sec
				AND s.municipio_cod_mun=m.cod_mun
				AND i.tienda_cod_tie=t.cod_tie
				AND i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
				AND h.tienda_cod_tie = t.cod_tie
				AND m.cod_mun='".$this->cod_mun."'  GROUP by t.raz_tie;":"";*/
    $this->que_dba="SELECT $filtro1 $filtro2 $filtro3;"; 
		
		return $this->ejecutar();
	}


	public function busqueda_tienda()
	{
		$this->que_dba = "
		SELECT * 
			FROM tienda t, sector s, municipio m, categoria_tienda ct, horario_tienda ht
			WHERE t.sector_cod_sec=s.cod_sec
			AND m.cod_mun=s.municipio_cod_mun
			AND ct.cod_cat_tie = t.categoria_tienda_cod_cat_tie
			AND ht.tienda_cod_tie = t.cod_tie
			AND t.estatu_cod_est='1'
			AND m.cod_mun= '" . $this->municipio . "'
			AND t.raz_tie like '%" . $this->texto . "%'; ";

		return $this->ejecutar();
	}

//Nuevas funciones//
	/* CONSULTA LA TIENDA SI HAY PEDIDOS DE DIFERENTES TIENDAS*/
	public function consulta_tienda_cart(){

    $this->que_dba="SELECT * FROM tienda t, inventario i, temp_pedido tp
			WHERE t.cod_tie=i.tienda_cod_tie
			AND i.cod_inv=tp.inventario_cod_inv
			AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'
			GROUP BY raz_tie;"; 
			 
		return $this->ejecutar();
	}


	
		
} /// FIN DE CLASE
	
?>