<?php

session_start();
if (isset($_SESSION["cod_usu"])) {

    require_once("../../clase/inventario.class.php");

    $obj_inventario = new inventario;
    $obj_inventario->texto = $_POST["texto"];
    $obj_inventario->municipio = $_POST["municipio"];
    $obj_inventario->asignar_valor();
    $obj_inventario->puntero = $obj_inventario->Consulta_inicio();

    if ($obj_inventario->texto != '') {
        $patron = stripslashes($_POST["texto"]);
        $si = strlen($patron);
        if ($si > 3) {

            if ($obj_inventario > 0) {
?>
                <br />
                <br />
                <div class="table-responsive">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="tab-content">
                            <div class="contenedor">
                                <?php
                                while (($arre_inv = $obj_inventario->extraer_dato()) > 0) {
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

                <div class="price_block">
                    <div class="price"> $<?php
                                            echo $pesos = number_format($arre_inv["pre_inv"], 0, ",", ".");
                                            ?> </div>


                            <?php if ($arre_inv["can_inv"] > 0) { ?>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="card_btn">Agregar</a>
                                <?php } else {
                                    echo "<div class='text-red'>Producto no Disponible.</div>";
                                } ?>

                                <br>
                            </div><a href="tienda.php?id=<?php echo $arre_inv["cod_tie"]; ?>">
                            <i class="fa fa-map-marker" aria-hidden="true"> <?php echo $arre_inv["nom_sec"]; ?> - <?php echo $arre_inv["nom_mun"]; ?></i>
                            <h4 class="" value="" id="item"> - <?php echo $arre_inv["raz_tie"]; ?> </h4>
                        </a>


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


<?php  //F
            } else {
                echo "<br/><br/><br/><h2 aling='center'>No Existen Registros...!!!</h2>";
            }
        } else {
            echo "<br/><br/><br/><h2 aling='center'>Consulta muy corta minimo 4 Caracteres...!!!</h2>";
        }
    }
} else {
    header("location: ../index.php");
    exit();
}
?>