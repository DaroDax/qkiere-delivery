<?php
session_start();
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");

?>
<head>
    <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
    <!----Bootstrap important---->
<script src="../../backend/ajax/funcion/favoritos.js"></script>
</head>
<body>

<div class="modal " id="add_cart" role="dialog"></div>
    <script>
      function tu_des() {
        $('.usr-fav-tie').show();
        $('.usr-fav-pro').hide();
      }

      function tu_fav() {
        $('.usr-fav-pro').show();
        $('.usr-fav-tie').hide();
      }
    </script>
    <div class="main">
      <div class="fav_content">
        <div class="buttons_user">
          <div class="usuario-but" onclick="tu_des();">
            <i class="far fa-bookmark" id="des"></i>
            <h5 class="buttons">Tiendas</h5>
          </div>
          <div class="gps-but" onclick="tu_fav();">
            <i class="far fa-heart" id="fav"></i></i>
            <h5 class="buttons">Productos</h5>
          </div>
        </div>

        <div class="usr-fav-tie">
          <?php require("./actos/act-usr-fav-tie.php"); ?>
        </div>

        <div class="usr-fav-pro" style="display:none;">
          <?php require("./actos/act-usr-fav-pro.php"); ?>
        </div>


      </div>
    </div>
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="./modals/idmodal.js"></script>
  
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