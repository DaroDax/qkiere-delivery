<?php session_start();

if (isset($_SESSION["cod_tie"])) {

    require_once("../../backend/clase/orden_compra.class.php");
    require_once("../../backend/clase/detalle_orden_compra.class.php");
    $obj_orden_compra = new orden_compra;

    $obj_detalle_ord_com = new detalle_orden_compra;

?>

<!--Sweet-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

        <link href="../css/swal_edit.css" rel="stylesheet">
<!---------------->

    <?php
    $obj_orden_compra->puntero = $obj_orden_compra->consultar_orden_pendientes();
    while (($arreglo = $obj_orden_compra->extraer_dato()) > 0) { ?>

        <div class="card-nue">
            <div class="title-card-ace">
                <h2 class="name-card">#<?php echo $arreglo["cod_ord_com"]; ?> <?php echo $arreglo["nom_usu"]; ?> - <?php echo $arreglo["nom_sec"]; ?></h2>


            </div>
            <div class="date">
                <h3 class="date-card"><?php echo $arreglo["fec_ord_ped"]; ?></h3>
            </div>
            <div class="ped-inv">
                <ul>
                    <?php
                    $obj_detalle_ord_com->cod_ord_com = $arreglo["cod_ord_com"];
                    $obj_detalle_ord_com->asignar_valor();

                    $obj_detalle_ord_com->puntero = $obj_detalle_ord_com->consultar();
                    while (($arreglo_info = $obj_detalle_ord_com->extraer_dato()) > 0) { ?>

                        <li> • <?php echo $arreglo_info["can_det_ord_com"]; ?> x <?php echo $arreglo_info["nom_inv"]; ?> - "<?php echo $arreglo_info["obs_det_ord_com"]; ?>"</li>
                    <?php } ?>
                </ul>
            </div>

            <hr>
            <div class="text-card">
                <h4>Total:</h4>
                <h3>$<?php echo $retotal = number_format($arreglo["mon_ord_ped"], 0, ",", "."); ?></h3>
            </div>
            <div class="ord_but">
                <a class="ace_green" title="Aceptar Pedido" onclick="aceptar_orden('<?php echo $arreglo['cod_ord_com']; ?>','<?php echo $arreglo['usuario_cod_usu']; ?>','<?php echo $arreglo['raz_tie']; ?>','<?php echo $arreglo['chat_id_usu']; ?>');">Aceptar <i class="fas fa-check"></i></a>

                <a class="delete_red" onclick="rechazado_logico('<?php echo $arreglo['cod_ord_com']; ?>','<?php echo $arreglo['usuario_cod_usu']; ?>');" title="Eliminar Pedido">Eliminar <i class="fas fa-times"></i></a>
                </a>
            </div>
        </div>

    <?php } ?>


<?php

} else {
   
}
?>