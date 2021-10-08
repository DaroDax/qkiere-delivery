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
?>
<!------------------------------------------------------------------------------------>

<?php $obj_chat_usu->puntero = $obj_chat_usu->listar();
        while (($arre_chat = $obj_chat_usu->extraer_dato()) > 0){ ?>

        <?php if ($arre_chat["per_chat_dom"] == 'T'){
                            ?>
          <div class="nosotros">
            <div class="ent_msj">
              <p><?php echo $arre_chat["men_chat_dom"]; ?></p>
            </div>
          </div>
        <?php } else { ?>
          <div class="ellos">
            <div class="slf_msj">
              <p><?php echo $arre_chat["men_chat_dom"]; ?></p>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
<!------------------------------------------------------------------------------------>
<?php $obj_chat_usu->puntero = $obj_chat_usu->listar_dom();
        while (($arre_chat_dom = $obj_chat_usu->extraer_dato()) > 0){ ?>

        <?php if ($arre_chat_dom["per_chat_tie"] == 'U'){
                            ?>
          <div class="nosotros">
            <div class="ent_msj">
              <p><?php echo $arre_chat_dom["men_chat_tie"]; ?></p>
            </div>
          </div>
        <?php } else { ?>
          <div class="ellos">
            <div class="slf_msj">
              <p><?php echo $arre_chat_dom["men_chat_tie"]; ?></p>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
<!------------------------------------------------------------------------------------>
<?php
}else{
}?>
