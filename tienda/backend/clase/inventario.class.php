<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class inventario extends utilidad {

	public $cod_inv;
	public $can_inv;
	public $nom_inv;
	public $des_inv;
	public $pre_inv;
	public $fec_inv;
	public $img_inv;
	public $cliente_cod_cli;
	public $categoria_cod_cat;
	public $estatu_cod_est;
	public $act_inv;
	public $tie_inv;

	public $cod_cli;
	public $categoria;
	public $cod_cat_pro;

	public $img;
	public $archivo;

	public function insertar(){



		$date=date("Y-m-d H:m:s");



		
	
		if($name_img!=''){	
		$fecha=date("Y-m-d H:m:s");
			$this->que_dba="INSERT INTO inventario 
			(can_inv,
			nom_inv,
			des_inv,
			pre_inv,
			fec_inv,
			img_inv,
			cliente_cod_cli,
			categoria_cod_cat,
			estatu_cod_est,
			act_inv)
			VALUES ('".$this->can_inv."',
			'".$this->nom_inv."',
			'".$this->des_inv."', 
			'".$this->pre_inv."', 
			'".$fecha."',
			'".$nom_img."',
			'".$_SESSION['cod_tie']."',
			'".$this->categoria."',
			'1',
			'".$fecha."'); ";

		return $this->ejecutar();	
	}
		}


		
		public function actualizar(){

			$ok=$this->que_dba="UPDATE inventario SET
			can_inv='".$this->can_inv."',
			nom_inv='".$this->nom_inv."',
			des_inv='".$this->des_inv."',
			pre_inv='".$this->pre_inv."',
			img_inv='".$this->img_inv."',
			categoria_producto_cod_cat_pro='".$this->cod_cat_pro."',
			tie_inv='".$this->tie_inv."'
			WHERE cod_inv='".$this->cod_inv."'; ";
		return $this->ejecutar();

		

	}

	public function agregar(){
		$fecha=date("Y-m-d H:m:s");
  

		$this->que_dba="INSERT INTO inventario 
			(can_inv,
			nom_inv,
			des_inv,
			pre_inv,
			fec_inv,
			img_inv,
			tienda_cod_tie,
			categoria_producto_cod_cat_pro,
			estatu_cod_est,
			act_inv,
			tie_inv)
			VALUES ('".$this->can_inv."',
			'".$this->nom_inv."',
			'".$this->des_inv."', 
			'".$this->pre_inv."', 
			'".$fecha."',
			'".$this->img_inv."',
			'".$_SESSION['cod_tie']."',
			'".$this->cod_cat_pro."',
			'1',
			'".$fecha."',
			'".$this->tie_inv."'); ";

			return $this->ejecutar();
	}




	public function listar(){

			$this->que_dba="SELECT * FROM inventario i, categoria_producto cp
				WHERE i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
				AND i.estatu_cod_est IN (1,2)
				AND i.tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function estatu_producto(){

			$this->que_dba="UPDATE inventario SET estatu_cod_est='".$this->estatu_cod_est."'
				WHERE cod_inv='".$this->cod_inv."' AND tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}


	public function eliminar_logico(){

			$this->que_dba="UPDATE inventario  SET estatu_cod_est='3'
				WHERE cod_inv='".$this->cod_inv."' AND tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function consultar_producto(){
		
			$this->que_dba="SELECT * FROM inventario i, categoria_producto cp
				WHERE i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
				AND i.cod_inv='".$this->cod_inv."'; ";

		return $this->ejecutar();

	}

	public function cantidad_articulo(){
		
			$this->que_dba="SELECT COUNT(*) AS arti FROM inventario WHERE tienda_cod_tie ='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function articulo_desactivado(){
					
			$this->que_dba="SELECT COUNT(*) AS desarti FROM inventario
						 WHERE estatu_cod_est = 2 
						 AND tienda_cod_tie ='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}





	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
} 
?>