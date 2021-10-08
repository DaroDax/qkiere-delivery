<?php
session_start();

if (isset($_SESSION['idusuarios'],$_SESSION['idcompany'])){

	///include ("../../clase/caja/acceso.class.php");
	
$obj_acceso= new acceso;
$obj_acceso->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {
	case 'insertar':  $obj_acceso->resultado=$obj_acceso->insertar(); 
						$obj_acceso->mensaje();
						break;

	case 'modificar': $obj_mod->resultado=$obj_mod->modificar(); 
						$obj_mod->mensaje();
						break;

	case 'eliminar':  $obj_mod->resultado=$obj_mod->eliminar(); 
						$obj_mod->mensaje();
						break;
}

	
	/*
	$fecha=date("Y-m-d");
	$a=0;
	$id=$_POST["id"];
	
	// variables de dato del central
	$query = $conexion->ejecutar("SELECT * FROM  menu_link  ");
	$n_query=mysql_num_rows($query);

	// Crear objeto
//	$obj_accesos = new Accesos();	
	$delete = $conexion->ejecutar("DELETE FROM accesos WHERE usuarios_idusuarios='".$id."'  ");

	for($a;$a<=$n_query;$a++){
		if($_POST["opcion".$a]>0){
	// variables de dato del central
	
	$query_accesos= $conexion->ejecutar("SELECT * FROM  accesos WHERE menu_link_idmenu_link= '".$_POST["opcion".$a]."' AND usuarios_idusuarios='".$id."' ");
	$c_query=mysql_num_rows($query_accesos);
if($c_query>0){

	while($arre_accesos=mysql_fetch_array($query_accesos))
	{
		echo  $arre_accesos["menu_link_idmenu_link"];

	}
	

}else{
	$insert= $conexion->ejecutar("INSERT INTO accesos  
		(menu_link_idmenu_link, usuarios_idusuarios, ver, editar, eliminar,imprimir)
		VALUES('".$_POST["opcion".$a]."','".$id."','".$ver."','".$editar."','".$eliminar."','".$imprimir."' )");
}
}/// cierre if > 0
}/// cierre for
	
	if($insert==true)	
	
		{
		header ("location: ../../pages/usuarios.php?val=1");
		}
		else 
		{
		header ("location: ../../pages/usuarios.php?val=2");

		}
		

}	
else 
{
	header("location: ../../index.php");
	exit();
}
*/
?>