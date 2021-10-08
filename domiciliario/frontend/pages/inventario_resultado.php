<?php
session_start();

if (isset($_SESSION["cod_tie"])) {

  require_once("../../backend/clase/inventario.class.php");
  $obj_inv = new inventario;

  $obj_inv->puntero = $obj_inv->cantidad_articulo();
  $arre_can = $obj_inv->extraer_dato();



?>
  <div class="inventario_resultado">
    <?php 

    if ($arre_can['arti'] == 0) {
        echo "<h2 class='out'>No tienes inventario <br> ¡¡Agregalo todo desde el <i class='fas fa-plus-square'></i> que hay abajo!!</h2>";
      }else{
      ?>
    <?php
    $obj_inv->puntero = $obj_inv->listar();
    while (($arre_inv = $obj_inv->extraer_dato()) > 0) {

      

    ?>
      <div class="pedidos-card">
        <div class="info-pedido">
          <div class="img-pedido"> <img src="../../../img/inv_tie/<?php echo $arre_inv['img_inv']; ?>" alt="" class="logo-pedido"></div>
          <div class="datos-pedido">



            <h4 class="des-pedido">Nombre:</h4>
            <h3 class="nam-pedido"><?php echo $arre_inv["nom_inv"]; ?></h3>

            <h4 class="des-pedido">Cantidad:</h4>
            <h3 class="nam-pedido"><?php echo $arre_inv["can_inv"]; ?></h3>

            <h4 class="des-pedido">Precio:</h4>
            <h3 class="nam-pedido">$<?php echo $tot = number_format($arre_inv["pre_inv"], 0, ",", "."); ?></h3>

          </div>
        </div>

        <div class="line-time">

          <h3 class="des_pro">Descripción:
            <?php echo $arre_inv["des_inv"]; ?></h3>

        </div>

        <div class="options-pedido">

          <div class="group-btn">
            <div class="yello-view">
              <a href="javascript:void(0);" class="yello-view"  title="Editar Elemento" data-toggle="modal" data-target="#edit_producto" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','edit_producto','modals/modal_edit_producto.php');">Editar <i class="fas fa-pen"></i></a>
            </div>
            <div class="delete_red">
              <a href="#" class="delete_red" title="Eliminar Pedido" onclick="eliminar_logico(<?php echo $arre_inv['cod_inv']; ?>);"> Eliminar <i class="fas fa-ban"></i></a>
            </div>
            <?php



            if ($arre_inv["estatu_cod_est"] == 1) {
              ${"estado" . $arre_inv["cod_inv"]} = "checked";
            } else {
            }

            ?>

            <div class="switch-button">
              <!-- Checkbox -->
              <input type="checkbox" name="switch-button" id="switch-label<?php echo $arre_inv['cod_inv'] ?>" class="switch-button__checkbox" <?php echo ${"estado" . $arre_inv["cod_inv"]}; ?> onclick="estatu_producto('<?php echo $arre_inv["cod_inv"]; ?>','<?php echo $arre_inv["estatu_cod_est"]; ?>');">
              <!-- Botón -->
              <label for="switch-label<?php echo $arre_inv['cod_inv'] ?>" class="switch-button__label"></label>
            </div>

          </div>
        </div>

      </div>
    <?php } ?>
  <?php } ?>
  </div>




<?php
} else {
}
?>