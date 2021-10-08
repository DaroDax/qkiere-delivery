<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class horario_tienda extends utilidad {

			
public $cod_hor_tie;
public $lun_hor_tie;
public $mar_hor_tie;
public $mie_hor_tie;
public $jue_hor_tie;
public $vie_hor_tie;
public $sab_hor_tie;
public $dom_hor_tie;
public $hor_lun_vie_hor_tie;
public $hor_sab_hor_tie;
public $hor_dom_hor_tie;
public $tienda_cod_tie;

/* VARIABLES EXTERNAS*/
public $opcion;
public $estatu;


	
	

	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  horario_tienda WHERE tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}


	public function new_horario(){

		$this->que_dba="INSERT INTO horario_tienda
			(lun_hor_tie, 
			mar_hor_tie, 
			mie_hor_tie, 
			jue_hor_tie, 
			vie_hor_tie, 
			sab_hor_tie,
			dom_hor_tie, 
			hor_lun_vie_hor_tie, 
		    hor_sab_hor_tie, 
			hor_dom_hor_tie, 
			tienda_cod_tie)
			VALUES('1',
			'0',
			'0',
			'0',
			'0',
			'0',
			'0',
			'000000',
			'000000',
			'000000',
			'".$_SESSION['cod_tie']."');";

			return $this->ejecutar();

	}

	public function horario_semana(){


			$dias = $this->opcion;
			$cambio = $this->estatu;

			$this->que_dba="UPDATE horario_tienda SET 
				".$dias." = ".$cambio."
				WHERE tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

	public function horas(){


			$this->que_dba="UPDATE horario_tienda SET 
				hor_lun_vie_hor_tie = '".$this->hor_lun_vie_hor_tie."',
				hor_sab_hor_tie = '".$this->hor_sab_hor_tie."'
				WHERE tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>