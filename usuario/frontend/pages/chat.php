<?php
session_start();
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/chat.class.php");
  $obj_chat_usu = new chat_usu;

?>

  <head>
    <link href="../css/inicio.css" rel="stylesheet">
    <link href="../css/usuario.css" rel="stylesheet">
    <link href="../css/chat.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/chat.js"></script>
  </head>

  <body>
<script>
   function msj_leido_usu(cod_tie){
    
  dataString="tienda_cod_tie="+cod_tie+"&&accion=msj_leido";
  
  $.ajax({
      type:"POST",
      url:"../../backend/controlador/chat/chat.php",
      data:dataString,
      success:function(r){    
          }
        });
}

function msj_leido_dom(cod_dom){

  dataString="domiciliario_cod_dom="+cod_dom+"&&accion=msj_leido_dom";
  
  $.ajax({
      type:"POST",
      url:"../../backend/controlador/chat/chat.php",
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

      function dom_chat(cod) {
        //alert(cod);
        $("#chat_msj").load('./chat_ventana.php?cod_dom='+cod);
        $('.chat-mensajes').show();
        $('.chat-people').hide();
        $('.domis').hide();
        /*$.ajax({
          type: "POST",
          url: "./chat_ventana.php",
          data: dataString,
          success: function(r) {
            $('#chat_msj').html(r);
            //var miInterval = setInterval(tienda_chat(id),2000);
          }
        });*/
      }
    </script>
    <div class="main">
      <div class="chat_content">

        
          <div class="chat-people">
            <div>

            <div class="chat-head">
              <h3>Tus Mensajes</h3>
            </div>

            <div class="tienda">
              <div class="sec_tie">
                <h5>Tiendas</h5>
              </div>
              <?php $obj_chat_usu->puntero = $obj_chat_usu->tie_dis();
              while (($arre_tie = $obj_chat_usu->extraer_dato()) > 0) { 

                if ($arre_tie["new_tie"] == 1) {
                        if ($arre_tie["cod_tie"] == $arre_tie["tienda_cod_tie"]) {
                          # code...
                         ${"color" . $arre_tie["cod_tie"]}= "#FFC754";
                          } 
                        }
                ?>
                <a href="#" onclick="chat_window(<?php echo $arre_tie['cod_tie'] ?>);msj_leido_usu(<?php echo $arre_tie['cod_tie'] ?>);">
                  <div class="tiendas-chat">
                    <div class="info_tie" style=" background-color: <?php echo ${"color" . $arre_tie['cod_tie']};?>;">
                      <img src="../../../img/log_tie/<?php echo $arre_tie["log_tie"]; ?>" alt="logo">
                      <h4><?php echo $arre_tie["raz_tie"]; ?></h4>
                    </div>
                  </div>
                </a>
            </div>
          <?php } ?>


          <div class="domis">
            <div class="sec_dom">
              <h5>Domiciliarios</h5>
            </div>
            <?php $obj_chat_usu->puntero = $obj_chat_usu->dom_dis();
            while (($arre_dom = $obj_chat_usu->extraer_dato()) > 0) { 

              if ($arre_dom["new_dom"] == 1) {
                        if ($arre_dom["cod_dom"] == $arre_dom["domiciliario_cod_dom"]) {
                          # code...                       
                         ${"color_dom" . $arre_dom["cod_dom"]}= "#FFC754";                          
                          } 
                        }
                  ?>
              <a href="#" onclick="dom_chat(<?php echo $arre_dom['cod_dom'] ?>);msj_leido_dom(<?php echo $arre_dom['cod_dom']?>);">
                <div class="domis-chat">
                  <div class="info_dom" style="background-color: <?php echo ${"color_dom" . $arre_dom['cod_dom']} ?>;">
                    <img src="../../../img/dom_tie/<?php echo $arre_dom["img_dom"]; ?>" alt="logo">
                    <h4><?php echo $arre_dom["nom_dom"]; ?></h4>
                  </div>
                </div>
              </a>
            <?php } ?>
            </div>

            </div>

          </div>
        
        <!------------------------------------------------------->
        <div class="chat-mensajes" style="display:none;">
          <?php require("./actos/act-chat.php"); ?>
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