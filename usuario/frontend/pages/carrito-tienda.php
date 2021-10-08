<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/cart.class.php");
  require_once("../../backend/clase/tienda.class.php");
  $obj_usuario = new usuario;
  $obj_cart = new cart;
  $obj_tienda = new tienda;

  $obj_tienda->puntero = $obj_tienda->consulta_pedidos_cont();
  $arre_can = $obj_tienda->extraer_dato();

  if($arre_can['pedidos'] == 0){
    echo "<h2 class='out'>No tienes nada en el carrito <br> ¡¡Agrega algo desde nuestra variedad de tiendas!!</h2>";
  }else{
  $obj_tienda->puntero = $obj_tienda->consulta_tienda();
  while (($arre_cart_tienda = $obj_tienda->extraer_dato()) > 0) {

    $obj_cart->cod_tie = $arre_cart_tienda["cod_tie"];
    $obj_cart->puntero = $obj_cart->sumatoria_tem_pedido();
    $arre_sumatoria = $obj_cart->extraer_dato();
?>

    <head>
      <link href="../css/tienda_producto.css" rel="stylesheet">
      <link href="../css/swal_edit.css" rel="stylesheet">
      <link href="../css/modals/add_cart.css" rel="stylesheet">

      
    </head>

    <div class="general-cart">
      <div class="card-cart">
        <div class="title-cart">
          <h3>
            <h1>Carrito | <?php echo $arre_cart_tienda["raz_tie"]; ?> | <i class="far fa-trash-alt" onclick="vaciar_carrito(<?php echo $arre_cart_tienda["cod_tie"]; ?>);"></i></h1>
          </h3>
        </div>
        <div class="item-cart">
          <div class="cart-table">
            <table class="table">
              <thead>
                <th>Opción</th>
                <th>Inventario</th>
                <th>Precio</th>
                <th>Total</th>
              </thead>
              <?php
              $obj_cart->cod_tie = $arre_cart_tienda["cod_tie"];
              $obj_cart->asignar_valor();
              $obj_cart->puntero = $obj_cart->listar_carrito();
              while (($arre_cart = $obj_cart->extraer_dato()) > 0) { ?>
                <tbody>
                  <td class="options">
                    <div class="options-div">

                      <i class="fas fa-times" onclick="eliminar_producto_carrito(<?php echo $arre_cart["cod_tem_ped"]; ?>,'<?php echo $arre_cart["nom_inv"]; ?>');"> </i>
                      <i class="far fa-edit" title="Edit" href="javascript:void(0);" data-toggle="modal" data-target="#edit_cart" onclick="carga_ajax(<?php echo $arre_cart['cod_tem_ped']; ?>,'edit_cart','modals/modal_edit_cart.php');">
                    </div></i>
          </div>
          </td>

          <td>
            <h4><?php echo $arre_cart["nom_inv"]; ?> - <?php echo $arre_cart["can_tem_ped"]; ?>
            </h4>
          </td>

          <td class="unit_price">
            <h4><?php echo $precio_unit = number_format($arre_cart["pre_tem_ped"], 0, ",", "."); ?></h4>
          </td>

          <td>
            <h4><?php echo $precio_unit = number_format($arre_cart["tot_tem_ped"], 0, ",", "."); ?></h4>
          </td>

        <?php } ?>
        </tbody>
        </table>
        </div>

      </div>

      <div class="price-cart">
        <p class="order_total"><strong>Total :</strong> $<?php echo $total = number_format($arre_sumatoria["total_pedido"], 0, ",", "."); ?>
        </p>

        <a href="#" class="buy-button" title="Ir a pagar" onclick="recibo(<?php echo $arre_cart_tienda['cod_tie']; ?>);">
          <div class="price-button">
            Comprar
          </div>
        </a>
      </div>
    </div>
  </div>
   <?php } ?>
  <?php } ?>

<?php } ?>