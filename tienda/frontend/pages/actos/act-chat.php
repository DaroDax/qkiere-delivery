<?php

session_start();

if (isset($_SESSION["cod_usu"])) { ?>
  <script>
    $(document).ready(function() {
      $("#chat_msj").load('./chat_ventana.php');
      //setInterval(function() {
      //  $("#chat_msj").load('./chat_ventana.php');
      //}, 2000);
    });
  </script>
  <div id="chat_msj"></div>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>