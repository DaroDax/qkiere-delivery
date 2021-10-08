<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
    var id="<?php echo $_GET["id"]; ?>";

  $(document).ready(function () {
    $("#tablaMensajes").load('../../backend/ajax/query_inventario/query_tienda.php?id='+id);
    
    RecargaInv =  setInterval(function() {
    $("#tablaMensajes").load('../../backend/ajax/query_inventario/query_tienda.php?id='+id);
    }, 2000);   
    
    
});
</script>
<script> function stopInterval(){
            clearInterval(RecargaInv);
        }
    </script>

<div  id="tablaMensajes"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>