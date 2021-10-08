<?php


require_once("utilidad.class.php");


class sesion extends utilidad {

public $ema_usu; 
public $pas_usu;
public $cod_usu;
public $dire;

public $ema_tie;
public $pas_tie;

public $cod_tie;

		public function validar_sesion()
		{ 
			$clave=MD5($this->pas_usu);

			$this->que_dba="SELECT * FROM usuario 
			WHERE ema_usu='".$this->ema_usu."' AND pas_usu='".$clave."' AND estatu_cod_est='1'; ";
			

			return $this->ejecutar();
		}

		


			public function validar_sesion2()
		{ 
			

			$this->que_dba="SELECT * FROM usuario 
			WHERE ema_usu='".$this->ema_usu."' AND pas_usu='".$this->pas_usu."' AND estatu_cod_est='1'; ";
			

			return $this->ejecutar();
		}

			public function validar_sesion_email()
		{ 
			$this->que_dba="SELECT * FROM usuario 
			WHERE ema_usu='".$this->ema_usu."' AND estatu_cod_est='1'; ";
			return $this->ejecutar();
		}

		public function validar_sesion_email2()
		{ 
			$this->que_dba="SELECT * FROM usuario 
			WHERE ema_usu='".$this->ema_usu."' AND estatu_cod_est='1'; ";
			return $this->ejecutar();
		}


		public function identificar_sesion()
		{ 
			$this->que_dba="SELECT * FROM usuario u, tienda t
			WHERE cod_usu='".$this->cod_usu."' 
			AND cod_tie='".$this->cod_tie."'; ";
			

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