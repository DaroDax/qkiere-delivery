<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class funciones extends utilidad {

public $idcompany;

	public function sector(){

			$this->que_dba="SELECT * FROM forma_pago; ";

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