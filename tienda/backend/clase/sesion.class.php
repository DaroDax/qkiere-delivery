<?php

require_once("utilidad.class.php");


class sesion extends utilidad {

public $ema_tie; 
public $pas_tie;
public $cod_tie;



		public function validar_sesion()
		{ 
			$clave=MD5($this->pas_tie);

			$this->que_dba="SELECT * FROM tienda 
			WHERE ema_tie='".$this->ema_tie."' AND pas_tie='".$clave."' AND estatu_cod_est='1'; ";
			

			return $this->ejecutar();
		}

		public function contador()
		{ 
			

			$this->que_dba="SELECT COUNT(*) AS dire FROM horario_tienda
			WHERE tienda_cod_tie = '".$this->cod_tie."'; ";
			

			return $this->ejecutar();
		}

		public function validar_sesion2()
		{ 
			

			$this->que_dba="SELECT * FROM tienda
			WHERE ema_tie='".$this->ema_tie."' AND pas_tie='".$this->pas_tie."' AND estatu_cod_est='1'; ";
			

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