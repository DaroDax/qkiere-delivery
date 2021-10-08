<?php
session_start();

if (isset($_SESSION["cod_tie"])) {

?>

  <head>
    <link href="../css/inicio.css" rel="stylesheet">
    <link href="../css/inventario.css?2" rel="stylesheet">
    <link href="../css/onoff.css?2" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <script src="../../backend/ajax/funcion/domicilio.js"></script>
  </head>

  <body>
    <div class="modal " id="ver_domi" role="dialog"></div>

    <div class="main">
      <div class="pedidos_content">
        <?php require("./actos/act-domiciliario.php"); ?>
      </div>
    </div>

  </body>

  </html>
<?php
} else {
} ?>