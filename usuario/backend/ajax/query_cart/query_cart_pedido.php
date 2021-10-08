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

    ?><hr>
    <section>

        <div class="row">
            <div class="col-md-12">
                <div class="main_Ourmenu">
                    <h2 class="title">Carrito | <?php echo $arre_tienda_cart["raz_tie"]; ; ?></h2>
                    <i class="far fa-trash-alt" title="Borrar Todo" onclick="vaciar_carrito('<?php echo $arre_tienda_cart["cod_tie"]; ; ?>');"></i>
                </div>
            </div>

            <div class="col-md-12">
                <div class="cart_list">
            <div class="table-responsive">
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Opción</th>
      <th scope="col">Producto</th>
      <th scope="col">Can</th>
      <th scope="col">Precio</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
                        <?php

            
                    $obj_cart->cod_tie=$arre_tienda_cart["cod_tie"]; 
                        $obj_cart->asignar_valor();
                        $obj_cart->puntero = $obj_cart->listar_carrito();
                         while(($arre_cart = $obj_cart->extraer_dato()) > 0) { ?>

                            <tbody>
    <tr>
      <th scope="row"><a href="#" class="trans del" title="Delete" onclick="eliminar_producto_carrito('<?php echo $arre_cart["cod_tem_ped"]; ?>','<?php echo $arre_cart["nom_inv"]; ?>');"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        <a class="trans edit_new" title="Edit" href="javascript:void(0);" data-toggle="modal" data-target="#edit_cart" onclick="carga_ajax('<?php echo $arre_cart['cod_tem_ped']; ?>','edit_cart','modals/modal_edit_cart.php');">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a></th>

      <td><p class="pro_title"><a href="#" title="<?php echo $arre_cart["nom_inv"]; ?>" class="trans"><?php echo $arre_cart["nom_inv"]; ?></a></p>
                                            <p class="pro_dtls"><?php echo $arre_cart["obs_tem_ped"]; ?></p></td>

      <td><h4><?php echo $arre_cart["can_tem_ped"]; ?></h4></td>

      <td>$<?php echo $price = number_format($arre_cart["pre_inv"], 0, ",", ".");  ?></td>

      <td><b>$<?php echo $to = number_format($arre_cart["tot_tem_ped"], 0, ",", "."); ?></b></td>
    </tr>
                        <?php 
                   
                    }
                     ?>
    
  </tbody>
</table>
</div>

                          


                    </ul>

                    <div class="checkout">
                        <p class="order_total"><span>Total :</span> $<?php echo $total = number_format($arre_sumatoria["total_pedido"], 0, ",", "."); ?>
                        </p>

                        <div class="btn_checkout">
                            <a href="checkout.php?cod_tie=<?php echo $arre_tienda_cart["cod_tie"]; ?>" class="trans red_btn squre-btn hvr-ripple-out" title="Proceed to Checkout">Confirmar Pedido</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
      

        </section>
        

            <?php 
            } ///CIERRE WHILE

          } else {
                header("location: ../index.php");
                exit();
            }
                ?>