<?php

session_start();

if (isset($_SESSION["cod_dom"])) { ?>
  <script>
    $(document).ready(function() {
      $("#nuevos").load('./menu-nuevos-ped.php');
      setInterval(function() {
        $("#nuevos").load('./menu-nuevos-ped.php');
      }, 2000);
    });
  </script>
  <div id="nuevos"></div>


<?php

} else {

}
?>