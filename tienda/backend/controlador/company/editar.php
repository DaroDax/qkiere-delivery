<?php
session_start();

if (isset($_SESSION['idusuarios'])){

	include ('../../bd/classDB.php'); 
	include ('../../config/config.php');
	include ("../../modelos/company/editar.php");
	
	// Instanciar BD
	$conexion = Db::getInstance();
	
	// Crear objeto
	$obj_company = new Company();	
	// variables de dato del central
	
	$ra_so =$_POST["razon_social"];
	$tipo_doc =$_POST["tipo"];
	
	$rif = $_POST["rif"];
	$email = $_POST["email"];
	$web = $_POST["web"];
	$telf = $_POST["telefono"];
	$telf2 = $_POST["telefono2"];
	$direccion = $_POST["direccion"];
	$instagram = $_POST["instagram"];
	$fanspage = $_POST["fanspage"];
	$twitter = $_POST["twitter"];
	$logo2=$_POST["logo2"];

	    # definimos la carpeta destino
$carpetaDestino="../../img/company/";
 
    
$tamano = $_FILES["logo"]['size'];
$tipo = $_FILES["logo"]['type'];
$archivo =$_FILES["logo"]['name'];

if ($archivo != "") {
$destino = $carpetaDestino.$archivo;
copy($_FILES['logo']['tmp_name'],$destino);
$logo="../img/company/".$archivo;
}else {
	$logo=$_POST["logo2"];
}
	
	
	if($obj_company->registrar_ld($ra_so,$tipo_doc, $rif, $logo,$email, $web, $telf,$telf2,$direccion,$instagram,$fanspage,$twitter) == true)	
	
		{
		header ("location: ../../pages/company.php?val=1");
		}
		else 
		{
		header ("location: ../../pages/company.php?val=2");

		}
		

}	
else 
{
	header("location: ../../index.php");
	exit();
}

?>