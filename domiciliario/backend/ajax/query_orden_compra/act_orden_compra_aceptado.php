<?php

session_start();

if (isset($_SESSION ["cod_dom"])){ ?>
  <script>
  $(document).ready(function () {
    $("#orden_compra_aceptado").load('../../backend/ajax/query_orden_compra/query_orden_compra_aceptado.php');
  setInterval(function() {
 
 $("#orden_compra_aceptado").load('../../backend/ajax/query_orden_compra/query_orden_compra_aceptado.php');
     }, 2000);
    });
</script>
  
  <div class="table-responsive" id="orden_compra_aceptado">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>