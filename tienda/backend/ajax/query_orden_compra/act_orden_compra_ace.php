<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>
  $(document).ready(function () {
    $("#orden_compra_aceptada").load('../../backend/ajax/query_orden_compra/query_orden_aceptada.php');
  setInterval(function() {
 
 $("#orden_compra_pendiente").load('../../backend/ajax/query_orden_compra/query_orden_aceptada.php');
     }, 2000);
    });
</script>
  
  <div class="table-responsive" id="orden_compra_aceptada">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>