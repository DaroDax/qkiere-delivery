<?php

require_once("utilidad.class.php");


	class categoria_cli_pub extends utilidad {

		public $cod_cat_cli;
		public $nom_cat_cli;


	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  categoria_cli; ";

		return $this->ejecutar();

	}






	
		
} /// FIN DE CLASE
	

?>