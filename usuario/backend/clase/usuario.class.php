<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class usuario extends utilidad {

	public $cod_usu;
	public $Newpas_usu;
	public $texto;
	public $ema_usu;	


	/* DATOS DE DIRECCIONES */	
	public 	$cod_dir_usu;	
	public 	$nom_dir_usu;	
	public 	$dir_dir_usu;	
	public 	$usuario_cod_usu;
	public 	$sector;	
	public 	$estatu_cod_est;
	public $dire;
	public 	$chat_id_usu;

	/*Variables aparte*/
	public $lon_miu;
	public $lat_miu;


	public function listar(){

			$this->que_dba="SELECT * FROM usuario WHERE cod_usu= '".$_SESSION['cod_usu']."'; ";

		return $this->ejecutar();

	}



	public function misDirecciones(){


			$this->que_dba="SELECT *
			FROM direccion_usuario d, sector s, municipio m
			WHERE d.sector_cod_sec = s.cod_sec
			AND m.cod_mun=s.municipio_cod_mun 
			AND d.estatu_cod_est= '1'
			AND d.usuario_cod_usu = '".$_SESSION['cod_usu']."';";

		return $this->ejecutar();

	}



public function insertarDireccion(){

			$this->que_dba="INSERT INTO 
			direccion_usuario
			(nom_dir_usu,
			dir_dir_usu,
			sector_cod_sec,
			estatu_cod_est,
			usuario_cod_usu)
			VALUES
			('".$this->nom_dir_usu."',
			'".$this->dir_dir_usu."',
			'".$this->sector."',
			'1',
			'".$_SESSION['cod_usu']."'); ";

		return $this->ejecutar();
	}


public function editar_direccion(){

			$this->que_dba="UPDATE 
			direccion_usuario
			SET nom_dir_usu='".$this->nom_dir_usu."',
			dir_dir_usu='".$this->dir_dir_usu."',
			sector_cod_sec='".$this->sector."'
			WHERE 
			usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND cod_dir_usu='".$this->cod_dir_usu."'; ";

		return $this->ejecutar();
	}

public function eliminar_direccion(){

			$this->que_dba="UPDATE direccion_usuario  SET estatu_cod_est=3
			WHERE cod_dir_usu='".$this->cod_dir_usu."'
			AND usuario_cod_usu='".$_SESSION['cod_usu']."';";

		return $this->ejecutar();
}

		public function contador_direccion()
		{

			$this->que_dba = "SELECT COUNT(*) AS total_direccion FROM direccion_usuario 
			WHERE usuario_cod_usu='" . $_SESSION['cod_usu'] . "'
			AND estatu_cod_est = 1;";

			return $this->ejecutar();
		}

		public function hay_direccion()
		{

			$this->que_dba = "SELECT COUNT(*) AS cont_direccion FROM direccion_usuario 
			WHERE usuario_cod_usu='" . $_SESSION['cod_usu'] . "';";

			return $this->ejecutar();
		}

			public function consultar_direccion()
		{

			$this->que_dba = "SELECT * FROM direccion_usuario du, municipio mu, sector se
				WHERE du.sector_cod_sec=se.cod_sec
				AND se.municipio_cod_mun=mu.cod_mun
				AND du.usuario_cod_usu='" . $_SESSION['cod_usu'] . "'
				AND du.cod_dir_usu='".$this->cod_dir_usu."';";

			return $this->ejecutar();
		}




	public function cambio_clave(){
			
		 $clave=MD5($this->Newpas_usu);

			
    $this->que_dba="UPDATE usuario SET pas_usu='".$clave."' WHERE cod_usu='".$_SESSION['cod_usu']."';"; 
		return $this->ejecutar();
	}


	public function modificar_datos(){
			
    $this->que_dba="UPDATE usuario SET cod_area_usu='".$this->cod_area_usu."', tel_usu='".$this->tel_usu."' WHERE cod_usu='".$_SESSION['cod_usu']."';"; 
		return $this->ejecutar();
	}

public function consulta_email(){
		
			$this->que_dba="
			SELECT * 
			FROM usuario
			WHERE ema_usu like '%".$this->texto."%'; ";

		return $this->ejecutar();
}

public function add_chat_id(){
			
		$this->que_dba="UPDATE usuario SET chat_id_usu='".$this->chat_id_usu."' WHERE cod_usu='".$_SESSION['cod_usu']."'; ";

		return $this->ejecutar();
}

public function select_inicio(){

			$this->que_dba="INSERT INTO 
			miubicacion
			(usuario_cod_usu,
			estado_cod_est,
			lon_miu,
			lat_miu)
			VALUES
			('".$_SESSION['cod_usu']."',
			'1',
			'".$this->lon_miu."',
			'".$this->lat_miu."'
			); ";

		return $this->ejecutar();
	}

	public function select_opcion(){
		$this->que_dba="SELECT * FROM miubicacion WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."' AND lat_miu>0 ORDER BY cod_miubi DESC";
		return $this->ejecutar();
	}

	public function select_cat(){
		$this->que_dba="UPDATE miubicacion SET lon_miu ='".$this->lon_miu."' WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."';";
		return $this->ejecutar();
	}
				

	
		
			} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>