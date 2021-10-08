<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class categoria_producto extends utilidad {

		public $cod_cat_pro;
		public $nom_cat_pro;
		public $categoria_tienda_cod_cat_tie;


		/* VARIBALES EXTERNAS*/
		public $cod_tie;


	
	public function insertar(){
		$fecha=date("Y-m-d H:m:s");
			$this->que_dba="INSERT INTO tienda 
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

			$this->que_dba="SELECT nom_cat_pro, ico_cat_pro
				FROM categoria_producto cp, categoria_tienda ct, tienda t, inventario i
				WHERE cp.categoria_tienda_cod_cat_tie=ct.cod_cat_tie
				AND ct.cod_cat_tie=t.categoria_tienda_cod_cat_tie
				AND t.cod_tie=i.tienda_cod_tie
				AND i.categoria_producto_cod_cat_pro=cp.cod_cat_pro
				AND t.cod_tie='".$this->cod_tie."'
				GROUP BY nom_cat_pro; ";

		return $this->ejecutar();

	}






	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>