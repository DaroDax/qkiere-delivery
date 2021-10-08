<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>

  $(document).ready(function () {
    $("#Carrito_pedido").load('../../backend/ajax/query_cart/query_cart_pedido.php');
    setInterval(function() {
   $("#Carrito_pedido").load('../../backend/ajax/query_cart/query_cart_pedido.php');
    }, 2000); 
});
</script>

<div  id="Carrito_pedido"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>