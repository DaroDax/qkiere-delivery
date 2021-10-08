<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

require_once("utilidad.class.php");


	class sector extends utilidad {

	public $cod_sec;
    public $nom_sec;
    public $municipio_cod_mun;

    /*VARIABLES EXTERNAS*/
    public $cod_mun;

	public function listar(){

			$this->que_dba="SELECT * FROM sector WHERE municipio_cod_mun='".$this->cod_mun."';";

		return $this->ejecutar();

	}


	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>