<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class inventario extends utilidad {

	public $cod_inv;
	public $can_inv;
	public $nom_inv;
	public $des_inv;
	public $pre_inv;
	public $fec_inv;
	public $img_inv;
	public $tienda_cod_tie;
	public $categoria_cod_cat;
	public $estatu_cod_est;
	public $act_inv;

	
	/* VARIABLES EXTERNAS*/
	public $texto;
	public $municipio;




	public function listar(){

			$this->que_dba="
			SELECT * FROM inventario i, categoria_producto cp
			WHERE  i.categoria_producto_cod_cat_pro=cp.cod_cat_pro 
			AND i.tienda_cod_tie='".$this->tienda_cod_tie."'
			AND i.estatu_cod_est = '1'; ";

		return $this->ejecutar();

	}

	public function listar2(){

			$this->que_dba="
			SELECT * FROM inventario i, categoria_producto cp
			WHERE  i.categoria_producto_cod_cat_pro=cp.cod_cat_pro 
			AND i.estatu_cod_est = '1'; ";

		return $this->ejecutar();

	}

		public function Consulta_inicio(){
		
			$this->que_dba="
			SELECT * 
			FROM tienda t, inventario i, sector s, categoria_producto cp, municipio m
			WHERE t.cod_tie=i.tienda_cod_tie
			AND t.sector_cod_sec=s.cod_sec
			AND i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
			AND m.cod_mun=s.municipio_cod_mun
			AND  i.estatu_cod_est = '1'
			AND t.estatu_cod_est='1'
			AND m.cod_mun='".$this->municipio."'
			AND i.nom_inv  like '%".$this->texto."%'; ";

		return $this->ejecutar();

	}

	public function filtrar(){
		
			$filtro1=($this->cod_inv!="")?" * FROM inventario WHERE cod_inv='$this->cod_inv'":"";
			
			
    	$this->que_dba="SELECT $filtro1 ;"; 
		return $this->ejecutar();
	}



	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>