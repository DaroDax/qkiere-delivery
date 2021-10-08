<?php
 if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("utilidad.class.php");


	class funciones extends utilidad {

public $idcompany;

	public function forma_pago(){

			$this->que_dba="SELECT * FROM forma_pago; ";

		return $this->ejecutar();

	}

	public function fecha_corte(){

		$this->que_dba="SELECT * FROM fecha_corte; ";

		return $this->ejecutar();

	}

	public function fallas(){

		$this->que_dba="SELECT * FROM fallas; ";

		return $this->ejecutar();

	}

	public function tipo_instalacion(){

		$this->que_dba="SELECT * FROM tipo_instalacion; ";

		return $this->ejecutar();

	}

	public	function generarCodigo(){

		    $alpha = "1234567890-*.!$%&/()=qwertyuiopa456sdfghjklzxcvbnm789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$code = "";
		$longitud=10;
		for($i=0;$i<$longitud;$i++){
		    $code .= $alpha[rand(0, strlen($alpha)-1)];
		}
		echo "<input type='text'name='codigo' value='$code' readonly class='form-control'/>" ;
	}

	

	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>