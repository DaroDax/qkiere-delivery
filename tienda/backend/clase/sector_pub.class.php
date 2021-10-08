<?php

require_once("utilidad.class.php");


	class sector_pub extends utilidad {

	public $cod_sec;
    public $nom_sec;
    public $municipio_cod_mun;



	public function listar(){

			$this->que_dba="SELECT * FROM sector WHERE municipio_cod_mun='".$this->cod_mun."';";

		return $this->ejecutar();

	}


		
} /// FIN DE CLASE

?>