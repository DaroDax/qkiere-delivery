<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>
    $(document).ready(function() {
      $("#aceptados").load('./menu-aceptados-ped.php');
      setInterval(function() {
        $("#aceptados").load('./menu-aceptados-ped.php');
      }, 2000);
    });
  </script>
<div  id="aceptados"></div>


<?php 
 
}
else{

}
  ?>