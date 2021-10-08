<?php
session_start();

if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/orden_compra.class.php");
  require_once("../../backend/clase/seguimiento_orden_compra.class.php");

  $obj_usuario = new usuario;
  $obj_orden_compra = new orden_compra;
  $obj_seg_orden_compra = new seguimiento_orden_compra;

  $obj_orden_compra->puntero = $obj_orden_compra->orden_compra_p_contador();
  $arre_can = $obj_orden_compra->extraer_dato();

?>
  <div class="pedidos_resultado">
    <?php 
    if($arre_can['ped'] == 0) {
        echo "<h2 class='out'>Tus Pedidos apareceran aqui ¿No tienes ninguno?<br> ¡¡Puedes comprar en nuestra variedad de tiendas!!</h2>";
      }else{

    $obj_orden_compra->puntero = $obj_orden_compra->orden_compra_p();
    while (($arre_orden_compra = $obj_orden_compra->extraer_dato()) > 0) {

      //Verifica el estatus del pedido
      $obj_seg_orden_compra->cod_tie = $arre_orden_compra["tienda_cod_tie"];
      $obj_seg_orden_compra->cod_ord_com = $arre_orden_compra["cod_ord_com"];
      $obj_seg_orden_compra->asignar_valor();
      $obj_seg_orden_compra->puntero = $obj_seg_orden_compra->seguimiento();
      $arre_seg_orden_compra = $obj_seg_orden_compra->extraer_dato();
      
      
      ?>
<head>
 
  <script type="text/javascript" src="https://cdnjs.com/libraries/jquery.mask"></script>
  <script type="text/javascript" src="http://www.jsdelivr.com/projects/jquery.mask"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 
   <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!----Bootstrap important---->
  
  <script src="../../backend/ajax/lib/jquery.min.js"></script>
  <script src="modals/idmodal.js"></script>
   <script src="../../backend/ajax/funcion/orden_compra.js"></script>

</head>

      <div class="pedidos-card">
        <div class="info-pedido">
          <div class="img-pedido"> <img src="../../../img/log_tie/<?php echo $arre_orden_compra["log_tie"]; ?>" alt="" class="logo-pedido" onclick="tienda(<?php echo $arre_orden_compra['cod_tie']; ?>);"></div>
          <div class="datos-pedido">

            <h4 class="des-pedido">Orden:</h4>
            <h3 class="nam-pedido">#<?php echo $arre_orden_compra["cod_ord_com"]; ?></h3>

            <h4 class="des-pedido">Tienda:</h4>
            <h3 class="nam-pedido"><?php echo $arre_orden_compra["raz_tie"]; ?></h3>

            <h4 class="des-pedido">Fecha:</h4>
            <h3 class="nam-pedido"><?php echo $arre_orden_compra["fec_ord_ped"]; ?></h3>

            <h4 class="des-pedido">Total:</h4>
            <h3 class="nam-pedido">$<?php echo $tota = number_format($arre_orden_compra["mon_ord_ped"], 0, ",", "."); ?></h3>

          </div>
        </div>

        <?php

      $obj_seg_orden_compra->puntero = $obj_seg_orden_compra->seguimiento();
      while (($arre_seg_orden_compra = $obj_seg_orden_compra->extraer_dato()) > 0) {

        if ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 1) {
          ${"color1" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
          $show = "inline-block";
          $dom_sho = "none";
        } elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 2) {
          ${"color2" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
          $show = "none";
          $dom_sho = "none";
        } elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 3) {
          ${"color3" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
          $show = "none";
          $dom_sho = "inline-block";
        } elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 4) {
          ${"color4" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
          $show = "none";
          $dom_sho = "inline-block";
        } elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 5) {
          ${"color5" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
          $show = "none";
          $dom_sho = "inline-block";
        }
      }

        $recibido = "fas fa-store";
        $preparado = "fas fa-box";
        $repartido = "fas fa-motorcycle";
        $entregado = "fas fa-check-square"; ?>
        <div class="line-time">

          <div class="lt-des">

            <h5>Creado</h5>
            <h5>Aceptado</h5>
            <h5>Preparado</h5>
            <h5>Domiciliario</h5>
            <h5>Entregado</h5>

          </div>
          <div class="lt-items">
            <i name="iconos" class="far fa-check-square" style="color: <?php echo  ${"color1" . $arre_orden_compra["cod_ord_com"]} ?>"></i>

            <i name="iconos" class="<?php echo $recibido; ?>" style="color: <?php echo ${"color2" . $arre_orden_compra["cod_ord_com"]} ?>"></i>

            <i name="iconos" class="<?php echo $preparado; ?>" style="color: <?php echo ${"color3" . $arre_orden_compra["cod_ord_com"]} ?>"></i>

            <i name="iconos" class="<?php echo $repartido; ?>" style="color: <?php echo  ${"color4" . $arre_orden_compra["cod_ord_com"]} ?>"></i>

            <i name="iconos" class="<?php echo $entregado; ?>" style="color: <?php echo ${"color5" . $arre_orden_compra["cod_ord_com"]} ?>"></i>
          </div>

        </div>
        <div class="options-pedido">

          <i href="#" onclick="cancelar_orden_compra('<?php echo $arre_orden_compra['cod_ord_com']; ?>');" class="fa fa-times" aria-hidden="true" id="delete" style="display: <?php echo $show ?>"> Eliminar</i>

          <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arre_orden_compra['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_det_ped.php');"><i class="fas fa-info-circle" id="details"> Detalles</i></a>

          <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_domi" onclick="carga_ajax('<?php echo $arre_orden_compra['domiciliario_cod_dom']; ?>','detalle_domi','modals/modal_det_domi.php');"><i class="fas fa-running" id="dom_details" style="display: <?php echo $dom_sho ?>; color=#ccc"> Domiciliario</i></a>

        </div>
      </div>
      <?php } ?>
    <?php } ?>
  </div>




<?php
} else {
?>
  <script>
    Swal.fire({
      title: '¡¡Tienes que iniciar sesión!!',
      text: "¿Quieres iniciar o registrarte?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Iniciar Sesion'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "./login.php"
      }
    })
  </script>
<?php
}
?>