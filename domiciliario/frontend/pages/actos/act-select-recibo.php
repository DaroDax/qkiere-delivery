<?php

session_start();

if (isset($_SESSION["cod_usu"])) { ?>
  <script>
    $(document).ready(function() {
      $("#dir_select").load('./select-miubicacion.php');
    });
  </script>
  <div id="dir_select"></div>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>