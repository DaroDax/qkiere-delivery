<?php
session_start();

if (isset($_SESSION["cod_tie"])) {

  require_once("../../backend/clase/delivery.class.php");
  $obj_domicilio = new domicilio;


?>
    <h1 style="font-family: 'Montserrat', sans-serif;">Tus Domiciliarios <a href="javascript:void(0);" data-toggle="modal" data-target="#ver_domi" onclick="carga_ajax('<?php echo $arre_deli['cod_dom']; ?>','ver_domi','./modals/modal_new_domiciliario.php');" ><i class="fas fa-plus-square" title="Añadir Domiciliario"></i></a></h1>
  <div class="domiciliarios">
    <?php
    $obj_domicilio->puntero = $obj_domicilio->listar();
    while (($arre_deli = $obj_domicilio->extraer_dato()) > 0) {
    ?>
      <div class="pedidos-card">
        <div class="info-pedido">
          <div class="img-pedido"> <img src="../../../img/dom_tie/<?php echo $arre_deli['img_dom']; ?>" alt="" class="logo-pedido"></div>
          <div class="datos-pedido">

            <h4 class="des-pedido">Nombre:</h4>
            <h3 class="nam-pedido"><?php echo $arre_deli["nom_dom"];
                                    echo " " . $arre_deli["ape_dom"]; ?></h3>

            <h4 class="des-pedido">Telefono:</h4>
            <h3 class="nam-pedido">+<?php echo $arre_deli["tel_dom"]; ?></h3>

            <h4 class="des-pedido">Cedula:</h4>
            <h3 class="nam-pedido"><?php echo $arre_deli["ced_dom"]; ?></h3>

            <h4 class="des-pedido">Dirección:</h4>
            <h3 class="nam-pedido"><?php echo $arre_deli["dir_dom"]; ?></h3>

          </div>
        </div>

        <div class="options-pedido">

          <div class="group-btn">
            <div class="yello-view">
  
             <a href="javascript:void(0);" data-toggle="modal" data-target="#ver_domi" onclick="carga_ajax('<?php echo $arre_deli["cod_dom"];?>','ver_domi','modals/modal_ver_domiciliario.php');" class="yello-view" >Editar <i class="fas fa-pen"></i></a>

            </div>
            <div class="delete_red">
              <a href="#" class="delete_red" title="Eliminar Pedido" onclick="eliminar_logico(<?php echo $arre_deli['cod_dom']; ?>);"> Eliminar <i class="fas fa-ban"></i></a>
            </div>

            <?php
            if ($arre_deli["estatu_cod_est"] == 1) {
              ${"estado" . $arre_deli["cod_dom"]} = "checked";
            }
            ?>

            <div class="switch-button">
              <!-- Checkbox -->
              <input type="checkbox" name="switch-button" id="switch-label<?php echo $arre_deli['cod_dom'] ?>" class="switch-button__checkbox" <?php echo ${"estado" . $arre_deli["cod_dom"]}; ?> onclick="estatu_producto('<?php echo $arre_deli["cod_dom"]; ?>','<?php echo $arre_deli["estatu_cod_est"]; ?>');">
              <!-- Botón -->
              <label for="switch-label<?php echo $arre_deli['cod_dom'] ?>" class="switch-button__label"></label>
               </div>
            </div>

          </div>
          </div>
        <?php }
        ?>
        
      </div>




      <?php
    } else {
    }
      ?>