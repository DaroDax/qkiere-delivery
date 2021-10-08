<?php
session_start();


require_once("utilidad.class.php");


	class horario extends utilidad {

	
	
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
		

	public function listar(){

			$this->que_dba="SELECT * FROM horario_tienda WHERE tienda_cod_tie='".$this->tienda_cod_tie."'; ";

			
	
		return $this->ejecutar();

	}

	public function misDirecciones(){


			$this->que_dba="SELECT *
FROM direccion_usuario d, sector s, municipio m
WHERE d.sector_cod_sec = s.cod_sec
AND m.cod_mun=s.municipio_cod_mun 
AND d.usuario_cod_usu = '".$_SESSION['cod_usu']."';";


	
		return $this->ejecutar();

	}





		



		
		

	
		
			} /// FIN DE CLASE
	


?>