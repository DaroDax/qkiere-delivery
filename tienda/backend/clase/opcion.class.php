<?php
session_start();

if (isset($_SESSION['idusuarios'])){

	class Grupo_menu {
		
		public $conexion, $resultado;

		public function __construct(){
			$this->conexion = Db::getInstance();
		}
      
		// Registrar datos de ld
		function registrar_ld($nombre_grupo, $icono){
			$this->resultado = $this->conexion->ejecutar ("INSERT  INTO  grupo_menu (nombre,icono) VALUES ('".$nombre_grupo."','".$icono."') ");

								
								
		

		if (!$this->resultado) return false;
			else
			return true;
		}
	
	} // Fin de clase
	
}else {
	header("location: ../../index.php");
	exit();
}
?>