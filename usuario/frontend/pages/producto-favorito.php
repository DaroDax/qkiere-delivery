<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {
  require_once("../../backend/clase/producto_favorito.class.php");
  $obj_producto_fav = new producto_favorito;
  $obj_producto_fav->asignar_valor();
  $obj_producto_fav->puntero = $obj_producto_fav->listar();
?>  <head>
    <link href="../css/inicio.css" rel="stylesheet">
    <link href="../css/tienda_producto.css" rel="stylesheet">
    <link href="../css/favorito.css" rel="stylesheet">
    <link href="../css/modals/add_cart.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
  <script src="../../backend/ajax/funcion/favoritos.js"></script>

  </head>

  <body>
<div class="modal " id="add_cart" role="dialog"></div>
  <div class="pro-fav">
    <?php
    while (($arre_inv = $obj_producto_fav->extraer_dato()) > 0) {
      $cod_i = $arre_inv["cod_inv"];
      //$checked_producto = ($arre_inv["cod_inv"] != "") ? "checked" : ""; ?>

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
            <?php
            if ($arre_inv["cod_inv"] > 0) {
              $color = '#E74C3C';
            } else {
              $color = '#000000';
            }
            ?>
            <i class="fas fa-heart" style="color:#E74C3C;"><input type="checkbox" id="cod_inv" name="cod_inv<?php echo $arre_inv["cod_inv"]; ?>" value="<?php echo $arre_inv["cod_inv"]; ?>" checked onclick="add_producto_favorito('<?php echo $arre_inv['cod_inv']; ?>',this.checked);" /></i>

          </div>

        </div>

        <div class="add-button">
           <?php  if($arre_inv["can_inv"]>0){ ?>
          <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','./modals/modal_add_cart.php');" class="button-a">Agregar</a>
          <?php }else{ echo "Producto no Disponible."; }?>
        </div>
      </div>
    <?php } ?>
  </div>
<?php } ?>

 

</body>