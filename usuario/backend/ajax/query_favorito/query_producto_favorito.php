<?php

session_start();
if (isset($_SESSION["cod_usu"])) {

    require_once("../../clase/producto_favorito.class.php");
  
     
    $obj_producto_fav = new producto_favorito;
    $obj_producto_fav->asignar_valor();
    $obj_producto_fav->puntero = $obj_producto_fav->listar();

?>


    <div class="table-responsive" id="respon">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="tab-content">
                <div class="contenedor">
                    <?php
                    while (($arre_inv = $obj_producto_fav->extraer_dato()) > 0) {
                        $cod_i = $arre_inv["cod_inv"];
                        $checked_producto = ($arre_inv["cod_inv"] != "") ? "checked" : "";


                    ?>
                        <div id="" class=" tab-pane active ">
                            <div class="item_list">
                                <div class="pizza_items fifth_items">
                                    <ul>

                                        <li>
                                            <div class="P_itmesbox">
                                                <div class="PT_image"><img src="../../../images/inv_tienda/<?php echo $arre_inv["img_inv"]; ?>" class="absoImg" alt=""></div>
                                                <div class="PT_dscr">
                                                    <h3 class="PT_title" value="<?php echo $arre_inv["nom_inv"]; ?>" id="item"><?php echo $arre_inv["nom_inv"]; ?> </h3>
                                                    <p class="PT_dtls"><?php echo $arre_inv["des_inv"]; ?></p>

                                                    <h4 class="" value="" id="item"> <?php echo $arre_inv["raz_cli"]; ?> </h4>
                                                    <div class="price_block">
                                                        <div class="price"> $<?php  echo $pesos = number_format($arre_inv["pre_inv"], 0, ",", "."); ?>

                                                            <div class="heart">
                                                                <input type="checkbox" id="cod_inv" name="cod_inv<?php echo $arre_inv["cod_inv"]; ?>" value="<?php echo $arre_inv["cod_inv"]; ?>" <?php echo $checked_producto; ?> onclick="add_producto_favorito('<?php echo $arre_inv['cod_inv']; ?>',this.checked);" />
                                                                <?php
                                                                if ($arre_inv["cod_inv"]>0) {
                                                                    $color = '#E74C3C';
                                                                } else {
                                                                    $color = '#000000';
                                                                }
                                                                ?>
                                                                <i class="fa fa-heart" id="fav_bot" aria-hidden="" style="color: <?php echo $color; ?>"></i>
                                                            </div>
                                                        </div>


                                                        <?php if ($arre_inv["can_inv"] > 0) { ?>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="card_btn">Agregar</a>
                                                        <?php } else {
                                                            echo "<div class='text-red'>Producto no Disponible.</div>";
                                                        } ?>



                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>



<?php

} else {
    header("location: ../index.php");
    exit();
}
?>