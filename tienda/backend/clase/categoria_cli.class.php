<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_cli'])){

require_once("utilidad.class.php");


	class categoria_cli extends utilidad {

		public $cod_cat_cli;
		public $nom_cat_cli;


	
	public function insertar(){
		$fecha=date("Y-m-d H:m:s");
			$this->que_dba="INSERT INTO clientes 
			(tipo,
			cedula,
			nombres,
			telef,
			telef2,
			email,
			fecha_creacion,
			estatus_idestatus,
			usuarios_idusuarios)
			VALUES ('".$this->tipo."',
			'".$this->cedula."',
			'".$this->nombres."', 
			'".$this->telef."',
			'".$this->telef2."',
			'".$this->email."',
			'".$fecha."',
			'7',
			'".$_SESSION['idusuarios']."'); ";

		return $this->ejecutar();

	}



	public function listar(){

			$this->que_dba="SELECT 
			*
			FROM 
			  categoria_cli; ";

		return $this->ejecutar();

	}






	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>