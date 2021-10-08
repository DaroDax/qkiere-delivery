<?php
session_start();
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");

?>
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