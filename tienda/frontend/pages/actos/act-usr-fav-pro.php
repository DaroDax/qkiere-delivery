<?php

session_start();

if (isset($_SESSION["cod_usu"])) { ?>
  <script>
    $(document).ready(function() {
      $("#producto_fav").load('./producto-favorito.php');
      //setInterval(function() {
      //  $("#producto_fav").load('./producto-favorito.php');
      //}, 2000);
    });
  </script>
  <div id="producto_fav"></div>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>