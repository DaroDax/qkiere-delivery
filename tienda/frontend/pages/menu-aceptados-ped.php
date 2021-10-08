<?php session_start();

if (isset($_SESSION["cod_tie"])) {

    require_once("../../backend/clase/orden_compra.class.php");
    $obj_orden_compra = new orden_compra;

?>


    <?php
    $obj_orden_compra->puntero = $obj_orden_compra->consultar_orden_aceptada_domiciliario();
    while (($arreglo_ace = $obj_orden_compra->extraer_dato()) > 0) { ?>
        <div class="card">
            <div class="title-card-ace">
                <div class="head-info">
                    <h2 class="name-card">#<?php echo $arreglo_ace["cod_ord_com"]; ?> <?php echo $arreglo_ace["nom_usu"]; ?> - <?php echo $arreglo_ace["nom_sec"]; ?></h2>
                </div>
                <h3 class="date-card"><?php echo $arreglo["fec_ord_ped"]; ?></h3>
            </div>
            <div class="dom">
                <div class="dom_info">
                    <h4>Domiciliario A Entregar:</h4>

                    <h3> <?php echo $arreglo_ace["nom_dom"]; ?> <?php echo $arreglo_ace["ape_dom"]; ?></h3>

                </div>
                <div class="dir">
                    <h4>Direccion de entrega:</h4>
                    <h3><?php echo $arreglo_ace["dir_dir_usu"]; ?></h3>
                </div>
            </div>
            <div class="text-card">
                <h4>Total:</h4>
                <h3>$<?php echo $retotal = number_format($arreglo_ace["mon_ord_ped"], 0, ",", "."); ?></h3>
            </div>
            <div class="ord_but">
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_confirmar_orden.php');" class="blue-sent">Entregar <i class="fas fa-hand-holding"></i></a>-->

                <a href="#" class="blue-sent" onclick="ver_cod();">Entregar <i class="fas fa-hand-holding"></i></a>
                <script>function ver_cod(){
                    Swal.fire(
                    '<?php echo $arreglo_ace["cod_qr_ord_com"]; ?>',
                    'Codigo para entregar al domiciliario'
                    )
                }
                </script>


                <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo_ace['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_ver_orden_compra.php');" class="yello-view">Ver <i class="far fa-eye"></i></a>
                
            </div>
        </div>
    <?php }  ?>


<?php

} else {
   
}
?>