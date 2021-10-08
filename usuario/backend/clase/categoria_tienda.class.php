<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class categoria_tienda extends utilidad {

		public $cod_cat_tie;
		public $nom_cat_tie;

		/* VARIABLES EXTERNAS */
		public $cod_mun;
	
	public function insertar(){
			$this->que_dba="INSERT INTO categoria_tienda 
			(nom_cat_tie)
			VALUES ('".$this->nom_cat_tie."'); ";
		return $this->ejecutar();

	}



	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  categoria_tienda; ";

		return $this->ejecutar();

	}

		public function listar_select(){

			$this->que_dba="
			SELECT ct.nom_cat_tie AS nombre_cat, ct.cod_cat_tie AS cod_cat_tie
			FROM categoria_tienda ct, tienda t,sector s,municipio m 
			WHERE t.categoria_tienda_cod_cat_tie=ct.cod_cat_tie 
			AND t.sector_cod_sec=s.cod_sec 
			AND m.cod_mun=s.municipio_cod_mun
            AND m.cod_mun='".$this->cod_mun."'
            GROUP BY  nom_cat_tie; ";

		return $this->ejecutar();

	}







	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>