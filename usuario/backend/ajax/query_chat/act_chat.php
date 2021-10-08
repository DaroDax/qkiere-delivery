<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>

  <script>
  	 var id="<?php echo $_GET["id"]; ?>";

  $(document).ready(function () {
    $("#chat_tienda").load('../../backend/ajax/query_chat/chat.php');
  //    setInterval(function() {
  //   $("#chat_tienda").load('../../backend/ajax/query_chat/chat.php?tienda_cod_tie='+id);
  //}, 2000); 
});
</script>

<div  id="chat_tienda"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>