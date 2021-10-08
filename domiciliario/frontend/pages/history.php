<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_dom"])) {
require_once("../../backend/clase/orden_compra.class.php");

  $obj_orden_compra = new orden_compra;
?>

  <head>
    <link href="../css/tienda.css" rel="stylesheet">
    <link href="../css/carrito.css?5" rel="stylesheet">

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




    <!--modal-->
    <script type="text/javascript" src="https://cdnjs.com/libraries/jquery.mask"></script>
    <script type="text/javascript" src="http://www.jsdelivr.com/projects/jquery.mask"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="modals/idmodal.js"></script>
    <script src="../js/custome.js" defer></script>
    <script src="../js/slick.js" defer></script>
    <script src="../js/jquery.validate.min.js" defer></script>
    <script src="../../backend/ajax/funcion/cart.js"></script>
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
      <div class="carrito_content">

        <h3 style="text-align:center;font-family: 'Montserrat', sans-serif; font-weight:bold;">¡¡Pedidos Completados!!</h3>
        
          <div class="cart-table">
            <table class="table">
              <thead>
                <th>Tienda</th>
                <th>Cliente</th>
                <th>Estatus</th>
                <th>Total</th>
              </thead>
              <?php
        $obj_orden_compra->puntero = $obj_orden_compra->entregadas();
        while (($arreglo = $obj_orden_compra->extraer_dato()) > 0) { ?>

                <tbody>
                  <td class="options">
                    <h4><?php echo $arreglo["raz_tie"]; ?>
            </h4>
          </td>

          <td>
            <h4><?php echo $arreglo["nom_usu"]; ?>
            </h4>
          </td>

          <td class="unit_price">
            <h4><?php echo $arreglo["estatu_pedido_cod_est_ped"]; ?></h4>
          </td>

          <td>
            <h4><?php echo $arreglo["fec_ord_ped"]; ?></h4>
          </td>

        <?php } ?>
        </tbody>
        </table>
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