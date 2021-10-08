<?php


require_once("utilidad.class.php");

	class registro_tie extends utilidad {
		
		public $cod_tie;
		public $tip_doc_tie;
		public $ced_tie;
		public $raz_tie;
		public $dir_tie;
		public $pun_ref_tie;
		public $tel_tie;
		public $tel2_tie;
		public $ema_tie;
		public $pas_tie;
		public $log_tie;
		public $fec_tie;
		public $categoria_tienda_cod_cat_tie;
		public $estatu_cod_est;
		public $sector_cod_sec;
		public $company_cod_com;
		public $act_cli;

		public $sector;
		public $categoria;

	public function insertar(){

		$pass=MD5($this->pas_tie);
		$fecha=date("Y-m-d H:m:s");
		$ruta="../images/log_cli/".$this->log_cli;
			$this->que_dba="INSERT INTO tienda
			 (tip_doc_tie,
			 ced_tie,
			 raz_tie,
			 dir_tie,
			 tel_tie,
			 tel2_tie,
			 ema_tie,
			 pas_tie,
			 log_tie,
			 fec_tie,
			 categoria_tienda_cod_cat_tie,
			 estatu_cod_est,
			 sector_cod_sec,
			 company_cod_com,
			 act_cli)
			VALUES (
			'".$this->tip_doc_tie."',
			'".$this->ced_tie."',
			'".$this->raz_tie."',
			'".$this->dir_tie."',
			'".$this->tel_tie."',
			'".$this->tel2_tie."',
			'".$this->ema_tie."',
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