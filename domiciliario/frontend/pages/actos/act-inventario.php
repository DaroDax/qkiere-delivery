<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>
    $(document).ready(function() {
      $("#inventario_tienda").load('./inventario_resultado.php');
      setInterval(function() {
        $("#inventario_tienda").load('./inventario_resultado.php');
      }, 2000);
    });
  </script>
<div  id="inventario_tienda"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>