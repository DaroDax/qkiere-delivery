<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class domicilio extends utilidad {

		
public $cod_dom;
public $ced_dom;
public $nom_dom;
public $ape_dom;
public $tel_dom;
public $ema_dom;
public $pas_dom;
public $img_dom;
public $dir_dom;
public $sector_cod_sec;
public $chat_id_dom;
public $dis_dom;
public $tienda_cod_tie;
public $estatu_cod_est;

	
		/*public function actualizar(){

			$ok=$this->que_dba="UPDATE inventario SET
			can_inv='".$this->can_inv."',
			nom_inv='".$this->nom_inv."',
			des_inv='".$this->des_inv."',
			pre_inv='".$this->pre_inv."',
			img_inv='".$this->img_inv."',
			categoria_producto_cod_cat_pro='".$this->cod_cat_pro."'
			WHERE cod_inv='".$this->cod_inv."'; ";
		return $this->ejecutar();

		

	}*/

	public function agregar(){
		
		$dir_dom = explode("-",$this->sec_dom);
		$opti = $dir_dom["1"];
		$sector =  $dir_dom["0"];

		$clave=MD5($this->pas_dom);

		$this->que_dba="INSERT INTO domiciliario 
			(nom_dom,
			ape_dom,
			ced_dom,
			tel_dom,
			ema_dom,
			pas_dom,
			sector_cod_sec,
			dis_dom,
			img_dom,
			dir_dom,
			tienda_cod_tie,
			chat_id_dom,
			estatu_cod_est

			)
			VALUES ('".$this->nom_dom."',
			'".$this->ape_dom."',
			'".$this->ced_dom."', 
			'".$this->tel_dom."', 
			'".$this->ema_dom."',
			'".$clave."',
			'".$sector."',
			'1',
			'".$this->img_dom."',
			'".$opti."',
			'".$_SESSION['cod_tie']."',
			'1234',
			'1'); ";

			return $this->ejecutar();
	}


public function consulta(){

			$this->que_dba="SELECT * FROM domiciliario;";

		return $this->ejecutar();

	}

public function listar(){

			$this->que_dba="SELECT * FROM domiciliario d
			WHERE d.estatu_cod_est IN (1,2)
			AND d.tienda_cod_tie ='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}
	

	public function ver_domici(){

			$this->que_dba="SELECT * FROM domiciliario d
			WHERE d.estatu_cod_est IN (1,2)
			AND d.tienda_cod_tie ='".$_SESSION['cod_tie']."'
			AND d.cod_dom = '".$this->cod_dom."'; ";

		return $this->ejecutar();

	}

	public function eliminar_logico(){

			$this->que_dba="UPDATE domiciliario SET estatu_cod_est='3'
				WHERE cod_dom='".$this->cod_dom."' AND tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function estatu_producto(){

			$this->que_dba="UPDATE domiciliario SET estatu_cod_est='".$this->estatu_cod_est."'
				WHERE cod_dom='".$this->cod_dom."' AND tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function dispone_delivery(){

			$this->que_dba="SELECT COUNT(*) AS domi FROM domiciliario d
			WHERE d.tienda_cod_tie ='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function actualizar_delivery(){

			$this->que_dba="UPDATE domiciliario SET
			nom_dom='".$this->nom_dom."',
			ape_dom='".$this->ape_dom."',
			ced_dom='".$this->ced_dom."',
			tel_dom='".$this->tel_dom."',
			ema_dom='".$this->ema_dom."',
			dir_dom='".$this->dir_dom."',
			img_dom='".$this->img_dom."'
			WHERE cod_dom='".$this->cod_dom."'; ";
		return $this->ejecutar();

		

	}

	

/*
	

	public function consultar_producto(){
		
			$this->que_dba="SELECT * FROM inventario i, categoria_producto cp
				WHERE i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
				AND i.cod_inv='".$this->cod_inv."'; ";

		return $this->ejecutar();

	}



	*/
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
} 
?>