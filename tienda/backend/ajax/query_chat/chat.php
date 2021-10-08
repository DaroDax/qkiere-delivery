<?php

session_start();
if (isset($_SESSION ["cod_tie"])){

require_once("../../clase/chat.class.php");

    $obj_chat_usu = new chat_usu;

    $obj_chat_usu->usuario_cod_usu=$_POST["usuario_cod_usu"];
    $obj_chat_usu->asignar_valor();

    
    $obj_chat_usu->domiciliario_cod_dom=$_POST["domiciliario_cod_dom"];
    $obj_chat_usu->asignar_valor();
?>

  <?php $obj_chat_usu->puntero = $obj_chat_usu->nom_usu();
  $arre_nom = $obj_chat_usu->extraer_dato(); ?>
  

  <?php $obj_chat_usu->puntero = $obj_chat_usu->nom_dom();
  $arre_dom = $obj_chat_usu->extraer_dato(); ?>
  

  <div style="text-align: right; font-size: 150%;">
    <h4 style="display: inline;"> <?php echo $arre_nom["nom_usu"]; ?></h4>
    <h4 style="display: inline;"> <?php echo $arre_dom["nom_dom"]; ?></h4>
  </div>




  <input type="hidden" id="usuario_cod" value="<?php echo $_POST["usuario_cod_usu"];?>">    
              <?php
                   $obj_chat_usu->puntero = $obj_chat_usu->listar();
                      while (($arre_chat = $obj_chat_usu->extraer_dato()) > 0) {
  
                      ?>    

                      <?php if ($arre_chat["per_chat_usu"] == 'T'){
                            ?><div class="outgoing_msg">
              <div class="sent_msg">
                <p><?php echo $arre_chat["men_chat_usu"]; ?></p>
               
                <span class="time_date"> <?php echo $arre_chat["fec_men_usu"]; ?> </span> </div>
            </div>



            <?php } else{
                ?>
                    <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://d338t8kmirgyke.cloudfront.net/icons/icon_pngs/000/004/088/original/user.png " style="border-radius: 100%"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?php echo $arre_chat["men_chat_usu"]; ?></p>
                  <span class="time_date">  <?php echo $arre_chat["fec_men_usu"]; ?></span></div>
              </div>
            </div>
                <?php } ?>
                      
            <?php } ?>
            <!---------------------------------------------------------------------------->
  <input type="hidden" id="domi_cod" value="<?php echo $_POST["domiciliario_cod_dom"];?>">  
            <?php
                   $obj_chat_usu->puntero = $obj_chat_usu->listar_dom();
                      while (($arre_chat_dom = $obj_chat_usu->extraer_dato()) > 0) {
  
                      ?>    

                      <?php if ($arre_chat_dom["per_chat_tie"] == 'T'){
                            ?><div class="outgoing_msg">
              <div class="sent_msg">
                <p><?php echo $arre_chat_dom["men_chat_tie"]; ?></p>
               
                <span class="time_date"> <?php echo $arre_chat_dom["fec_chat_tie"]; ?> </span> </div>
            </div>



            <?php } else{
                ?>
                    <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="../../../../delivery/images/dom_tienda/<?php echo $arre_chat_dom["img_dom"]; ?>" style="border-radius: 100%"> </div>
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