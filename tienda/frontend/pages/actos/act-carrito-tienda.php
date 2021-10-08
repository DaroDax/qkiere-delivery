<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
    $(document).ready(function() {
      $("#carrito_tienda").load('./carrito-tienda.php');
      setInterval(function() {
        $("#carrito_tienda").load('./carrito-tienda.php');
      }, 2000);
    });
  </script>
<div  id="carrito_tienda"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>