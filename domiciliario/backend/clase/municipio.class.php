<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

require_once("utilidad.class.php");


	class municipio extends utilidad {

		public $cod_mun;
		public $nom_mun;
		public $estado_cod_est;

	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  municipio; ";

		return $this->ejecutar();

	}
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>