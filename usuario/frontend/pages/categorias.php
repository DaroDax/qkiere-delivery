<?php
session_start();

require_once("../../backend/clase/categoria_tienda.class.pub.php");

$obj_categoria_tienda_pub = new categoria_tienda_pub;
$obj_categoria_tienda_pub->cod_cat_tie = $_POST["cod_cat_tie"];
$obj_categoria_tienda_pub->asignar_valor();


if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;

  require_once("../../backend/clase/sitio_favorito.class.php");
 $obj_sitio_fav = new sitio_favorito;
} 

?>

  <head>
    <link href="../css/inicio.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>
        <script src="../../backend/ajax/funcion/favoritos.js"></script>
  </head>

  <body>

    <script type="text/javascript">
      function actualizar() {
        location.reload(true);
      }
      //Función para actualizar cada 4 segundos(4000 milisegundos)
      //setInterval("actualizar()",2000);
    </script>



    <div class="main">
      <div class="categoria_content">
        <?php
          $obj_categoria_tienda_pub->puntero = $obj_categoria_tienda_pub->tiendaxcategoria();
        while (($arre_tienda = $obj_categoria_tienda_pub->extraer_dato()) > 0) {

          if (isset($_SESSION["cod_usu"])) {
        $obj_sitio_fav->cod_tie = $arre_tienda['cod_tie'];
        $obj_sitio_fav->asignar_valor();
        $obj_sitio_fav->puntero = $obj_sitio_fav->consultar();
        $arre_sitio_f           = $obj_sitio_fav->extraer_dato();
        $checked                = ($arre_sitio_f["cod_tie"] != "") ? "checked" : "";

                  
                              if ($arre_sitio_f["tienda_cod_tie"] > 0) {
                                                $color = '#F4D03F';
                                            } else {
                                                $color = '#000000';
                                            }
                                           
    }
        ?>
        <div class="cat_resul">
          <a href="#" class="link_tie" onclick="tienda(<?php echo $arre_tienda['cod_tie'];?>);">
            <div class="card">
              <div class="title-card">
                <h2 class="name-card"><?php echo $arre_tienda["raz_tie"]; ?></h2>

              </div>
              <div class="img-card">
                <img class="logo-card" src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
              </div>
              <div class="text-card">
                <h3 class="category-card"><?php echo $arre_tienda["nom_cat_tie"]; ?></h3>
                <?php  if (isset($_SESSION["cod_usu"])) { ?>
                
                 <div class="check-fav"><input type="checkbox" <?php echo $checked; ?> id="cod_tie_fav" onclick="add_sitios_favoritos('<?php echo $arre_tienda['raz_tie']; ?>',<?php echo $arre_tienda['cod_tie']; ?>);" /> <i class="fas fa-bookmark"  id="des_bot" style="color: <?php echo $color; ?>"></i></div>
                 <?php } ?>

                <h5 class="horary-card"><i class="far fa-clock"></i> <?php echo $arre_tienda["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tienda["hor_sab_hor_tie"]; ?></h5>
                </h5>
              </div>
              <p class="sec_mun"><i class="fas fa-map-marker-alt"></i> <?php echo $arre_tienda["nom_sec"]; ?> - <?php echo $arre_tienda["nom_mun"]; ?></p>



            </div>
          </a>
          </div>
        <?php } ?>

      </div>
    </div>

  </body>

  </html>
