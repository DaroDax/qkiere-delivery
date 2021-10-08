<?php
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("../../clase/cart.class.php");
	


$obj_cart =  new cart;
$obj_cart->asignar_valor();


/* ACCION ME DIRA QUE DEBO HACER*/
switch ($_REQUEST["accion"]) {


	case 'insertar':  $obj_cart->resultado=$obj_cart->insertar(); 
						$tienda_cod_tie=$obj_cart->tienda_cod_tie;
	header ("location: ../../../frontend/pages/tienda.php?id=".$tienda_cod_tie."&val=1");
					
						break;

	case 'eliminar_producto_carrito':  $obj_cart->resultado=$obj_cart->eliminar(); 
						break;
	
	case 'vaciar_carrito': $obj_cart->resultado=$obj_cart->vaciar_carrito(); 					
						break;

	case 'editar_carrito': $obj_cart->resultado=$obj_cart->editar_carrito(); 					
						break;
}
	


}	
else 
{
	header("location: ../../../index.php");
	exit();
}

?>