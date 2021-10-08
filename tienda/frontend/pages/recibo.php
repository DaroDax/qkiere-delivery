<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/cart.class.php");
  require_once("../../backend/clase/tienda.class.php");

  $obj_usuario = new usuario;
  $obj_usuario->cod_usu = $_SESSION["cod_usu"];
  $obj_usuario->puntero = $obj_usuario->listar();
  $arre_usu = $obj_usuario->extraer_dato();

  $obj_tienda = new tienda;
  $obj_tienda->cod_tie = $_POST["cod_tie"];
  $obj_tienda->asignar_valor();
  $obj_tienda->puntero = $obj_tienda->consultar();
  $arre_tienda = $obj_tienda->extraer_dato();

  $obj_cart = new cart;
  $obj_cart->cod_tie = $_POST["cod_tie"];
  $obj_cart->asignar_valor();
  $obj_cart->puntero = $obj_cart->sumatoria_tem_pedido();
  $arre_sumatoria = $obj_cart->extraer_dato();

?>

  <head>
    <link href="../css/tienda.css" rel="stylesheet">
    <link href="../css/carrito.css" rel="stylesheet">
    <link href="../css/recibo.css?2" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>
    <script src="../../backend/ajax/funcion/validacion.js"></script>

    <link href="../css/swal_edit.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </head>

  <body>

    <div class="main">
      <div class="recibo_content">
        <div class="recibo-complete">
          <div class="recibo-info">
            <div class="recibo_dir">
              <h3 class="dir_title">Elige una Dirección <i class="far fa-plus-square"></i></h3>


              <div id="dir-select-dir">
                <?php require("./actos/act-select-recibo.php"); ?>
              </div>
            </div>
          </div>
        </div>

        <div class="recibo_info">
          <label for="nombre">
            <h5 class="title_recibo">Nombre*</h5>
            <h4 name="nombre" class="info_recibo"> <?php echo $arre_usu["nom_usu"] ?> </h4>
          </label>

          <label for="telefono">
            <h5 class="title_recibo">Telefono*</h5>
            <h4 name="telefono" class="info_recibo">+<?php echo $arre_usu["cod_area_usu"] ?> <?php echo $arre_usu["tel_usu"] ?></h4>
          </label>
        </div>

        <div class="recibo_inv">
          <div class="recibo_inv_head">
            <h3 class="inv_title"><?php echo $arre_tienda["raz_tie"]; ?></h3>
          </div>

          <div class="recibo_inv_cont">
            <?php

            $obj_cart->puntero = $obj_cart->checkout();
            while (($arre_cart = $obj_cart->extraer_dato()) > 0) {
            ?>
              <div class="inv_list_item">
                <i class="far fa-times-circle"></i>
                <h5 class="inv_item"><?php echo $arre_cart["can_tem_ped"]; ?> x <?php echo $arre_cart["nom_inv"]; ?></h5>
                <h5 class="inv_precio">$<?php echo $total = number_format($arre_cart["tot_tem_ped"], 0, ",", "."); ?></h5>
              </div>
            <?php }
            ?>
          </div>
          <div class="inv_total">
            <h5 class="total_text">Total:</h5>
            <h4 class="price_total"> $<?php echo $total = number_format($arre_sumatoria["total_pedido"], 0, ",", "."); ?></h4>

          </div>
          <div class="next_button">
            <a href="#" class="button-confir" onclick="pedir();">
              <div class="a_button">¡¡Pedir Compra!!</div>
            </a>
          </div>
        </div>


      </div>
    </div>
  </body>

  </html>
<?php } else {
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
} ?>