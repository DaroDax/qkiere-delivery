<?php
 if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("utilidad.class.php");

	class acceso extends utilidad {

	public $idgrupo_menu;
	public $idmenu_link;
	public $idusuarios;
	public $ver_acc;
	public $edi_acc;
	public $eli_acc;
	public $imp_acc;
		
	public	function insertar (){

		$this->que_dba="INSERT  INTO  accesos (menu_link_idmenu_link,usuarios_idusuarios,ver,editar,eliminar,imprimir) 
		VALUES ('".$idmenu_link."','".$cod_usu."','".$ver_acc."','".$edi_acc."','".$eli_acc."','".$imp_acc."'); ";

		return $this->ejecutar();

	}

	public function editar(){

		$this->que_dba="UPDATE  accesos SET menu_link_idmenu_link='".$idmenu_link."', 
		usuarios_idusuarios='".$cod_usu."', ver='".$ver_acc."', editar='".$edi_acc."',
		eliminar='".$eli_acc."',imprimir='".$imp_acc."' WHERE idaccesos='".$cod_acc."'; ";

		return $this->ejecutar();
	}

	public function eliminar(){

		$this->que_dba="DELETE FROM accesos 
		WHERE idaccesos='".$cod_acc."'";

		return $this->ejecutar();

	}
		



								
							
	
	} // Fin de clase
	
}else {
	header("location: ../../index.php");
	exit();
}
?>