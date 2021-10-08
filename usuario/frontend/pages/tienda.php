<?php

//$_SESSION["cod_usu"];
require_once("../../backend/clase/tienda.class.pub.php");
require_once("../../backend/clase/inventario.pub.class.php");
require_once("../../backend/clase/horario.class.php");

    $obj_horario = new horario;
    $obj_horario->tienda_cod_tie = $_GET["cod_tie"];
    $obj_horario->asignar_valor();
    $obj_horario->puntero = $obj_horario->listar();
    $arre_hora = $obj_horario->extraer_dato();

$obj_tienda_pub = new tienda_pub;
$obj_tienda_pub->cod_tie = $_GET["cod_tie"];
$obj_tienda_pub->cod_tie = $_POST["cod_cat_pro"];
$obj_tienda_pub->asignar_valor();
$obj_tienda_pub->puntero = $obj_tienda_pub->tienda();
$arre_tienda = $obj_tienda_pub->extraer_dato();

$obj_inventario_pub = new inventario_pub;
session_start();
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/sitio_favorito.class.php");
  $obj_usuario = new usuario;

    $obj_sitio_fav = new sitio_favorito;
    $obj_sitio_fav->cod_tie = $_GET["id"];
    $obj_sitio_fav->asignar_valor();
    $obj_sitio_fav->puntero = $obj_sitio_fav->consultar();
    $arre_sitio_f = $obj_sitio_fav->extraer_dato();
    $checked = ($arre_sitio_f["cod_tie"] != "") ? "checked" : "";
} 

?>

  <head>
    <link href="../css/tienda.css?2" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>

    
  </head>

  <body>
    <script type="text/javascript">
      function actualizar() {
        location.reload(true);
      }
      //Función para actualizar cada 4 segundos(4000 milisegundos)
      //setInterval("actualizar()",2000);

      /*function recar(){
      cod_cat_pro = $("#cat_pro").val();
      cod_tie = "<?php echo $_POST["cod_tie"];?>";
        $.ajax({
      type:"POST",
      url:"../../../usuario/frontend/pages/tienda-inventario.php",
      data:"cod_cat_pro="+cod_cat_pro+"&&cod_tie="+cod_tie,
      success:function(r){
                $('.inv_list').html(r);
                setInterval(recar(),20000);        
            }
        });
      }

      window.onload= recar();*/
    </script>



    <div class="main">
      <div class="tienda_content">
        <div class="feed">
          <div class="tienda-name">
            <div><img src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="" class="img_log"></div>
            <div><h1 class="tienda_name"><?php echo $arre_tienda["raz_tie"]; ?></h1></div>
            <div class="book"><input type="hidden" value="<?php echo $arre_tienda["cod_tie"]; ?>" id="codigo">
          <?php   if(isset($_SESSION["cod_usu"])){ ?>

                                            <?php
                                            if ($arre_sitio_f["tienda_cod_tie"] > 0) {
                                                $color = '#F4D03F';
                                            } else {
                                                $color = '#000000';
                                            }
                                            ?>

              <input type="checkbox" <?php echo $checked; ?> value="<?php echo $_GET['id']; ?>" id="cod_tie_fav" onclick="add_sitios_favoritos('<?php echo $arre_tienda['raz_tie']; ?>','<?php echo $arre_tienda['cod_tie']; ?>');" /> <i class="fas fa-bookmark"  id="des_bot" style="color: <?php echo $color;?> "></i>
          <?php } ?></div>
          </div>

          <div class="tienda-info">
            <h5><i class="far fa-clock"></i> <?php echo $arre_tienda["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tienda["hor_sab_hor_tie"]; ?></h5>
                                                                        <?php
                                                                        if($arre_hora["lun_hor_tie"]=='1'){
                                                                        $letterL = "#27AE60 ";
                                                                        $sizeL = "bold";
                                                                        }else{
                                                                          $letterL = "#C0392B";
                                                                          $sizeL = "300";
                                                                        }  
                                                                        if($arre_hora["mar_hor_tie"]=='1'){
                                                                        $letterM = "#27AE60";
                                                                        $sizeM = "bold";
                                                                        }else{
                                                                          $letterM = "#C0392B";
                                                                          $sizeM = "300";
                                                                        }  
                                                                        if($arre_hora["mie_hor_tie"]=='1'){
                                                                            $letterMI = "#27AE60";
                                                                            $sizeMI = "bold";
                                                                        }else{
                                                                          $letterMI = "#C0392B";
                                                                          $sizeMI = "300";
                                                                        }  
                                                                        if($arre_hora["jue_hor_tie"]=='1'){
                                                                                $letterJ = "#27AE60";
                                                                                $sizeJ = "bold";
                                                                        }   else{
                                                                          $letterJ = "#C0392B";
                                                                          $sizeJ = "300";
                                                                        }  
                                                                        if($arre_hora["vie_hor_tie"]=='1'){
                                                                                $letterV = "#27AE60";
                                                                                $sizeV = "bold";
                                                                        }  else{
                                                                          $letterV = "#C0392B";
                                                                          $sizeV = "300";
                                                                        }     
                                                                        if($arre_hora["sab_hor_tie"]=='1'){
                                                                                    $letterS = "#27AE60";
                                                                                    $sizeS = "bold";
                                                                        }    else{
                                                                          $letterS = "#C0392B";
                                                                          $sizeS = "300";
                                                                        }    
                                                                        if($arre_hora["dom_hor_tie"]=='1'){
                                                                                $letterD = "#27AE60";
                                                                                $sizeD = "bold";
                                                                        } else{
                                                                          $letterD = "#C0392B";
                                                                          $sizeD = "300";
                                                                        }                                                             
                                                                        ?>

           <div class="dias_semana">                  <i class="far fa-calendar-alt"></i> 
                                                      <h5 style="color: <?php echo $letterL ?>; font-weight:<?php echo $sizeL?>;">L </h5>
                                                      <h5 style="color: <?php echo $letterM ?>; font-weight:<?php echo $sizeM?>;"> M </h5>
                                                      <h5 style="color: <?php echo $letterMI ?>; font-weight:<?php echo $sizeMI?>;"> MI </h5>
                                                      <h5 style="color: <?php echo $letterJ ?>; font-weight:<?php echo $sizeJ?>;"> J </h5>
                                                      <h5 style="color: <?php echo $letterV ?>; font-weight:<?php echo $sizeV?>;"> V </h5>
                                                      <h5 style="color: <?php echo $letterS ?>; font-weight:<?php echo $sizeS?>;"> S </h5>
                                                      <h5 style="color: <?php echo $letterD ?>; font-weight:<?php echo $sizeD?>;"> D </h5>
                                                    </div>     
            <h4 class="dir-tie"><i class="fas fa-location-arrow"></i> - <?php echo $arre_tienda["dir_tie"]; ?></h4>
          </div>

          <div class="inv_cat">
            <select name="categoria" id="cat_pro" onchange="cam_cat(<?php echo $_GET['cod_tie'];?>);">
              <option value="">--Todo--</option>
              <?php $obj_tienda_pub->puntero = $obj_tienda_pub->cat_producto();
              while (($arre_cat_pro = $obj_tienda_pub->extraer_dato()) > 0) {
              ?>
                <option value="<?php echo $arre_cat_pro["cod_cat_pro"]; ?>"><?php echo $arre_cat_pro["nom_cat_pro"]; ?></option>

              <?php } ?>


            </select>
          </div>
          <hr>
          <div class="inv_list">

            <?php $obj_tienda_pub->puntero = $obj_tienda_pub->inventario_tienda();
            while (($arre_inv = $obj_tienda_pub->extraer_dato()) > 0) {
            ?>

              <a href="#" onclick="producto(<?php echo $arre_inv['cod_inv']; ?>);" class="a_pro">
                <div class="img-card">
                  <img src="../../../img/inv_tie/<?php echo $arre_inv["img_inv"]; ?>" alt="">
                </div>
              </a>
            <?php } ?>

          </div>
        </div>

      </div>
    </div>

 
  </body>

  </html>
<?php //} ?>