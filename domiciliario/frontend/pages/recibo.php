<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_dom"])) {

  require_once("../../backend/clase/orden_compra.class.php");
  require_once("../../backend/clase/detalle_orden_compra.class.php");

    $obj_oden_compra = new orden_compra;
    $obj_oden_compra->cod_qr_ord_com=$_GET["cod"];
    $obj_oden_compra->asignar_valor();
    $obj_oden_compra->puntero=$obj_oden_compra->consultar_orden_compra();
    $arre_orden_compra=$obj_oden_compra->extraer_dato();

    $obj_detalle_ord_com= new detalle_orden_compra;
    $obj_detalle_ord_com->cod_ord_com=$arre_orden_compra["cod_ord_com"];
    $obj_detalle_ord_com->asignar_valor();

?>

  <head>
    <link href="../css/tienda.css" rel="stylesheet">
    <link href="../css/carrito.css" rel="stylesheet">
    <link href="../css/recibo.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../icons/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>
    <script src="../../backend/ajax/funcion/validacion.js"></script>
    <script src="../../backend/ajax/funcion/orden_compra.js"></script>

    <link href="../css/swal_edit.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </head>

  <body>
<div class="nav_menu">
            <nav class="navigation">
                <div class="nav-items">
                    <img src="../../../img/64.png" alt="" class="intercod_img">
                    <h1 class="intercod_h1">Domiciliario</h1>

                    <i class="fas fa-comment" onclick="chat();"></i>
                    <i class="fas fa-power-off" onclick="logout();"></i>
                    <script>
                        function logout(){
                            location.href="../../backend/controlador/sesion/sesion.php?accion=cerrar";
                        }
                    </script>
                </div>
            </nav>
        </div>

   
      <div class="recibo_content">
        <div class="recibo-complete">
          <div class="recibo-info">
            <div class="recibo_dir">
              <h3 class="dir_title" style="text-align:center;">Validar Orden #<?php echo $arre_orden_compra["cod_ord_com"]; ?></h3>
            </div>
          </div>
        </div>

        <div class="recibo_inv">
          <div class="recibo_inv_head">
            <h3 class="inv_title"><?php echo $arre_orden_compra["raz_tie"]; ?></h3>
          </div>

          <div class="recibo_inv_cont">
            <?php 
            $obj_detalle_ord_com->puntero=$obj_detalle_ord_com->consultar();
            while(($arreglo=$obj_detalle_ord_com->extraer_dato())>0){
              ?>
              <div class="inv_list_item">
                <i class="far fa-times-circle"></i>
                <h5 class="inv_item"><?php echo $arreglo["can_det_ord_com"];  ?> x <?php echo $arreglo["nom_inv"];?></h5>
                <h5 class="inv_precio">$<?php echo $total = number_format($arreglo["mon_tot_det_ord_com"], 0, ",", "." ); ?></h5>
              </div>
            <?php }
            ?>
          </div>
            <br>
          <div class="next_button">
            <a href="#" class="button-confir" onclick="recibir_orden_compra('<?php echo $arre_orden_compra["cod_ord_com"]; ?>','<?php echo $arre_orden_compra["cod_tie"]; ?>','<?php echo $arre_orden_compra["raz_tie"]; ?>','<?php echo $arre_orden_compra["usuario_cod_usu"]; ?>','<?php echo $arre_dom["chat_id_dom"]; ?>','<?php echo $arre_dom["nom_dom"]; ?>','<?php echo $arre_dom["ape_dom"]; ?>');">
              <div class="a_button">!!Recibir!!</div>
            </a>
          </div>
        </div>


      </div>
    

<div class="nav_bottom">
            <div class="bottom_items">
                <a href="./menu.php" class="item"><i class="fas fa-motorcycle"></i></a>
                <a href="#" class="item" onclick="domiciliario();"><i class="fas fa-list"></i></a>
                <a href="#" class="item" onclick="tiendas();"><i class="fas fa-user"></i></a>

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