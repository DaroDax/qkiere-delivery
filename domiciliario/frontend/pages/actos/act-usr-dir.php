<?php

session_start();

if (isset($_SESSION["cod_usu"])) { ?>
  <script>
    $(document).ready(function() {
      $("#dir_complete").load('./user_direccion.php');
      //setInterval(function() {
      //  $("#dir_complete").load('./user_direccion.php');
      //}, 2000);
    });
  </script>
  <div id="dir_complete"></div>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>