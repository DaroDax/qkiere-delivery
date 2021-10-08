<?php
 require_once("../../backend/clase/usuario_pub.class.php");

    $obj_usuario_pub = new usuario_pub;
    $obj_usuario_pub->texto = $_POST["texto"];
  	$obj_usuario_pub->asignar_valor();
    $obj_usuario_pub->puntero = $obj_usuario_pub->consulta_email();
      $patron = stripslashes($_POST["texto"]);
        $si = strlen($patron);
if($si>4){ 
     while(($arre_usu = $obj_usuario_pub->extraer_dato()) > 0 ){

     echo $arre_usu["total"]; 
 }
}

	//Google email verify 

    $obj_usuario_pub->email = $_POST["email"];
  	$obj_usuario_pub->asignar_valor();
    $obj_usuario_pub->puntero = $obj_usuario_pub->consulta_gugul();
   		$gugul = stripslashes($_POST["email"]);
   			$sidos = $gugul;
   	
?>