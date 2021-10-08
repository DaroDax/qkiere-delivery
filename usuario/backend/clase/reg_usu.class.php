<?php


require_once("utilidad.class.php");

	class registro_usuario extends utilidad {
		public $nom_usu;
		public $ema_usu;
		public $pas_usu;
		public $tel_usu;
		public $cod_area_usu;
		public $chat_id_usu;
		public $fec_usu;
		public $estatu_cod_est;
		public $cod_sug_usu;

	public function insertar(){

		$fecha=date("Y-m-d H:m:s");
		$pass=MD5($this->pas_usu);

		/* ID DE SUGERIDO */
		if ($this->cod_sug_usu>0) {
			$cod_sug_usu=$this->cod_sug_usu;
		}else{
			$cod_sug_usu="0";
		}
			$this->que_dba="INSERT INTO usuario
			 (nom_usu,
			 ema_usu, 
			 pas_usu,
			 cod_area_usu,
			 tel_usu,
			 chat_id_usu,
			 fec_usu,
			 cod_sug_usu,
			 estatu_cod_est)
			VALUES (
			'".$this->nom_usu."',
			'".$this->ema_usu."',
			'".$pass."',
			'".$this->cod_area_usu."',
			'".$this->tel_usu."',
			'1',
			'".$fecha."',
			'".$cod_sug_usu."',
			1); ";

		return $this->ejecutar();

	}

	public function insertar_email(){

		

		/*GENERADOR DE CODIGO*/
		$alpha = "1234567890";
		$code = "";
		$longitud=5;
		for($i=0;$i<$longitud;$i++){
		    $code .=$alpha[rand(1, strlen($alpha)-1)];
		}

		$pass=MD5($code);

			$this->que_dba="INSERT INTO usuario
			 (nom_usu,
			 ema_usu, 
			 pas_usu,
			 cod_area_usu,
			 tel_usu,
			 chat_id_usu,
			 fec_usu,
			 cod_sug_usu,
			 estatu_cod_est)
			VALUES (
			'".$this->nom_usu."',
			'".$this->ema_usu."',
			'".$pass."',
			'50',
			'000-0000',
			'1',
			Now(),
			'0',
			'1'); ";

		return $this->ejecutar();
	}

	
		
} /// FIN DE CLASE
	

?>