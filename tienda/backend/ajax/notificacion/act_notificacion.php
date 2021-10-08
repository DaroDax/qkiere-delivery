<?php

session_start();

if (isset($_SESSION ["cod_tie"])){ ?>
  <script>


  	
  $(document).ready(function () {
    $("#notificacion").load('../../backend/ajax/notificacion/query_notificacion.php');
      MiIntervalo = setInterval(function() {
     $("#notificacion").load('../../backend/ajax/notificacion/query_notificacion.php');
  }, 2000); 
});

    
</script>

<div  id="notificacion"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>