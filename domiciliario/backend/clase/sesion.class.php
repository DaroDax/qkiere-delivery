<?php

require_once("utilidad.class.php");


class sesion extends utilidad {

public $ema_dom; 
public $pas_dom;


		public function validar_sesion()
		{ 
			$clave=MD5($this->pas_dom);

			$this->que_dba="SELECT * FROM domiciliario dom, sector sec, municipio mun
			WHERE dom.sector_cod_sec=sec.cod_sec
			AND sec.municipio_cod_mun=mun.cod_mun
			AND dom.ema_dom='".$this->ema_dom."' 
			AND dom.pas_dom='".$clave."' 
			AND dom.estatu_cod_est='1'; ";
			

			return $this->ejecutar();
		}

		public function validar_sesion2()
		{ 

			$this->que_dba="SELECT * FROM domiciliario dom, sector sec, municipio mun
			WHERE dom.sector_cod_sec=sec.cod_sec
			AND sec.municipio_cod_mun=mun.cod_mun
			AND dom.ema_dom='".$this->ema_dom."' 
			AND dom.pas_dom='".$this->pas_dom."' 
			AND dom.estatu_cod_est='1'; ";
			

			return $this->ejecutar();
		}

		public function cerrar()
		{
				session_start();
				session_destroy();
			return;
		}
}
?>