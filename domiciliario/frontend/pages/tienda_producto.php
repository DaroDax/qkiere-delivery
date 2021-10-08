<?php
session_start();

require_once("../../backend/clase/tienda.class.pub.php");
require_once("../../backend/clase/inventario.pub.class.php");

$obj_tienda_pub = new tienda_pub;
$obj_tienda_pub->cod_tie = $_POST["cod_tie"];
$obj_tienda_pub->asignar_valor();
$obj_tienda_pub->puntero = $obj_tienda_pub->tienda();
$arre_tienda = $obj_tienda_pub->extraer_dato();

//$obj_inventario_pub = new inventario_pub;

if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;
}

?>

<head>
  <link href="../css/tienda_producto.css?5" rel="stylesheet">
  <link href="../css/modals/add_cart.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>

<body>
  <div class="modal " id="add_cart" role="dialog"></div>

  <script type="text/javascript">
    function actualizar() {
      location.reload(true);
    }
    //Función para actualizar cada 4 segundos(4000 milisegundos)
    //setInterval("actualizar()",2000);

    function scrollear() {
      $('html, body').animate({
        scrollTop: $("#<?php echo $_POST["cod_inv"] ?>").offset().top
      }, 100);
    }
    window.onload = scrollear();
  </script>

  <div class="main">
    <div class="tienda_content">
      <div class="feed">
        <div class="inv_list">

          <?php $obj_tienda_pub->puntero = $obj_tienda_pub->inventario_tienda();
          while (($arre_inv = $obj_tienda_pub->extraer_dato()) > 0) {
          ?>
            <div class="card" id="<?php echo $arre_inv["cod_inv"]; ?>">
              <div class="product-name">
                <img src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
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
                  <i class="fas fa-heart"><input type="checkbox" name="check_corazon" id="check_corazon" onclick="" /></i>
                </div>

              </div>

              <div class="add-button">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="button-a">Agregar</a>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>


</body>

</html>
<?php ?>