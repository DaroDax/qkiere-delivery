<?php

session_start();

if (isset($_SESSION ["cod_usu"])){



  ?>
  <script>
  $(document).ready(function () {
    $("#tablaMensajes").load('../../backend/ajax/query_inventario/query_tienda.php?id=<?php  $_GET["id"];?>');
    setInterval(function() {
      
            $("#tablaMensajes").load('../../backend/ajax/query_inventario/query_tienda.php?id=<?php  $_GET["id"];?>');
            
        
    }, 3000);
    
    
    
});
    
    

</script>
  
  <div class="table-responsive" id="tablaMensajes">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>