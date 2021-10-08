<?php session_start();

if (isset($_SESSION["cod_dom"])) {

    require_once("../../backend/clase/orden_compra.class.php");
    $obj_orden_compra = new orden_compra;

    $obj_orden_compra2 = new orden_compra;

?>


     <?php
  $obj_orden_compra->puntero = $obj_orden_compra->orden_compra_aceptada();
        while (($arreglo_ace = $obj_orden_compra->extraer_dato()) > 0) { ?>
        <div class="card">
            <div class="title-card-ace">
                <div class="head-info">
                    <h2 class="name-card">#<?php echo $arreglo_ace["cod_ord_com"]; ?> <?php echo $arreglo_ace["raz_tie"]; ?> - <?php echo $arreglo_ace["nom_usu"]; ?></h2>
                </div>
        
            </div>
            <div class="dom">
                <div class="dom_info">
                    <h4>Direccion de la tienda:</h4>

                    <h3><?php echo $arreglo_ace["dir_tie"]; ?></h3>

                </div>
                <div class="dir">
                    <h4>Direccion del cliente:</h4>
                    <h3><?php echo $arreglo_ace["dir_dir_usu"]; ?></h3>
                </div>
            </div>
            <div class="text-card">
                <h4>Total:</h4>
                <h3>$<?php echo $retotal = number_format($arreglo_ace["mon_ord_ped"], 0, ",", "."); ?></h3>
            </div>
            <div class="ord_but">
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_confirmar_orden.php');" class="blue-sent">Entregar <i class="fas fa-hand-holding"></i></a>-->

                 <a href="javascript:void(0);" data-toggle="modal" data-target="#recibir_orden_compra"  class="blue-sent" onclick="carga_ajax('<?php echo $arreglo_ace['cod_ord_com']; ?>','recibir_orden_compra','modals/modal_rec_orden_compra.php');" >Recibir <i class="fas fa-hand-holding"></i></a>
                
            </div>
        </div>
    <?php }  ?>


    <!------------------------------------Por entregar------------------------------------------->
<div class="separator" style="background-color:#8c8c8c; color:#fff; padding:10px 0px; text-align:center; border-radius:10px;">¡Ve a entregar estos pedidos!</div>

     <?php
  $obj_orden_compra2->puntero = $obj_orden_compra2->orden_compra_recibida();
        while (($arreglo_ent = $obj_orden_compra2->extraer_dato()) > 0) { ?>
        <div class="card">
            <div class="title-card-ace">
                <div class="head-info">
                    <h2 class="name-card">#<?php echo $arreglo_ent["cod_ord_com"]; ?> <?php echo $arreglo_ent["raz_tie"]; ?> - <?php echo $arreglo_ent["nom_usu"]; ?></h2>
                </div>
        
            </div>
            <div class="dom">
                <div class="dom_info">
                    <h4>Telefono del cliente:</h4>

                    <h3><a href="https://wa.me/<?php echo $arreglo_ent["cod_area_usu"];?><?php echo $arreglo_ent["tel_usu"];?>" target="_blank">+<?php echo $arreglo_ent["cod_area_usu"];?><?php echo $arreglo_ent["tel_usu"]; ?></a></h3>

                </div>
                <div class="dir">
                    <h4>Direccion del cliente:</h4>
                    <h3><?php echo $arreglo_ent["dir_dir_usu"]; ?></h3>
                </div>
            </div>
            <div class="text-card">
                <h4>Total:</h4>
                <h3>$<?php echo $retotal = number_format($arreglo_ent["mon_ord_ped"], 0, ",", "."); ?></h3>
            </div>
            <div class="ord_but">
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_confirmar_orden.php');" class="blue-sent">Entregar <i class="fas fa-hand-holding"></i></a>-->

                 <a class="yello-view" title="Entregar Pedido" onclick="entregar_orden_compra('<?php echo $arreglo_ent["cod_ord_com"]; ?>','<?php echo $arreglo_ent["cod_tie"]; ?>','<?php echo $arreglo_ent["raz_tie"]; ?>','<?php echo $arreglo_ent["usuario_cod_usu"]; ?>','<?php echo $arreglo_ent["chat_id_dom"]; ?>','<?php echo $arreglo_ent["nom_dom"]; ?>','<?php echo $arreglo_ent["ape_dom"]; ?>','<?php echo $arreglo_ent["cha_id_tie"]; ?>');">Entregar <i class="fas fa-hand-holding" title="Entregar Orden"></i></a>
                
            </div>
        </div>
    <?php }  ?>


<?php

} else {
   
}
?>