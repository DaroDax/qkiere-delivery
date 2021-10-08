<?php


require_once("utilidad.class.php");

	class registro_tienda extends utilidad {
		
 public $cod_tie;
 public $tip_doc_tie;
 public $rif_tie;
 public $raz_tie;
 public $dir_tie;
 public $tel_tie;
 public $tel2_tie;
 public $ema_tie;
 public $pas_tie;
 public $log_tie;
 public $fec_tie;
 public $cha_id_tie;
 public $dom_tie;
 public $categoria_tienda_cod_cat_tie;
 public $sector_cod_sec;
 public $estatu_cod_est;
 public $company_cod_com;
 public $act_cli;

	public function insertar(){

		$pass=MD5($this->pas_tie);
	
	
			$this->que_dba="INSERT INTO tienda
			 (tip_doc_tie,
 			  rif_tie,
 			  raz_tie,
 			  dir_tie,
 			  tel_tie,
 			  tel2_tie,
 			  ema_tie,
 			  pas_tie,
 			  log_tie,
 			  fec_tie,
 			  cha_id_tie,
 			  dom_tie,
 			  categoria_tienda_cod_cat_tie,
 			  sector_cod_sec,
 			  estatu_cod_est,
 			  company_cod_com,
 			  act_cli)
			VALUES (
			'".$this->tip_doc_tie."',
			'".$this->rif_tie."',
			'".$this->raz_tie."',
			'".$this->dir_tie."',
			'".$this->tel_tie."',
			'".$this->tel2_tie."',
			'".$this->ema_tie."',
			'".$pass."',
			'".$this->log_tie."',
			Now(),
			'1',
			'0',
			'".$this->categoria_tienda_cod_cat_tie."',
			'".$this->sector_cod_sec."',
			'1',
			'1',
			Now()
			); ";

		return $this->ejecutar();

	}

	
		
} /// FIN DE CLASE
	

?>