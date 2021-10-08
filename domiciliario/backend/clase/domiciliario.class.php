<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

require_once("utilidad.class.php");


	class domiciliario extends utilidad {
		
public $cod_dom;
public $ced_dom;
public $nom_dom;
public $ape_dom;
public $tel_dom;
public $ema_dom;
public $pas_dom;
public $img_dom;
public $chat_id_dom;
public $tienda_cod_tie;
public $estatu_cod_est;


/*VARIABLES EXTERNAS*/
public $cod_tie;
public $dis_dom;
	
	public function consultar(){
			$this->que_dba="SELECT * FROM domiciliario do, sector se, municipio mu
							WHERE mu.cod_mun=se.municipio_cod_mun
							AND do.sector_cod_sec=se.cod_sec
							AND do.cod_dom='".$_SESSION['cod_dom']."'; ";

		return $this->ejecutar();

	}
		public function actualizar(){

			$ok=$this->que_dba="UPDATE  tienda SET
			ced_dom='".$this->tip_doc_tie."',
			nom_dom='".$this->rif_tie."',
			ape_dom='".$this->raz_tie."',
			tel_dom='".$this->dir_tie."',
			ema_dom='".$this->tel_tie."',
			img_dom='".$this->cha_id_tie."',
			chat_id_dom='".$this->tel2_tie."',
			tienda_cod_tie='".$this->cod_tie."',
			sector_cod_sec='".$this->sector."'
			WHERE cod_dom='".$_SESSION['cod_dom']."'; ";
		return $this->ejecutar();
	
	}

public function cambio_clave(){
	
	$pass=MD5($this->Newpas_usu);
			
		$this->que_dba="UPDATE domiciliario SET pas_dom='".$pass."' WHERE cod_dom='".$_SESSION['cod_dom']."'; ";

		return $this->ejecutar();

}


public function disponibilidad(){
			
		$this->que_dba="UPDATE domiciliario SET dis_dom='".$this->dis_dom."' WHERE cod_dom='".$_SESSION['cod_dom']."'; ";

		return $this->ejecutar();

}

public function add_chat_id(){
			
		$this->que_dba="UPDATE domiciliario SET chat_id_dom='".$this->chat_id_dom."' WHERE cod_dom='".$_SESSION['cod_dom']."'; ";

		return $this->ejecutar();
}

		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>