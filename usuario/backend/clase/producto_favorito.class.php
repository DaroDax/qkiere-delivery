<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class producto_favorito extends utilidad {
	
public $cod_pro_fav;
public $inventario_cod_inv;
public $usuario_cod_usu;

/* VARIABLES EXTERNAS */
public $cod_inv;
public $cod_inv2;
	
	public function insertar(){

			$this->que_dba="INSERT INTO producto_favorito 
			(inventario_cod_inv,
			usuario_cod_usu)
			VALUES (
			'".$this->cod_inv."',
			'".$_SESSION['cod_usu']."'); ";

		return $this->ejecutar();

	}



	public function listar(){
			
    $this->que_dba="SELECT * FROM tienda t, inventario i, producto_favorito pf
		WHERE t.cod_tie=i.tienda_cod_tie
		AND i.cod_inv=pf.inventario_cod_inv
		AND pf.usuario_cod_usu= '".$_SESSION['cod_usu']."' GROUP BY nom_inv ORDER BY cod_pro_fav "; 
		return $this->ejecutar();
	}

	public function listarXtienda(){
			
    $this->que_dba="SELECT * FROM tienda t, inventario i, producto_favorito pf
		WHERE t.cod_tie=i.tienda_cod_tie
		AND i.cod_inv=pf.inventario_cod_inv
		AND pf.usuario_cod_usu='".$_SESSION['cod_usu']."'
		AND t.cod_tie = '".$this->cod_tie."' GROUP BY nom_inv;";  
		return $this->ejecutar();
	}

	public function listarXbusqueda(){
			
    $this->que_dba="SELECT * FROM tienda t, inventario i, producto_favorito pf
		WHERE t.cod_tie=i.tienda_cod_tie
		AND i.cod_inv=pf.inventario_cod_inv
		AND pf.usuario_cod_usu='".$_SESSION['cod_usu']."' GROUP BY nom_inv;";  
		return $this->ejecutar();
	}



	public function consultar_fav(){
	/*		
    $this->que_dba="SELECT * FROM tienda t, inventario i, producto_favorito pf
		WHERE t.cod_tie=i.tienda_cod_tie
		AND i.cod_inv=pf.inventario_cod_inv
		AND pf.usuario_cod_usu='".$_SESSION['cod_usu']."'
		AND pf.inventario_cod_inv= '".$this->cod_inv."';"; */

		$this->que_dba="SELECT * FROM inventario i, producto_favorito pf
		WHERE i.cod_inv=pf.inventario_cod_inv
		AND pf.usuario_cod_usu='".$_SESSION['cod_usu']."'
		AND pf.inventario_cod_inv= '".$this->cod_inv."';"; 
		return $this->ejecutar();
	}

		public function eliminar(){
			
    $this->que_dba="DELETE FROM  producto_favorito
		WHERE inventario_cod_inv= '".$this->cod_inv."'
		AND usuario_cod_usu='".$_SESSION['cod_usu']."';"; 
		return $this->ejecutar();
	}


	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>