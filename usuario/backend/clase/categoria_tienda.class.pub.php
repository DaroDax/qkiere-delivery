<?php
require_once("utilidad.class.php");


	class categoria_tienda_pub extends utilidad {

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

	public function busqueda_categoria()
	{
		$this->que_dba = "
		SELECT * 
			FROM categoria_tienda ct, tienda t, municipio m, sector s
			WHERE t.categoria_tienda_cod_cat_tie = ct.cod_cat_tie
			AND t.sector_cod_sec=s.cod_sec
			AND s.municipio_cod_mun = m.cod_mun
			AND m.cod_mun = '" . $this->municipio . "'
			AND ct.nom_cat_tie LIKE '%" . $this->texto . "%' GROUP BY nom_cat_tie;";

		return $this->ejecutar();
	}

	public function tiendaxcategoria()
	{
		$this->que_dba = "
		SELECT * 
			FROM tienda t, sector s, municipio m, categoria_tienda ct, horario_tienda ht
			WHERE t.sector_cod_sec=s.cod_sec
			AND m.cod_mun=s.municipio_cod_mun
			AND ct.cod_cat_tie = t.categoria_tienda_cod_cat_tie
			AND ht.tienda_cod_tie = t.cod_tie
			AND t.estatu_cod_est='1'
			AND t.categoria_tienda_cod_cat_tie ='" . $this->cod_cat_tie . "' ;";

		return $this->ejecutar();
	}





	
		
} /// FIN DE CLASE
	
?>