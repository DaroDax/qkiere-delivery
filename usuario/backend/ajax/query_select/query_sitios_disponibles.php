<?php

session_start();
if (isset($_SESSION["cod_usu"])) {

    require_once("../../clase/tienda.class.php");
    require_once("../../clase/usuario.class.php");
    require_once("../../clase/sitio_favorito.class.php");
  

    $obj_tienda = new tienda;

    $obj_sitio_fav = new sitio_favorito;
   

    $obj_tienda->cod_cat_tie = $_POST["cod_cat_tie"];
    $obj_tienda->cod_mun = $_POST["cod_mun"];
    $obj_tienda->asignar_valor();
   


?>


    <h3 class="title">Sitios Disponibles</h3>

    <hr>
    <div class="p_card">
        <div class="row">
            <?php
            $obj_tienda->puntero = $obj_tienda->filtrar();
            while (($arre_tienda = $obj_tienda->extraer_dato()) > 0) {


    $obj_sitio_fav->cod_tie = $arre_tienda["cod_tie"];
    $obj_sitio_fav->asignar_valor();
    $obj_sitio_fav->puntero = $obj_sitio_fav->consultar();
    $arre_sitio_f = $obj_sitio_fav->extraer_dato();
    $checked = ($arre_sitio_f["tienda_cod_tie"] != "") ? "checked" : "";
                
            ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul>

                        <li>
                            <a href="tienda.php?id=<?php echo $arre_tienda["cod_tie"]; ?>">
                                <div class="card">
                                    <div class="C_img"> <img src="../../../images/logo_tienda/<?php echo $arre_tienda["log_tie"]; ?>" class="absoImg" alt=""> </div>
                                    <div class="C_desc">


                                        <div class="check">
                                            <?php
                                            if ($arre_sitio_f["tienda_cod_tie"] > 0) {
                                                $color = '#F4D03F';
                                            } else {
                                                $color = '#000000';
                                            }

                                            ?>
                                            <i class="fa fa-bookmark" aria-hidden="true" id="des_bot" style="color: <?php echo $color; ?>"></i>


                                            <input type="checkbox" id="cod_tie_fav" value="<?php echo $_GET['id']; ?>" <?php echo $checked; ?> />



                                            <h3 class="title" value="<?php echo $arre_tienda["raz_tie"]; ?>" id="nombre"><?php echo $arre_tienda["raz_tie"]; ?></h3>
                                        </div>




                                        <p class="desc"><?php echo $arre_tienda["nom_cat_tie"]; ?></p>



                                        <i class="fa fa-location-arrow" aria-hidden="true"> -<?php echo $arre_tienda["nom_sec"]; ?></i>
                                        <br>
                                            
                                            <i class="fas fa-clock"></i><b> <?php echo $arre_tienda["hor_lun_vie_hor_tie"]?> - <?php echo $arre_tienda["hor_sab_hor_tie"]?></b>

                                         <div class="price_block">
                                            <div class="star">
                                                <form>
                                                    <p class="clasificacion">
                                                        <input id="radio1" type="radio" name="estrellas" value="5">
                                                        <!--
                                                            --><label for="radio1">★</label>
                                                        <!--
                                                            --><input id="radio2" type="radio" name="estrellas" value="4">
                                                        <!--
                                                            --><label for="radio2">★</label>
                                                        <!--
                                                            --><input id="radio3" type="radio" name="estrellas" value="3">
                                                        <!--
                                                            --><label for="radio3">★</label>
                                                        <!--
                                                            --><input id="radio4" type="radio" name="estrellas" value="2">
                                                        <!--
                                                            --><label for="radio4">★</label>
                                                        <!--
                                                            --><input id="radio5" type="radio" name="estrellas" value="1">
                                                        <!--
                                                            --><label for="radio5">★</label>
                                                    </p>
                                                </form>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php } ?>


        </div>
    </div>
    <script src="../../backend/ajax/funcion/query.js"></script>
<?php

} else {
    header("location: ../index.php");
    exit();
}
?>