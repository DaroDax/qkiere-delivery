<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>
    $(document).ready(function() {
      $("#domiciliario_tienda").load('./domiciliarios_resultado.php');
      setInterval(function() {
        $("#domiciliario_tienda").load('./domiciliarios_resultado.php');
      }, 2000);
    });
  </script>
<div  id="domiciliario_tienda"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>