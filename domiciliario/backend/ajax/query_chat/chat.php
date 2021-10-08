<?php

session_start();
if (isset($_SESSION ["cod_dom"])){

require_once("../../clase/chat.class.php");

    $obj_chat_usu = new chat_usu;

    $obj_chat_usu->usuario_cod_usu=$_POST["usuario_cod_usu"];
    $obj_chat_usu->asignar_valor();

    
    $obj_chat_usu->tienda_cod_tie=$_POST["tienda_cod_tie"];
    $obj_chat_usu->asignar_valor();
?>

  <?php $obj_chat_usu->puntero = $obj_chat_usu->nom_usu();
  $arre_nom = $obj_chat_usu->extraer_dato(); ?>
  

  <?php $obj_chat_usu->puntero = $obj_chat_usu->nom_dom();
  $arre_dom = $obj_chat_usu->extraer_dato(); ?>
  

  <div style="text-align: right; font-size: 150%;">
    <h4 style="display: inline;"> <?php echo $arre_nom["nom_usu"]; ?></h4>
    <h4 style="display: inline;"> <?php echo $arre_dom["raz_tie"]; ?></h4>
  </div>




  <input type="hidden" id="usuario_cod" value="<?php echo $_POST["usuario_cod_usu"];?>">    
              <?php
                   $obj_chat_usu->puntero = $obj_chat_usu->listar();
                      while (($arre_chat = $obj_chat_usu->extraer_dato()) > 0) {
  
                      ?>    

                      <?php if ($arre_chat["per_chat_dom"] == 'T'){
                            ?><div class="outgoing_msg">
              <div class="sent_msg">
                <p><?php echo $arre_chat["men_chat_dom"]; ?></p>
               
                <span class="time_date"> <?php echo $arre_chat["fec_chat_dom"]; ?> </span> </div>
            </div>



            <?php } else{
                ?>
                    <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://d338t8kmirgyke.cloudfront.net/icons/icon_pngs/000/004/088/original/user.png " style="border-radius: 100%"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?php echo $arre_chat["men_chat_dom"]; ?></p>
                  <span class="time_date">  <?php echo $arre_chat["fec_chat_dom"]; ?></span></div>
              </div>
            </div>
                <?php } ?>
                      
            <?php } ?>
            <!---------------------------------------------------------------------------->
  <input type="hidden" id="tienda_cod" value="<?php echo $_POST["tienda_cod_tie"];?>">  
            <?php
                   $obj_chat_usu->puntero = $obj_chat_usu->listar_dom();
                      while (($arre_chat_dom = $obj_chat_usu->extraer_dato()) > 0) {
  
                      ?>    

                      <?php if ($arre_chat_dom["per_chat_tie"] == 'U'){
                            ?><div class="outgoing_msg">
              <div class="sent_msg">
                <p><?php echo $arre_chat_dom["men_chat_tie"]; ?></p>
               
                <span class="time_date"> <?php echo $arre_chat_dom["fec_chat_tie"]; ?> </span> </div>
            </div>



            <?php } else{
                ?>
                    <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="../../../../delivery/images/logo_tienda/<?php echo $arre_chat_dom["log_tie"]; ?>" style="border-radius: 100%"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?php echo $arre_chat_dom["men_chat_tie"]; ?></p>
                  <span class="time_date">  <?php echo $arre_chat_dom["fec_chat_tie"]; ?></span></div>
              </div>
            </div>
                <?php } ?>
                      
            <?php } ?>

<?php
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>