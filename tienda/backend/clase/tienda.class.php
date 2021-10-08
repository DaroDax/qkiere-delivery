<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class tienda extends utilidad {
	
	public $cod_tie;
	public $tip_doc_tie;
	public $rif_tie;
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
	public $cha_id_tie;


	/*VARIABLES EXTERNAS */

	public $cod_mun;
	public $cod_cat_tie;
	public $Newpas_usu;
	public $sector;

	
	public function consultar(){
			$this->que_dba="SELECT * FROM tienda t, sector s, municipio m
							WHERE t.sector_cod_sec=s.cod_sec
							AND s.municipio_cod_mun=m.cod_mun
							AND t.cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

		public function name()
		{
			$this->que_dba = "SELECT * FROM tienda WHERE cod_tie='" . $_SESSION['cod_tie'] . "'; ";

			return $this->ejecutar();
		}
		public function actualizar(){

			$ok=$this->que_dba="UPDATE  tienda SET
			tip_doc_tie='".$this->tip_doc_tie."',
			rif_tie='".$this->rif_tie."',
			raz_tie='".$this->raz_tie."',
			dir_tie='".$this->dir_tie."',
			tel_tie='".$this->tel_tie."',
			tel2_tie='".$this->tel2_tie."'
			WHERE cod_tie='".$_SESSION['cod_tie']."'; ";
		return $this->ejecutar();
/*
			log_tie='".$this->log_tie."',
			categoria_tienda_cod_cat_tie='".$this->categoria_tienda_cod_cat_tie."',
		
*/
	}

public function cambiar_clave(){
	
	$pass=MD5($this->Newpas_usu);
			
		$this->que_dba="UPDATE tienda SET pas_tie='".$pass."' WHERE cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();
}

public function cambiar_foto(){
	
			
		$this->que_dba="UPDATE tienda SET log_tie= '".$this->log_tie."' WHERE cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();
}


	public function add_chat_id(){
			
		$this->que_dba="UPDATE tienda SET cha_id_tie='".$this->cha_id_tie."' WHERE cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();
}
	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>