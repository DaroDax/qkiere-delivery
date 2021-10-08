<?php
 if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("../../backend/clase/utilidad.class.php");

	class grupo_menu extends utilidad {

	public $idgrupo_menu;
	public $icono;
	public $nombre;

		
	public	function insertar (){

		$this->que_dba="INSERT INTO grupo_menu (icono,nombre) 
		VALUES ('".$icono."','".$nombre."') ";

		return $this->ejecutar();

	}

	public function editar(){

		$this->que_dba="UPDATE grupo_menu SET nombre='".$nombre."',
		icono='".$icono."'  WHERE idgrupo_menu='".$idgrupo_menu."'";

		return $this->ejecutar();
	}

	public function eliminar(){

		$this->que_dba="DELETE FROM grupo_menu 
		WHERE idgrupo_menu='".$idgrupo_menu."'";

		return $this->ejecutar();

	}





	public function menu(){

		$filtro1=($_SESSION ["nivel_idnivel"]>"1")?"grupo_menu.*, menu_link.*, accesos.*
      FROM  grupo_menu, menu_link, accesos
      WHERE grupo_menu.idgrupo_menu=menu_link.grupo_menu_idgrupo_menu
      AND menu_link.idmenu_link=accesos.menu_link_idmenu_link  
      AND accesos.usuarios_idusuarios ='".$_SESSION ['idusuarios']."' GROUP BY  grupo_menu.nombre ASC
			":" * FROM grupo_menu ORDER BY grupo_menu.nombre ASC;" ;
	$this->que_dba="SELECT $filtro1;";
	return $this->ejecutar();
	}
			

								
							
	
	} // Fin de clase
	
}else {
	header("location: ../../index.php");
	exit();
}
?>