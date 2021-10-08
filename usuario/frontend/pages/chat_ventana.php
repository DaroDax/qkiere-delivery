<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {
  require_once("../../backend/clase/chat.class.php");
  $obj_chat_usu = new chat_usu;
  //Envia los datos de la tienda o el domiciliario
  $obj_chat_usu->tienda_cod_tie = $_GET["cod_tie"];
  $obj_chat_usu->asignar_valor();
  $obj_chat_usu->domiciliario_cod_dom = $_GET["cod_dom"];
  $obj_chat_usu->asignar_valor();
  //----------------------------------------------//

  //Extrae los datos de los nombres//
  $obj_chat_usu->puntero = $obj_chat_usu->nom_tie();
  $arre_nom = $obj_chat_usu->extraer_dato();
  $obj_chat_usu->puntero = $obj_chat_usu->nom_dom();
  $arre_dom = $obj_chat_usu->extraer_dato();
  //----------------------------------------------//
?>

<script>

  function cargar_view(){
    dom = "<?php echo $_GET['cod_dom'];?>"; 
    tie =  "<?php echo $_GET['cod_tie'];?>";

    if (dom > 0) {
      $("#chat_end").load('./chat_mensaje.php?cod_dom='+dom);
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

    <input type="hidden" id="tienda_cod" value="<?php echo $_GET["cod_tie"]; ?>">
    <input type="hidden" id="domi_cod" value="<?php echo $_GET["cod_dom"]; ?>">

    <div class="chat_elements">
      <div class="back">
        <i class="fas fa-arrow-circle-left" onclick="back_to_chat();"></i>
      </div>
      <div class="name">
        <h3><?php echo $arre_nom['raz_tie']; ?></h3>
        <h3><?php echo $arre_dom['nom_dom']; ?></h3>
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
      cod_tie = $("#tienda_cod").val();
      cod_dom = $("#domi_cod").val();
      mensaje = $("#msj").val();
      if (cod_dom > 0) {
        dataString = "men_chat_dom=" + mensaje + "&&domiciliario_cod_dom=" + cod_dom + "&&accion=new_msj_dom";
      } else {
        dataString = "men_chat_usu=" + mensaje + "&&tienda_cod_tie=" + cod_tie + "&&accion=new_msj";
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
      cod_tie = $("#tienda_cod").val();
      cod_dom = $("#domi_cod").val();
      //alert(cod_tie + " " + cod_dom);
      Swal.fire({
        title: 'Desea eliminar el chat?',
        showCancelButton: true,
        confirmButtonText: 'Si'
      }).then((result) => {
        if (cod_dom > 0) {
          dataString = "domiciliario_cod_dom=" + cod_dom + "&&accion=borrado_dom";
        } else {
          dataString = "tienda_cod_tie=" + cod_tie + "&&accion=borrado";
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