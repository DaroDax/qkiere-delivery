<?php

require_once("utilidad.class.php");


	class usuario_pub extends utilidad {


	/*Variables externas*/
	public $texto;
	public $ip_log;
	public $ema_usu_log;
	public $cod_usu;


//Verificadores de consulta de email
public function consulta_email(){
	

			$this->que_dba="
			SELECT COUNT(*) AS total 
			FROM usuario
			WHERE ema_usu like '%".$this->texto."%'; ";

		return $a=$this->ejecutar();
		echo $a;

}

public function consulta_gugul(){
	

			$this->que_dba="
			SELECT COUNT(*) AS hayono
			FROM usuario
			WHERE ema_usu like '%".$this->email."%'; ";

			return $a=$this->ejecutar();
			echo $a;

			/*$this->que_dba="
			SELECT pas_usu AS password
			FROM usuario
			WHERE ema_usu like '%".$this->email."%'; ";

			return $c=$this->ejecutar();


		echo $c;*/

}



//Funciones IP

public function consulta(){
	

			$this->que_dba="
			SELECT * FROM usuario";



		return $a=$this->ejecutar();
		echo $a;

}
		public function add_ip(){
			$this->que_dba="INSERT INTO login(
			ip_log,
			fec_log,
			ema_usu_log,
			usuario_cod_usu)
			VALUES(
			'".$this->ip_log."',
			Now(),
			'".$this->ema_usu_log."',
			'1');";

			return $this->ejecutar();
		}

			public function upd_cod(){

				$this->que_dba="UPDATE login SET usuario_cod_usu = '".$this->cod_usu."' WHERE ema_usu_log = '".$this->ema_usu."';";

			return $this->ejecutar();
			}

			public function select_opcion(){
		$this->que_dba="SELECT * FROM miubicacion WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."' AND lat_miu>0 ORDER BY cod_miubi DESC";
		return $this->ejecutar();
	}
		

	
		
			} /// FIN DE CLASE
	

?>