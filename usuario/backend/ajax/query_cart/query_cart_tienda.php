<?php

session_start();
if (isset($_SESSION["cod_usu"])) {
require_once("../../clase/tienda.class.php");

    require_once("../../clase/cart.class.php");
    $obj_tienda = new tienda;
    
    $obj_cart = new cart;

    $obj_tienda->puntero = $obj_tienda->consulta_tienda_cart();

    while(($arre_tienda_cart= $obj_tienda->extraer_dato())>0){
/*   
    /* OBTENER LA SUMATORIA DEL CARRITO */

     $obj_cart->cod_tie=$arre_tienda_cart["cod_tie"];
     $obj_cart->puntero = $obj_cart->sumatoria_tem_pedido(); 
    $arre_sumatoria=$obj_cart->extraer_dato();

    ?>
    <div id="cart_tienda">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="cart_tam">
        <div class="right_cntbar">
            <div class="your_order">
                <div class="Order_title">
                    <span class="O_lefttitle">Tu Orden - <?php echo $arre_tienda_cart["raz_tie"]; ?></span>

                    
                    <i class="far fa-trash-alt" title="Borrar Todo" onclick="vaciar_carrito('<?php echo $arre_tienda_cart["cod_tie"]; ; ?>');"></i>
                </div>
                <div class="Order_number">
                    <ul>
    

                            
                                 <?php $obj_cart->cod_tie=$arre_tienda_cart["cod_tie"];
                                  $obj_cart->asignar_valor();
                                   $obj_cart->puntero = $obj_cart->listar_carrito();
                                    while(($arre_cart = $obj_cart->extraer_dato()) > 0) {

                                 ?> 
                                 <li><a href="#" onclick="eliminar_producto_carrito('<?php echo $arre_cart["cod_tem_ped"]; ?>','<?php echo $arre_cart["nom_inv"]; ?>');">
                                    <div class="Order_number">
                                        <div class="Order_names">
                                            <span class="O_name"><?php echo $arre_cart["can_tem_ped"]; ?> x <?php echo $arre_cart["nom_inv"]; ?></span>
                                            <span class="O_type"><?php echo $arre_cart["obs_tem_ped"]; ?></span>
                                        </div>
                                        <div class="Order_price">
                                            <span class="O_price">$<?php echo $to = number_format($arre_cart["tot_tem_ped"], 0, ",", "."); ?></span>
                                        </div>
                                        <hr>
                                    </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="totle_Oamount">
                    <div class="O_totlecost">
                        <span class="O_title">Total</span>
                        <span class="O_price">$<?php echo $total = number_format($arre_sumatoria["total_pedido"], 0, ",", "."); ?></span>
                    </div>
                    <a href="cart.php" class="trans red_btn hvr-float-shadow" title="">¡¡Pedir!!</a>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php } ?>
<?php } else {
    header("location: ../index.php");
    exit();
}
?>