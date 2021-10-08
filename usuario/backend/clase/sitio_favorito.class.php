<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){
require_once("utilidad.class.php");


	class sitio_favorito extends utilidad {
	
	public $cod_sit_fav;
	public $tienda_cod_tie;
	public $usuario_cod_usu;


	/* VARIABLES EXTERNAS */
	public $cod_tie;
	public $cod_usu;


	public function insertar(){
	

			$this->que_dba="INSERT INTO sitio_favorito 
			(tienda_cod_tie,
			usuario_cod_usu)
			VALUES ('".$this->cod_tie."',
			'".$_SESSION['cod_usu']."'); ";

		return $this->ejecutar();
		
	}



	public function listar(){
			
    $this->que_dba= "SELECT * FROM 
			tienda t, sitio_favorito sf, sector s, municipio m, categoria_tienda ct, horario_tienda ht
			WHERE t.cod_tie=sf.tienda_cod_tie
           	AND s.cod_sec=t.sector_cod_sec
			AND m.cod_mun=s.municipio_cod_mun
			AND t.categoria_tienda_cod_cat_tie = ct.cod_cat_tie
			AND ht.tienda_cod_tie = t.cod_tie
            AND sf.usuario_cod_usu='".$_SESSION['cod_usu']."'  GROUP BY  raz_tie; "; 
		return $this->ejecutar();
	}

	public function consultar(){
			
    $this->que_dba="SELECT * FROM 
			tienda t, sitio_favorito sf
			WHERE t.cod_tie=sf.tienda_cod_tie
			AND sf.usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND t.cod_tie='".$this->cod_tie."'; "; 
		return $this->ejecutar();
	}
	
	public function eliminar(){
			
    $this->que_dba="DELETE FROM sitio_favorito 
    WHERE tienda_cod_tie='".$this->cod_tie."'
    AND usuario_cod_usu='".$_SESSION['cod_usu']."'; "; 
		return $this->ejecutar();
	}


	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>