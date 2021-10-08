<?php
// if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("utilidad.class.php");


	class inbox extends utilidad {
public $cod_inb;
public $asu_inb;
public $men_inb;
public $adj_inb;
public $des_inb;
public $fec_inb;
public $act_inb;
public $estatu_inbox_cod_est_in;
public $usuarios_idusuarios;



//////////////////// RECIBIR CAJA



	public function insertar(){

			$this->que_dba="INSERT INTO clientes 
			(asu_inb,
			men_inb,
			adj_inb,
			des_inb,
			fec_inb,
			estatu_inbox_cod_est_inb,
			usuarios_idusuarios)
			VALUES ('".$this->asu_inb."',
			'".$this->men_inb."',
			'".$this->adj_inb."', 
			'".$this->des_inb."',
			'now()',
			'1',
			'".$_SESSION['idusuarios']."'); ";

		return $this->ejecutar();

	}


	public function listar(){

			$this->que_dba="SELECT usuarios.*,inbox.* 
    FROM usuarios,inbox
    WHERE usuarios.idusuarios=inbox.usuarios_idusuarios
     AND usuarios.idusuarios='".$_SESSION['idusuarios']."'  ; ";

		return $this->ejecutar();

	}

	

		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>