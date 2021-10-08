<?php
session_start();

require_once("../../backend/clase/tienda.class.pub.php");

$obj_tienda_pub = new tienda_pub;



if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;
} else {

?>

  <head>
    <link href="../css/inicio.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
        <script src="../../backend/ajax/funcion/jquery.js"></script>
  </head>

  <body>

    <script type="text/javascript">
      function actualizar() {
        location.reload(true);
      }
      //Función para actualizar cada 4 segundos(4000 milisegundos)
      //setInterval("actualizar()",2000);
    </script>

    <div class="main">
      <div class="inicio_content">
        <div class="feed">
          <h1>Tiendas Disponibles</h1>
          <h3>¡¡Abierto!!</h3>
          <hr>
        </div>
        <?php
        $obj_tienda_pub->cod_mun = $_POST["cod_mun"];
        $obj_tienda_pub->asignar_valor();
        $obj_tienda_pub->puntero = $obj_tienda_pub->mostrar();
        while (($arre_tienda = $obj_tienda_pub->extraer_dato()) > 0) {
        ?>
          <a href="#" class="link_tie" onclick="tienda(<?php echo $arre_tienda['cod_tie'];?>);">
            <div class="card">
              <div class="title-card">
                <h2 class="name-card"><?php echo $arre_tienda["raz_tie"]; ?></h2>

              </div>
              <div class="img-card">
                <img class="logo-card" src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
              </div>
              <div class="text-card">
                <h3 class="category-card"><?php echo $arre_tienda["nom_cat_tie"]; ?></h3>
                <i class="fas fa-bookmark"></i>

                <h5 class="horary-card"><i class="far fa-clock"></i> <?php echo $arre_tienda["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tienda["hor_sab_hor_tie"]; ?></h5>
                </h5>
              </div>
              <p class="sec_mun"><i class="fas fa-map-marker-alt"></i> <?php echo $arre_tienda["nom_sec"]; ?> - <?php echo $arre_tienda["nom_mun"]; ?></p>



            </div>
          </a>
        <?php } ?>
      </div>
    </div>

  </body>

  </html>
<?php } ?>