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

  <script type="text/javascript" src="https://cdnjs.com/libraries/jquery.mask"></script>
  <script type="text/javascript" src="http://www.jsdelivr.com/projects/jquery.mask"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="../../backend/ajax/lib/jquery.min.js"></script>
  <script src="modals/idmodal.js"></script>
  <script src="../js/custome.js" defer></script>
  <script src="../js/slick.js" defer></script>
  <script src="../js/jquery.validate.min.js" defer></script>
</head>
<body>
<div class="modal " id="add_cart" role="dialog"></div>

<?php if ($obj_inventario_pub->texto != '') { ?>

  <div class="result_forms" id="resultados">
    <div class="sitios-buscados">
      <?php while (($arre_tie = $obj_tienda_pub->extraer_dato()) > 0) {
      ?>
        <a href="#" class="link_tie" onclick="tienda(<?php echo $arre_tie['cod_tie']; ?>);">
          <div class="card">
            <div class="title-card">
              <h2 class="name-card"><?php echo $arre_tie["raz_tie"]; ?></h2>

            </div>
            <div class="img-card">
              <img class="logo-card" src="../../../img/log_tie/<?php echo $arre_tie["log_tie"]; ?>" alt="">
            </div>
            <div class="text-card">
              <h3 class="category-card"><?php echo $arre_tie["nom_cat_tie"]; ?></h3>
              <i class="fas fa-bookmark"></i>

              <h5 class="horary-card"><i class="far fa-clock"></i> <?php echo $arre_tie["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tie["hor_sab_hor_tie"]; ?></h5>
              </h5>
            </div>
            <p class="sec_mun"><i class="fas fa-map-marker-alt"></i> <?php echo $arre_tie["nom_sec"]; ?> - <?php echo $arre_tie["nom_mun"]; ?></p>
          </div>
        </a>
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
              <i class="fas fa-heart"></i>
            </div>

          </div>

          <div class="add-button">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="button-a">Agregar</a>
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
</body>

  </html>
<?php }  ?>
