<?php

session_start();

if (isset($_SESSION ["cod_usu"])){ ?>
  <script>
  $(document).ready(function () {
    $("#SitioFavorito").load('../../backend/ajax/query_favorito/query_sitios_favoritos.php');
       setInterval(function() {
    $("#SitioFavorito").load('../../backend/ajax/query_favorito/query_sitios_favoritos.php');
   }, 3000); 
});
</script>

<div  id="SitioFavorito"></div>


<?php 
 
}
else{
    header("location: ../../index.php");
    exit();

}
  ?>