<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
  $(document).ready(function () {
    $("#orden_compra").load('../../backend/ajax/query_orden_compra/query_orden_compra_pendiente.php');
    // setInterval(function() {
    // $("#orden_compra").load('../../backend/ajax/query_orden_compra/query_orden_compra_pendiente.php');
    //}, 3000); 
});
</script>

<div  id="orden_compra"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>