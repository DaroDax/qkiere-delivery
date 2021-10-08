<?php

session_start();
if (isset($_SESSION["cod_usu"])) {

    require_once("../../clase/sitio_favorito.class.php");

    $obj_sitio_fav = new sitio_favorito;
    ?>

    <div class="p_card">
        <div class="row" id="columns">
            <?php
            $obj_sitio_fav->puntero = $obj_sitio_fav->listar();
            while (($arre_tienda= $obj_sitio_fav->extraer_dato()) > 0) {

                //echo ${"des" . $arre_tienda["cod_tie"]} = $arre_tienda["cod_tie"]; 
                //$checked_producto = ($arre_tienda["cod_tie"] != "") ? "checked" : "";


               
            ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <ul>

                        <li>

                                <div class="card">
                            <a href="tienda.php?id=<?php echo $arre_tienda["cod_tie"]; ?>">
                                    <div class="C_img"> <img src="../../../images/logo_tienda/<?php echo $arre_tienda["log_tie"]; ?>" class="absoImg" alt=""> </div> 
                             </a>
                                    <div class="C_desc">
                                        <div class="check">
                                            
                                            <?php
                                            
                                            if ($arre_tienda["cod_tie"]>0) {
                                                 $checked = "checked";
                                                  $color = '#F4D03F';
                                            } else {
                                                $color = '#000000';
                                            }

                                            ?>
                                 <i class="fa fa-bookmark" aria-hidden="true"  id="des_bot" style="color: <?php echo $color; ?>"></i>
                                            <input type="checkbox" id="cod_tie_fav" value="<?php echo $arre_tienda["cod_tie"]; ?>" <?php echo $checked; ?> title="Agregar A Favoritos" onclick="quitar_sitios_favoritos('<?php echo $arre_tienda["raz_tie"]?>','<?php echo $arre_tienda["cod_tie"]?>' );" />
                                            <h3 class="title" value="<?php echo $arre_tienda["raz_tie"]; ?>" id="nombre"><?php echo $arre_tienda["raz_tie"]; ?></h3>
                                        </div>
                                        <p class="desc"><?php echo $arre_tienda["nom_cat_tie"]; ?></p>
                                        <i class="fa fa-location-arrow" aria-hidden="true"> <?php echo $arre_tienda["nom_mun"]; ?> - <?php echo $arre_tienda["nom_sec"]; ?></i>
                                        <div class="price_block">
                                            <div class=""><i class=" fa fa-star"></i></div>
                                        </div>
                                    </div>
                                </div>
                          
                        </li>
                    </ul>

                </div>
            <?php } ?>


        </div>
    </div>

<?php

} else {
    header("location: ../index.php");
    exit();
}
?>