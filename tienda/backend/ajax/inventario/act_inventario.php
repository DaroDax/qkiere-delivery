<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>

  $(document).ready(function () {
    $("#inventario").load('../../backend/ajax/inventario/inventario.php');
   setInterval(function() {
  $("#inventario").load('../../backend/ajax/inventario/inventario.php');
     }, 2000);
    });
</script>
  
  <div class="table-responsive" id="inventario">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>