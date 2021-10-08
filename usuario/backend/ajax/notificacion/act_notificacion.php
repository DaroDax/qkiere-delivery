<?php
session_start();
if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
  $(document).ready(function () {
    $("#notificacion").load('../../backend/ajax/notificacion/query_notificacion.php');
      setInterval(function() {
     $("#notificacion").load('../../backend/ajax/notificacion/query_notificacion.php');
  }, 2000); 
});
</script>

<div  id="notificacion"></div>


<?php 
 
}
else{
    header("location: ../../frontend/pages/menu.php");
    exit();

}
  ?>