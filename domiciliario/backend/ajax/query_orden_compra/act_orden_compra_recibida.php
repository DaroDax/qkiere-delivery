<?php

session_start();

if (isset($_SESSION ["cod_dom"])){ ?>
  <script>
  $(document).ready(function () {
    $("#orden_compra_recibida").load('../../backend/ajax/query_orden_compra/query_orden_compra_recibida.php');
  setInterval(function() {
 
 $("#orden_compra_recibida").load('../../backend/ajax/query_orden_compra/query_orden_compra_recibida.php');
     }, 2000);
    });
</script>
  
  <div class="table-responsive" id="orden_compra_recibida">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>