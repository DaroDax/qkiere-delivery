<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


	class categoria_producto extends utilidad {

		public $cod_cat;
		public $nom_cat;

		/*VARIABLES EXTERNAS*/
		public $cod_cat_tie;


	
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

		$this->que_dba="SELECT * FROM categoria_producto cp, categoria_tienda ct
						WHERE ct.cod_cat_tie=cp.categoria_tienda_cod_cat_tie
						AND ct.cod_cat_tie='".$this->cod_cat_tie."'; ";

		return $this->ejecutar();

	}






	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>