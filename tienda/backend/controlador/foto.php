<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_tie'])){

require_once("utilidad.class.php");


$imagen = $_FILES["imagen"];

if ($imagen["type"] == "image/jpg" OR $image["type"] == "image/jpeg") {
	$ruta = "../../../images/".md5($imagen["tmp_name"]).".jpg";
	echo "subida correcta"
}else{
	echo "Ocurrio un error al guardar"
}


}else{header("location: ../../../index.php");}
?>