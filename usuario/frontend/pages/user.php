<?php
session_start();
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/municipio.class.php");
  require_once("../../backend/clase/sector.class.php");

  $obj_usuario = new usuario;
  $obj_usuario->puntero = $obj_usuario->listar();
  $arre_usu = $obj_usuario->extraer_dato();

  $obj_usuario->puntero = $obj_usuario->contador_direccion();
  $arre_usu_dir = $obj_usuario->extraer_dato();

  $obj_municipio = new municipio;
  $obj_municipio->puntero = $obj_municipio->listar();
  $arre_municipio = $obj_usuario->extraer_dato();

  $obj_sector = new sector;


?>

  <head>
    <link href="../css/inicio.css" rel="stylesheet">
    <link href="../css/usuario.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    
    <script src="../../backend/ajax/funcion/usuario.js?3"></script>
     <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!----Bootstrap important---->
  </head>

  <body>
    <div class="modal " id="edit_dir" role="dialog"></div>
    <div class="modal " id="add_dir" role="dialog"></div>

    <script>
      function tu_cuenta() {
        $('.usr-feed').show();
        $('.usr-dir').hide();
      }

      function tu_dir() {
        $('.usr-dir').show();
        $('.usr-feed').hide();
      }

      function reText() {

                $("#tel_usu").removeAttr("disabled");
                $("#cod_usu").removeAttr("disabled");

                $("#tel_usu").css("border", "1px solid #00ff3b");
                $("#cod_usu").css("border", "1px solid #00ff3b");

            }
    </script>
    <div class="main">
      <div class="user_content">
        <div class="buttons_user">
          <div class="usuario-but" onclick="tu_cuenta();">
            <i class="fas fa-user"></i>
            <h5 class="buttons">Tu Cuenta</h5>
          </div>
          <div class="gps-but" onclick="tu_dir();">
            <i class="fas fa-map-marker-alt"></i>
            <h5 class="buttons">Tus Direcciones</h5>
          </div>
        </div>

        <div class="usr-feed">
          <div class="usr-img">
            <div class="img-part">
              <img src="../img/user.png" class="usr-pic" alt="">
            </div>
            <div class="opt-part">
              <i class="fas fa-edit" onclick="reText();"></i>
              <i class="far fa-check-square" onclick="modificar_datos();"></i>
            </div>
          </div>
          <div class="usr-info">
            <input type="" class="usr-form" id="nam_usu" disabled value="<?php echo $arre_usu["nom_usu"]; ?>"><br>
            <input type="" class="usr-form" disabled value="<?php echo $arre_usu["ema_usu"]; ?>"><br>
            <input type="" class="usr-form" id="cod_usu" disabled value="+<?php echo $arre_usu["cod_area_usu"]; ?>">
            <input type="" class="usr-form" id="tel_usu" disabled value="<?php echo $arre_usu["tel_usu"]; ?>"><br>
            <input type="" class="usr-form" id="chat_usu" onkeyup="insertar_chat();" value="<?php echo $arre_usu["chat_id_usu"]; ?>">
            <i class="fab fa-telegram-plane" onclick="notificacion_confir();"></i>
          </div>
          <div class="pas_change">
            <a href="#" class="btn-pass" onclick="cambiar_clave();">Cambiar Contraseña</a>
          </div>
          <div class="cerrar_ses" style="text-align:center; margin:20px 0px;">
            <a href="../../backend/controlador/sesion/sesion.php?accion=cerrar" class="sesion_close" style="color:#FF6A00;">Cerrar Sesión</a>
          </div>
        </div>

        <div class="usr-dir" style="display:none;">
          <div class="add_dir">
            <?php
            if ($arre_usu_dir["total_direccion"] < 5) {
                            # code...
                        ?>
            <a class="add_button" href="javascript:void(0);" data-toggle="modal" data-target="#add_dir" 
                onclick="carga_ajax('<?php echo $arre_usu_dir['cont_direccion']; ?>','add_dir','modals/modal_add_dir.php');"> 
                Agregar Dirección
                </a>
                <?php   } else {
                            echo "<p style='color:#fff;'>Llegaste al limite de direcciones</p>";
                        } ?>
          </div>

          <?php require("./actos/act-usr-dir.php"); ?>

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