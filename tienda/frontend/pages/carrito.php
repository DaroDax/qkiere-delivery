<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/cart.class.php");
  require_once("../../backend/clase/tienda.class.php");
  $obj_usuario = new usuario;
  $obj_cart = new cart;
  $obj_tienda = new tienda;




?>

  <head>
    <link href="../css/tienda.css" rel="stylesheet">
    <link href="../css/carrito.css?1" rel="stylesheet">

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
    <div class="modal " id="edit_cart" role="dialog"></div>

    <script type="text/javascript">
      function actualizar() {
        location.reload(true);
      }
      //Función para actualizar cada 4 segundos(4000 milisegundos)
      //setInterval("actualizar()",2000);
    </script>



    <div class="main">
      <div class="carrito_content">
        <?php require("./actos/act-carrito-tienda.php") ?>
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