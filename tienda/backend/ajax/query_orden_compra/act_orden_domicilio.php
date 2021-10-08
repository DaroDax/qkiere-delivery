<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>
  $(document).ready(function () {
    $("#orden_compra_domicilio").load('../../backend/ajax/query_orden_compra/query_orden_domicilio.php');
   setInterval(function() {
   
  $("#orden_compra_domicilio").load('../../backend/ajax/query_orden_compra/query_orden_domicilio.php');
      }, 2000);
    });
</script>
  
  <div class="table-responsive" id="orden_compra_domicilio">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>