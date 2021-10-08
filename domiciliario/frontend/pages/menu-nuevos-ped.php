<?php session_start();

if (isset($_SESSION["cod_dom"])) {

    require_once("../../backend/clase/orden_compra.class.php");

    $obj_orden_compra = new orden_compra;
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
  $obj_orden_compra->puntero = $obj_orden_compra->consultar();
        while (($arreglo = $obj_orden_compra->extraer_dato()) > 0) { ?>

        <div class="card-nue">
            <div class="title-card-ace">
                <h2 class="name-card">#<?php echo $arreglo["cod_ord_com"]; ?> <?php echo $arreglo["raz_tie"]; ?> - <?php echo $arreglo["nom_sec"]; ?></h2>


            </div>
            <div class="date">
                <h3 class="date-card"><?php echo $arreglo["nom_usu"]; ?> <br> <?php echo $arreglo["fec_ord_ped"]; ?> </h3>
            </div>
            <div class="ped-inv">
                <ul>
                        <li> • <?php echo $arreglo["dir_dir_usu"]; ?>  </li>
                </ul>
            </div>

            <hr>
            <div class="text-card">
                <h4>Total:</h4>
                <h3>$<?php echo $retotal = number_format($arreglo["mon_ord_ped"], 0, ",", "."); ?></h3>
            </div>

            <div class="ord_but">
                <input type="hidden" name="raz_tie" id="raz_tie" value="<?php echo $arreglo["raz_tie"]; ?>">
                <a class="ace_green" title="Aceptar Pedido" onclick="aceptar_orden('<?php echo $arreglo["cod_ord_com"]; ?>','<?php echo $arreglo["cod_tie"]; ?>','<?php echo $arreglo["cod_usu"]; ?>','<?php echo $_SESSION["chat_id_dom"]; ?>','<?php echo $_SESSION["nom_dom"];?>','<?php echo $_SESSION["ape_dom"];?>','<?php echo $arreglo["chat_id_usu"];?>');" >Aceptar <i class="fas fa-check"></i></a>

            </div>
        </div>

    <?php } ?>


<?php

} else {
   
}
?>