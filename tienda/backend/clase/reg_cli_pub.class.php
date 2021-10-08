<?php


require_once("utilidad.class.php");

	class registro_cli extends utilidad {
		
		public $cod_cli;
		public $tip_doc_cli;
		public $ced_cli;
		public $raz_cli;
		public $dir_cli;
		public $pun_ref_cli;
		public $tel_cli;
		public $tel2_cli;
		public $ema_cli;
		public $pas_cli;
		public $log_cli;
		public $fec_cli;
		public $categoria_cli_cod_cat_cli;
		public $estatu_cod_est;
		public $sector_cod_sec;
		public $company_cod_com;
		public $act_cli;

		public $sector;
		public $categoria;

	public function insertar(){

		$pass=MD5($this->pas_cli);
		$fecha=date("Y-m-d H:m:s");
		$ruta="../images/log_cli/".$this->log_cli;
		$pass=MD5($this->pas_usu);
			$this->que_dba="INSERT INTO cliente
			 (tip_doc_cli,
			 ced_cli,
			 raz_cli,
			 dir_cli,
			 tel_cli,
			 tel2_cli,
			 ema_cli,
			 pas_cli,
			 log_cli,
			 fec_cli,
			 categoria_cli_cod_cat_cli,
			 estatu_cod_est,
			 sector_cod_sec,
			 company_cod_com,
			 act_cli)
			VALUES (
			'".$this->tip_doc_cli."',
			'".$this->ced_cli."',
			'".$this->raz_cli."',
			'".$this->dir_cli."',
			'".$this->tel_cli."',
			'".$this->tel2_cli."',
			'".$this->ema_cli."',
			'".$pass."',
			'".$ruta."',
			'".$fecha."',
			'".$this->categoria."',
			'1',
			'".$this->sector."',
			'1',
			'".$fecha."'); ";

		return $this->ejecutar();

	}

	
		
} /// FIN DE CLASE
	

?>