<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
  $(document).ready(function () {
    $("#misDirecciones").load('../../backend/ajax/query_usuario/query_direcciones.php');
   //   setInterval(function() {
   //  $("#misDirecciones").load('../../backend/ajax/query_usuario/query_direcciones.php');
   //}, 3000); 
});
</script>

<div  id="misDirecciones"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>