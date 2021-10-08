<?php
session_start();

require_once("../../backend/clase/tienda.class.pub.php");
require_once("../../backend/clase/inventario.pub.class.php");

$obj_tienda_pub->puntero = $obj_tienda_pub->tienda();
$arre_tienda = $obj_tienda_pub->extraer_dato();

//$obj_inventario_pub = new inventario_pub;

if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;
}

 $obj_tienda_pub->puntero = $obj_tienda_pub->inventario_tienda();
          while (($arre_inv = $obj_tienda_pub->extraer_dato()) > 0) {
          ?>
            <div class="card" id="<?php echo $arre_inv["cod_inv"]; ?>">
              <div class="product-name">
                <img src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
                <a onclick="tienda(<?php echo $arre_inv['cod_tie']; ?>);">
                  <h2 class="pro_nom"><?php echo $arre_inv["raz_tie"]; ?></h2>
                </a>
              </div>

              <div class="img-card">
                <img src="../../../img/inv_tie/<?php echo $arre_inv["img_inv"]; ?>" alt="">
              </div>


              <div class="product-info">

                <div class="info-info">
                  <h2 class="pro_nom"><?php echo $arre_inv["nom_inv"]; ?></h2>
                  <h4 class="des_pro"><?php echo $arre_inv["des_inv"]; ?></h4>
                  <h5 class="pre_pro">$<?php echo $precio = number_format($arre_inv["pre_inv"], 0, ",", ".");  ?></h5>

                </div>
                <div class="info-pre">
                 <?php  if(isset($_SESSION["cod_usu"])){ ?>
                     <i class="fas fa-heart" style="color:#E74C3C;"><input type="checkbox" id="cod_inv" name="cod_inv<?php echo $arre_inv["cod_inv"]; ?>" value="<?php echo $arre_inv["cod_inv"]; ?>" <?php echo $checked_producto; ?> onclick="add_producto_favorito('<?php echo $arre_inv['cod_inv']; ?>',this.checked);" /></i>
                  <?php } ?>
                </div>
              </div>
              <div class="add-button">
                <?php  if($arre_inv["can_inv"]>0){ ?>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="button-a">Agregar</a>
              <?php }else{ echo "Producto no Disponible."; }?>
              </div>
            </div>
          <?php } ?>