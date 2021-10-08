<?php

session_start();

if (isset($_SESSION["cod_usu"])) { ?>
  <script>
    $(document).ready(function() {
      $("#tienda-fav").load('./tienda-favorita.php');
      //setInterval(function() {
      //  $("#tienda-fav").load('./tienda-favorita.php');
      //}, 2000);
    });
  </script>
  <div id="tienda-fav"></div>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>