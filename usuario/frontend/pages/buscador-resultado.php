<?php
session_start();

require_once("../../backend/clase/inventario.pub.class.php");
require_once("../../backend/clase/tienda.class.pub.php");
require_once("../../backend/clase/categoria_tienda.class.pub.php");


$obj_inventario_pub = new inventario_pub;
$obj_inventario_pub->texto = $_POST["texto"];
$obj_inventario_pub->municipio = $_POST["municipio"];
$obj_inventario_pub->asignar_valor();
$obj_inventario_pub->puntero = $obj_inventario_pub->busqueda_producto();

$obj_tienda_pub = new tienda_pub;
$obj_tienda_pub->texto = $_POST["texto"];
$obj_tienda_pub->municipio = $_POST["municipio"];
$obj_tienda_pub->asignar_valor();
$obj_tienda_pub->puntero = $obj_tienda_pub->busqueda_tienda();

$obj_categoria_tienda_pub = new categoria_tienda_pub;
$obj_categoria_tienda_pub->texto = $_POST["texto"];
$obj_categoria_tienda_pub->municipio = $_POST["municipio"];
$obj_categoria_tienda_pub->asignar_valor();
$obj_categoria_tienda_pub->puntero = $obj_categoria_tienda_pub->busqueda_categoria();



if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;

 require_once("../../backend/clase/producto_favorito.class.php");
$obj_producto_fav = new producto_favorito;

 require_once("../../backend/clase/sitio_favorito.class.php");
 $obj_sitio_fav = new sitio_favorito;
}

?>
<head>
  <link href="../css/tienda_producto.css?5" rel="stylesheet">
  <link href="../css/swal_edit.css" rel="stylesheet">
  <link href="../css/modals/add_cart.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">

<script src="../../backend/ajax/funcion/favoritos.js"></script>
  <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

 
    
    <!----Bootstrap important---->



  
</head>
<body>
<div class="modal " id="add_cart" role="dialog"></div>

<?php if ($obj_inventario_pub->texto != '') {
$patron = stripslashes($_POST["texto"]);
        $si = strlen($patron);
        if ($si > 2) {
 ?>

  <div class="result_forms" id="resultados">
    <div class="sitios-buscados">
      <?php while (($arre_tie = $obj_tienda_pub->extraer_dato()) > 0) {
        if (isset($_SESSION["cod_usu"])) {
        $obj_sitio_fav->cod_tie = $arre_tie['cod_tie'];
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
      <div class="cartas_buscadas">
        <a href="#" class="link_tie" onclick="tienda(<?php echo $arre_tie['cod_tie']; ?>);">
          <div class="card">
            <div class="title-card">
              <h2 class="name-card"><?php echo $arre_tie["raz_tie"]; ?></h2>

            </div>
            <div class="img-card">
              <img class="logo-card" src="../../../img/log_tie/<?php echo $arre_tie["log_tie"]; ?>" alt="">
            </div>
        </a>
            <div class="text-card">
              <h3 class="category-card"><?php echo $arre_tie["nom_cat_tie"]; ?></h3>
               <?php  if (isset($_SESSION["cod_usu"])) { 
                ?>
                
                 <div class="check-fav"><input type="checkbox" <?php echo $checked; ?> id="cod_tie_fav" onclick="add_sitios_favoritos('<?php echo $arre_tie['raz_tie']; ?>',<?php echo $arre_tie['cod_tie']; ?>);" /> <i class="fas fa-bookmark"  id="des_bot" style="color: <?php echo $color; ?>"></i></div>
                 <?php } ?>
              <h5 class="horary-card"><i class="far fa-clock"></i> <?php echo $arre_tie["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tie["hor_sab_hor_tie"]; ?></h5>
              </h5>
            </div>
            <p class="sec_mun"><i class="fas fa-map-marker-alt"></i> <?php echo $arre_tie["nom_sec"]; ?> - <?php echo $arre_tie["nom_mun"]; ?></p>
          </div>
     </div>
      <?php } ?>
    </div>

    <hr>

    <div class="productos-buscados" style="display:none;">

      <?php while (($arre_inv = $obj_inventario_pub->extraer_dato()) > 0) {

      ?>
        <div class="card" id="<?php echo $arre_inv["cod_inv"]; ?>">
          <div class="product-name">
            <img src="../../../img/log_tie/<?php echo $arre_inv["log_tie"]; ?>" alt="">
            <a onclick="tienda(<?php echo $arre_inv['cod_tie']; ?>);">
              <h2 class="pro_nom"><?php echo $arre_inv["raz_tie"]; ?></h2>
            </a>
          </div>

          <div class="img-card">
            <img src="../../../img/inv_tie/<?php echo $arre_inv["img_inv"]; ?>" alt="">
          </div>


          <div class="product-info">

            <div class="info-info">
              <h2 class="pro_nom"><?php echo $arre_inv["nom_inv"]; ?></h2>
              <h4 class="des_pro"><?php echo $arre_inv["des_inv"]; ?></h4>
              <h5 class="pre_pro">$<?php echo $precio = number_format($arre_inv["pre_inv"], 0, ",", ".");  ?></h5>

            </div>

            <div class="info-pre">
             <?php  if (isset($_SESSION["cod_usu"])) { 

                  $obj_producto_fav->cod_tie = $_POST["cod_tie"];
                  $obj_producto_fav->asignar_valor();
                 $obj_producto_fav->puntero = $obj_producto_fav->listarXbusqueda();
                  while (($arre_pro_f = $obj_producto_fav->extraer_dato()) > 0){

                    if ($arre_pro_f["inventario_cod_inv"] == $arre_inv["cod_inv"]) {

                        ${"producto" .  $arre_inv["cod_inv"]} = "#C0392B";
                        ${"check" .  $arre_inv["cod_inv"]} = "checked";
                      }
                    }
              ?>
                 <i class="fas fa-heart" style="color:<?php echo ${'producto' .  $arre_inv['cod_inv']}?>;"><input type="checkbox" <?php echo ${'check' .  $arre_inv['cod_inv']}?>  id="cod_inv" name="cod_inv<?php echo $arre_inv["cod_inv"]; ?>" value="<?php echo $arre_inv["cod_inv"]; ?>" onclick="add_producto_favorito('<?php echo $arre_inv['cod_inv']; ?>',this.checked);" /></i>
            <?php } ?>
            </div>

          </div>

          <div class="add-button">
             <?php  if($arre_inv["can_inv"]>0){ ?>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="button-a">Agregar</a>
            <?php }else{ echo "Producto no Disponible."; }?>
          </div>
        </div>
      <?php } ?>

    </div>

    <hr>

    <div class="categorias-buscadas" style="display:none;">

      <?php while (($arre_cat = $obj_categoria_tienda_pub->extraer_dato()) > 0) {
      ?>
        <a href="#" onclick="categorias(<?php echo $arre_cat['cod_cat_tie']; ?>);">
          <div class="card-cat">
            <h2 class="nom_cat"><?php echo $arre_cat["nom_cat_tie"]; ?></h2>
          </div>
        </a>
      <?php } ?>

    </div>
  </div>
    <script src="../js/bootstrap.min.js"></script>
    <script src="./modals/idmodal.js"></script>

</body>

  </html>
<?php }
}else{
  echo "<h3 class='pro' style='text-align:center;'>¡¡Busqueda muy corta!!</h3>";
}
 ?>

