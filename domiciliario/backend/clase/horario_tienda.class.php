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


	
	public function insertar(){
		$fecha=date("Y-m-d H:m:s");
			$this->que_dba="INSERT INTO tienda 
			(tipo,
			cedula,
			nombres,
			telef,
			telef2,
			email,
			fecha_creacion,
			estatus_idestatus,
			usuarios_idusuarios)
			VALUES ('".$this->tipo."',
			'".$this->cedula."',
			'".$this->nombres."', 
			'".$this->telef."',
			'".$this->telef2."',
			'".$this->email."',
			'".$fecha."',
			'7',
			'".$_SESSION['idusuarios']."'); ";

		return $this->ejecutar();

	}



	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  horario_tienda WHERE tienda_cod_tie='".$_SESSION['cod_tie']."'; ";

		return $this->ejecutar();

	}

		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>