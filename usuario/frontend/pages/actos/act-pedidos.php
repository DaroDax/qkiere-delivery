<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
    $(document).ready(function() {
      $("#result_pedido").load('./mis_pedidos-resultado.php');
      setInterval(function() {
        $("#result_pedido").load('./mis_pedidos-resultado.php');
      }, 2000);
    });
  </script>
<div  id="result_pedido"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>