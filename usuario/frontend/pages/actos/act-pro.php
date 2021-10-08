<?php

session_start();

if (isset($_SESSION["cod_usu"])) { ?>
  <script>
    $(document).ready(function() {
      $("#productos").load('./producto.php');
      //setInterval(function() {
      //  $("#productos").load('./producto.php');
      //}, 2000);
    });
  </script>
  <div id="productos"></div>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>