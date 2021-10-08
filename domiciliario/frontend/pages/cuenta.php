<?php
session_start();
if (isset($_SESSION["cod_dom"])) {

require_once("../../backend/clase/municipio.class.php");
require_once("../../backend/clase/domiciliario.class.php");
  $obj_municipio = new municipio;

  $obj_domiciliario = new domiciliario;
  $obj_domiciliario->puntero = $obj_domiciliario->consultar();
  $arre_dom= $obj_domiciliario->extraer_dato();

?>

  <head>
    <link href="../css/inicio.css" rel="stylesheet">
    <link href="../css/usuario.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/funcion.js"></script>
    <script src="../../backend/ajax/funcion/clave.js"></script>
  </head>

  <body>

    <script>
      function insertar_chat(){

        chat = $("#chat_usu").val();

        dataString="chat_id_dom="+chat+"&&accion=add_chat_id";
       
        
                $.ajax({
                    type:"POST",
                    url:"../../backend/controlador/domiciliario/domiciliario.php",
                    data:dataString,
                    success:function(r){

                    }
                });
                   
            }

    </script>

    <script>
      function tu_cuenta() {
        $('.usr-feed').show();
        $('.usr-dir').hide();
      }

      function tu_dir() {
        $('.usr-dir').show();
        $('.usr-feed').hide();
      }
    </script>
    <div class="main">
      <div class="user_content">
  
        <div class="usr-feed">
          <div class="usr-img">
            <div class="img-part">
              <img src="../../../img/dom_tie/<?php echo $arre_dom["img_dom"]; ?>" class="usr-pic" alt="" style="border-radius: 100%;width: 120px; height: 120px; border:3px solid #FF6A00; padding:5px;">
            </div>
          
          </div>
          <div class="usr-info">
            <input type="" class="usr-form" disabled value="<?php echo  $arre_dom["tip_doc_tie"]."".$arre_dom["ced_dom"];?>"><br>
            <input type="" class="usr-form" disabled value="<?php echo  $arre_dom["nom_dom"]; ?> <?php echo  $arre_dom["ape_dom"]; ?>"><br>
            <input type="" class="usr-form" disabled value="+<?php echo  $arre_dom["tel_dom"]; ?>"><br>
            <input type="" class="usr-form" disabled value="<?php echo  $arre_dom["nom_mun"]." - ".$arre_dom["nom_sec"]; ?>"><br>
            <input type="" class="usr-form" disabled value="<?php echo  $arre_dom["dir_dom"]; ?>"><br>
            <input type="" class="usr-form" disabled value="<?php echo  $arre_dom["ema_dom"]; ?>"><br>
            <input type="" class="usr-form" id="chat_usu" onkeyup="insertar_chat();" value="<?php echo $arre_dom["chat_id_dom"]; ?>">
            <i class="fab fa-telegram-plane" onclick="notificacion_confir('<?php echo  $arre_dom["nom_dom"]; ?>','<?php echo  $arre_dom["ape_dom"]; ?>','<?php echo  $arre_dom["chat_id_dom"]; ?>');"></i>
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
            <a href="#" class="add_button">Agregar Direccion</a>
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