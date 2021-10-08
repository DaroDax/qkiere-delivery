<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
  $(document).ready(function () {
    $("#cart_tienda").load('../../backend/ajax/query_cart/query_cart_tienda.php');
      setInterval(function() {
     $("#cart_tienda").load('../../backend/ajax/query_cart/query_cart_tienda.php');
  }, 2000); 
});
</script>

<div  id="cart_tienda"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>