<?php
session_start();

require_once("../../backend/clase/tienda.class.pub.php");
require_once("../../backend/clase/inventario.pub.class.php");

$obj_tienda_pub = new tienda_pub;
$obj_tienda_pub->cod_tie = $_POST["cod_tie"];
$obj_tienda_pub->cod_tie = $_POST["cod_cat_pro"];
$obj_tienda_pub->asignar_valor();

$obj_inventario_pub = new inventario_pub;

if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;
}
?>


  <?php $obj_tienda_pub->puntero = $obj_tienda_pub->inventario_tienda();
  while (($arre_inv = $obj_tienda_pub->extraer_dato()) > 0) {
  ?>

    <a href="#" onclick="producto(<?php echo $arre_inv['cod_inv']; ?>);" class="a_pro">
      <div class="img-card">
        <img src="../../../img/inv_tie/<?php echo $arre_inv["img_inv"]; ?>" alt="">
    </div>
    </a>
  <?php } ?>
