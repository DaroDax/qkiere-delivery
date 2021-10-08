<?php
 require_once("backend/clase/tienda_pub.class.php");

    $obj_tienda_pub = new tienda_pub;
    $obj_tienda_pub->texto = $_POST["texto"];
  	$obj_tienda_pub->asignar_valor();
    $obj_tienda_pub->puntero = $obj_tienda_pub->consulta_email();
      $patron = stripslashes($_POST["texto"]);
        $si = strlen($patron);
if($si>4){ 
     while(($arre_tie = $obj_tienda_pub->extraer_dato()) > 0 ){

     echo $arre_tie["total"]; 
 }
}

/*

$obj_tienda_pub->rif = $_POST["rif"];
$obj_tienda_pub->tip_doc_tie=$_POST["tip_doc_tie"];
  	$obj_tienda_pub->asignar_valor();
    $obj_tienda_pub->puntero = $obj_tienda_pub->consulta_rif();
      $patron2 = stripslashes($_POST["rif"]);
        $sidos = strlen($patron2);
if($sidos>4){ 
     while(($arre_tie2 = $obj_tienda_pub->extraer_dato()) > 0 ){

     echo $arre_tie2["total_rif"]; 
 }
}

$obj_tienda_pub->razon = $_POST["razon"];
$obj_tienda_pub->raz_tie=$_POST["raz_tie"];
    $obj_tienda_pub->asignar_valor();
    $obj_tienda_pub->puntero = $obj_tienda_pub->consulta_nombre();
      $patron3 = stripslashes($_POST["razon"]);
        $sitres = strlen($patron3);
if($sitres>4){ 
     while(($arre_tie3 = $obj_tienda_pub->extraer_dato()) > 0 ){

     echo $arre_tie3["nombres"]; 
 }
}
*/

     ?>