<?php

require_once("utilidad.class.php");


	class categoria_tienda extends utilidad {

		public $cod_cat_tie;
		public $nom_cat_tie;


	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  categoria_tienda; ";

		return $this->ejecutar();

	}






	
		
} /// FIN DE CLASE
	

?>