<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

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

		public function listar_barra_busqueda(){

			$this->que_dba="SELECT 
			m.nom_mun, m.cod_mun
			FROM 
			  municipio m, sector s, tienda t
			  WHERE t.sector_cod_sec=s.cod_sec
			  AND s.municipio_cod_mun=m.cod_mun
			  GROUP BY m.nom_mun; ";

		return $this->ejecutar();

	}




	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>