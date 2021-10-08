<?php
session_start();

if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;
}

?>

  <head>
    <link href="../css/buscador.css?1" rel="stylesheet">
    <link href="../css/tienda_producto.css?2" rel="stylesheet">
    <link href="../icons/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">


     <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!----Bootstrap important---->
    
    <script src="../../backend/ajax/funcion/cargas.js"></script>
    <script src="../../backend/ajax/funcion/buscar.js"></script>

    <script src="../../backend/ajax/funcion/favoritos.js"></script>

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
      <div class="buscador_content">

        <div class="buscador">
          <div class="browse-bar">
            <input type="text" class="item-browse" placeholder="¿Que buscas?" required id="consultar" onkeyup="busqueda(<?php echo $_GET['mun']; ?>);">
          </div>

        </div>

      </div>

      <div class="resultados">
        <div class="top_buttons">

          <a href="#" class="a-but" onclick="tiendas();">Tiendas</a>
          <a href="#" class="a-but" onclick="producto();">Productos</a>
          <a href="#" class="a-but" onclick="categoria();">Categoria</a>

        </div>

        <div class="result_forms" id="resultados">
          <div class="sitios-buscados"></div>
          <div class="productos-buscados"></div>
          <div class="categorias-buscadas"></div>
        </div>
      </div>

    </div>
    </div>

   
    <script src="../js/bootstrap.min.js"></script>
    <script src="./modals/idmodal.js"></script>

  </body>

  </html>
