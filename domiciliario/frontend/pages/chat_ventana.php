<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_dom"])) {
  require_once("../../backend/clase/chat.class.php");
  $obj_chat_usu = new chat_usu;
  //Envia los datos de la tienda o el domiciliario
  $obj_chat_usu->usuario_cod_usu = $_GET["cod_usu"];
  $obj_chat_usu->asignar_valor();
  $obj_chat_usu->tienda_cod_tie = $_GET["cod_tie"];
  $obj_chat_usu->asignar_valor();
  //----------------------------------------------//

  //Extrae los datos de los nombres//
  $obj_chat_usu->puntero = $obj_chat_usu->nom_usu();
  $arre_nom = $obj_chat_usu->extraer_dato();
  $obj_chat_usu->puntero = $obj_chat_usu->nom_dom();
  $arre_tie = $obj_chat_usu->extraer_dato();
  //----------------------------------------------//
?>

<script>

  function cargar_view(){
    usu = "<?php echo $_GET['cod_usu'];?>"; 
    tie = "<?php echo $_GET['cod_tie'];?>";

    if (usu > 0) {
      $("#chat_end").load('./chat_mensaje.php?cod_usu='+usu);
    }else{
      $("#chat_end").load('./chat_mensaje.php?cod_tie='+tie);
    }
  }

  window.onload = cargar_view();

    function back_to_chat() {
      $(".content").load('./chat.php');
    }
  </script>
  <script>
    function bajar_scroll() {
      $(".msj_window").scrollTop(1000000);
    }

    function eval_vac() {
      men = $("#msj").val();
      if (men == "") {
        $("#btn_msj").hide("slow");
      } else {
        $("#btn_msj").show("slow");
      }
      bajar_scroll();

    }
    window.onload = eval_vac();
  </script>
  <script>
    function presionar_tecla() {
      tecla_ent = event.keyCode;
      if (tecla_ent == 13) {
        if ($("#msj").val() == "") {
          alert("Campo Vacio");
        } else {
          sent_msj();
          bajar_scroll();
          
        }
      }
    }
  </script>

  <!--//----------------------------------------------------------//-->
  <div class="chat_view">

    <input type="hidden" id="usuario_cod" value="<?php echo $_GET["cod_usu"]; ?>">
    <input type="hidden" id="tienda_cod" value="<?php echo $_GET["cod_tie"]; ?>">

    <div class="chat_elements">
      <div class="back">
        <i class="fas fa-arrow-circle-left" onclick="back_to_chat();"></i>
      </div>
      <div class="name">
        <h3><?php echo $arre_nom['nom_usu']; ?></h3>
        <h3><?php echo $arre_tie['raz_tie']; ?></h3>
      </div>

      <div class="trash">
        <i class="far fa-trash-alt" onclick="borrado_logico();"></i>
      </div>
    </div>

    <div class="msj_window">
      <div id="chat_end"></div>
    </div>


<!------------------------------------------------------------------------->


    <div class="sent_elements">
      <textarea name="" onclick="bajar_scroll();" id="msj" value="" onkeyup="eval_vac();" placeholder="Escribe un mensaje (Toca aqui para ir hasta abajo del chat)" onkeypress="presionar_tecla();"></textarea>
      <i class="fas fa-chevron-circle-right" onclick="sent_msj();" id="btn_msj"></i>
    </div>


  </div>
  <!----------------------------------->

  <script>
    function sent_msj() {
      cod_usu = $("#usuario_cod").val();
      cod_tie = $("#tienda_cod").val();
      mensaje = $("#msj").val();
      if (cod_tie > 0) {
        dataString = "men_chat_tie=" + mensaje + "&&tienda_cod_tie=" + cod_tie + "&&accion=new_msj_dom";
      } else {
        dataString = "men_chat_dom=" + mensaje + "&&usuario_cod_usu=" + cod_usu + "&&accion=new_msj";
      }
      //alert(dataString);
      $.ajax({
        type: "POST",
        url: "../../backend/controlador/chat/chat.php",
        data: dataString,
        success: function(r) {
          cargar_view();
          $("#msj").val("");
        }
      });
    }
  </script>
  <script>
    function borrado_logico() {
      cod_usu = $("#usuario_cod").val();
      cod_tie = $("#tienda_cod").val();
      //alert(cod_tie + " " + cod_dom);
      Swal.fire({
        title: 'Desea eliminar el chat?',
        showCancelButton: true,
        confirmButtonText: 'Si'
      }).then((result) => {
        if (cod_tie > 0) {
          dataString = "tienda_cod_tie=" + cod_tie + "&&accion=borrado_dom";
        } else {
          dataString = "usuario_cod_usu=" + cod_usu + "&&accion=borrado";
        }

        //alert(dataString);
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "../../backend/controlador/chat/chat.php",
            data: dataString,
            success: function(r) {
              Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Chat Eliminado.',
                showConfirmButton: false,
                timer: 1500
              });
            }
          });
        }
      })
    }
  </script>
  <!----------------------------------->
<?php } ?>