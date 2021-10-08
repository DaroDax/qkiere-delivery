<?php

 if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("../../backend/clase/utilidad.class.php");

	class menu_link extends utilidad {

	public $idmenu_link;
	public $icono;
	public $nombre;
	public $grupo_menu_idgrupo_menu;
	public $menu_link_idmenu_link;
		
	public	function insertar (){

		$this->que_dba="INSERT INTO menu_link (icono,nombre) 
		VALUES ('".$icono."','".$nombre."') ";

		return $this->ejecutar();

	}

	public function editar(){

		$this->que_dba="UPDATE menu_link SET nombre='".$nombre."',
		icono='".$icono."'  WHERE idgrupo_menu='".$idgrupo_menu."'";

		return $this->ejecutar();
	}

	public function eliminar(){

		$this->que_dba="DELETE FROM menu_link 
		WHERE idgrupo_menu='".$idgrupo_menu."'";

		return $this->ejecutar();

	}
	
	public function sub_menu()
		{
			
			$filtro1=($_SESSION ["nivel_idnivel"]>"1")?" 
			menu_link.*, accesos.* 
			FROM menu_link, accesos 
			WHERE 
			 menu_link.idmenu_link = accesos.menu_link_idmenu_link 
			AND menu_link.grupo_menu_idgrupo_menu='".$this->grupo_menu_idgrupo_menu."'
			AND accesos.usuarios_idusuarios='".$_SESSION ["idusuarios"]."' ORDER BY nombre_link ASC "
			:"* FROM menu_link WHERE grupo_menu_idgrupo_menu='".$this->grupo_menu_idgrupo_menu."' ORDER BY nombre_link ASC ";
			$this->que_dba="SELECT $filtro1;";
		return $this->ejecutar();
		}/// FIN FILTRAR
			


								
							
	
	} // Fin de clase
	
}else {
	header("location: ../../index.php");
	exit();
}
?>