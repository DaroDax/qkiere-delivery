<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
  $(document).ready(function () {
    $("#Productos_Favoritos").load('../../backend/ajax/query_favorito/query_producto_favorito.php');
     setInterval(function() {
    $("#Productos_Favoritos").load('../../backend/ajax/query_favorito/query_producto_favorito.php');
    }, 3000); 
});
</script>

<div  id="Productos_Favoritos"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>