<?php
session_start();
//$_SESSION["cod_usu"];

if (isset($_SESSION["cod_tie"])) {

    require_once("../../backend/clase/municipio.class.php");
    require_once("../../backend/clase/horario_tienda.class.php");
    require_once("../../backend/clase/tienda.class.php");

    $obj_municipio = new municipio;
    $obj_horario_tienda=new horario_tienda;
    $obj_horario_tienda->puntero=$obj_horario_tienda->listar();
    $arre_horario=$obj_horario_tienda->extraer_dato();

    $obj_tienda = new tienda;
    $obj_tienda->puntero = $obj_tienda->consultar();
    $arre_tienda = $obj_tienda->extraer_dato();

    if (isset($_POST["formulario"]))
        {
          // echo "<script>alert('ENTRO 1')</script>";
         $nombre_archivo = $_FILES["imagen"]["name"];
          $nombre_tmp = $_FILES["imagen"]["tmp_name"];
          $tam = $_FILES["imagen"]["size"];
          $ruta_destino = "../../../img/log_tie/";
          $rutafinal = $ruta_destino.$nombre_archivo;
          header("location: menu.php");

          if ($nombre_archivo!=null) {
       //echo "<script>alert('ENTRO')</script>"; //validamos que la imagen exista
             if ($tam <= 18728640) { //validamos que el tamaño sea menor a 15MB
                  if (copy($nombre_tmp, $rutafinal)) { // Copiamos la Imagen
                      crop($nombre_tmp,500,500,$rutafinal); // Cortamos la imagen a tamaño 500x500 px
                      resizeToVariable($nombre_tmp,500,500,$rutafinal); // Redimensionamos la imagen a tamaño 500x500 px
                      header("location: menu.php");

                  }
              }
          }
}

?>

  <head>
    <link href="../css/tienda.css?5" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>
    <script src="../../backend/ajax/funcion/cuenta.js"></script>
    
  </head>

  <body>
    <div class="main">
      <div class="tienda_content">
        <div class="info_tienda">
          <div class="img_tienda">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="formul" enctype="multipart/form-data">
  <input type="file" name="imagen" id="ico" onchange="tomar_foto('<?php echo $arre_inv['cod_inv'];?>');">
  <input type="hidden" name="formulario">
  <!--<input type="submit" value="Subir" onclick="add_producto('<?php echo $arre_inv['cod_inv'];?>');">-->
</form>
            <img src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" name="log" style="width: 20%;">
          </div>
        </div>

        <div class="des_tienda">

          <div class="ci">
            <i class="far fa-id-card"></i>
            <select name="tip_doc_tie" class="form-control" id="tip_doct_tie" >
              <option value="<?php echo  $arre_tienda["tip_doc_tie"];?>" ><?php echo  $arre_tienda["tip_doc_tie"];?></option>
            </select>

            <input type="text" name="rif_tie" id="rif_tie" class="form-control" placeholder="RIF" value="<?php echo $arre_tienda["rif_tie"]; ?>">

          </div>
          <div class="name">
            <i class="fas fa-store"></i>
            <input type="text" name="raz_tie" id="raz_tie" class="form-control" placeholder="Nombre del Comercio" value="<?php echo  $arre_tienda["raz_tie"]; ?>">
          </div>
          <div class="dir_tie">
            <i class="fas fa-map-marked-alt"></i>
            <textarea name="dir_tie" id="dir_tie" cols="20" rows="5" class="form-control" placeholder="Dirección Fiscal"><?php echo  $arre_tienda["dir_tie"]; ?></textarea>
          </div>
          <div class="mun">
            <i class="fas fa-map-marker-alt"></i>
            <select name="municipio" id="mun" class="form-control" onchange="consultar_sector();">
        <option value="<?php echo  $arre_tienda["cod_mun"]; ?>"><?php echo  $arre_tienda["nom_mun"]; ?></option>
        <?php
        $obj_municipio->puntero = $obj_municipio->listar();
        while (($arre_municipio= $obj_municipio->extraer_dato()) > 0) {
        ?>
          <option value="<?php echo $arre_municipio["cod_mun"]; ?>"><?php echo $arre_municipio["nom_mun"]; ?></option>
        <?php } ?>
      </select>
          </div>
          <div class="sec">
            <div id="sector"></div>
          </div>
          <div class="fijo">
            <i class="fas fa-phone-square-alt"></i>

            <input type="text" placeholder ="Telefono Fijo" name="tel2_tie" id="tel2_tie" class="form-control" value="<?php echo  $arre_tienda["tel2_tie"]; ?>">
          </div>
          <div class="tel">
            <i class="fas fa-mobile-alt"></i>
            <select class="form-control">
              <option>+58</option>
              <option>+57</option>
            </select>

            <input type="text" placeholder="Telefono" name="tel_tie" id="tel_tie" class="form-control" value="<?php echo  $arre_tienda["tel_tie"]; ?>">
          </div>
          <div class="ema">
            <i class="far fa-envelope"></i>
            <input type="text" name="ema_tie" class="form-control" placeholder="Correo Electrónico" id="ema_tie" value="<?php echo  $arre_tienda["ema_tie"]; ?>">
          </div>
          <div class="telegram">
            <i class="fab fa-telegram" onclick="notificacion_confir();"></i>
            <input type="text" name="cha_id_tie"  placeholder="Chat ID Telegram" id="cha_id_tie" class="form-control" value="<?php echo  $arre_tienda["cha_id_tie"]; ?>" onchange="insertar_chat();">
          </div>

        </div>
<?php if ($arre_horario["tienda_cod_tie"]>0){ ?>
        <div class="hour_date">
          <div class="open_hour"><h4>De:</h4><input type="time" id="hor_lun_vie_hor_tie" name="hor_lun_vie_hor_tie" value="<?php echo  $arre_horario["hor_lun_vie_hor_tie"]; ?>" required onchange="tomar_hora();"></div>
          <div class="close_hour"><h4>A:</h4><input type="time" id="appt" name="appt" value="<?php echo  $arre_horario["hor_sab_hor_tie"]; ?>" required onchange="tomar_hora();"></div>
        </div>

        <?php if ($arre_horario["lun_hor_tie"] == 1 ){ 
                  $lunes = "checked"; 
              }

                if ($arre_horario["mar_hor_tie"] == 1 ) {
                  $martes = "checked";
                }

                if ($arre_horario["mie_hor_tie"] == 1 ) {
                   $miercoles = "checked";
                }

                if ($arre_horario["jue_hor_tie"] == 1 ) {
                  $jueves = "checked";
                }

                if ($arre_horario["vie_hor_tie"] == 1 ) {
                  $viernes = "checked";
                }

                if ($arre_horario["sab_hor_tie"] == 1 ) {
                  $sabado = "checked";
                }

                if ($arre_horario["dom_hor_tie"] == 1 ) {
                  $domingo = "checked";
                }

                ?>

        <div class="check_days">
          <div class="L"><b>Lunes</b><input type="checkbox" name="lun_hor_tie" id="lun_hor_tie" value="<?php echo  $arre_horario["lun_hor_tie"]; ?>" <?php echo  $lunes; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["lun_hor_tie"]?>, 1 );"></div>
          <div class="M"><b>Martes</b><input type="checkbox" name="mar_hor_tie" id="mar_hor_tie" value="<?php echo  $arre_horario["mar_hor_tie"]; ?>" <?php echo  $martes; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["mar_hor_tie"]?>, 2 );"></div>
          <div class="MI"><b>Miercoles</b><input type="checkbox" name="mie_hor_tie" id="mie_hor_tie" value="<?php echo  $arre_horario["mie_hor_tie"]; ?>" <?php echo  $miercoles; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["mie_hor_tie"]?>, 3 );"></div>
          <div class="J"><b>Jueves</b><input type="checkbox" name="jue_hor_tie" id="jue_hor_tie" value="<?php echo  $arre_horario["jue_hor_tie"]; ?>" <?php echo  $jueves; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["jue_hor_tie"]?>, 4 );"> </div>
          <div class="V"><b>Viernes</b><input type="checkbox" name="vie_hor_tie" id="vie_hor_tie" value="<?php echo  $arre_horario["vie_hor_tie"]; ?>" <?php echo  $viernes; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["vie_hor_tie"]?>, 5 );"></div>
          <div class="S"><b>Sabado</b><input type="checkbox" name="sab_hor_tie" id="sab_hor_tie" value="<?php echo  $arre_horario["sab_hor_tie"]; ?>" <?php echo  $sabado; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["sab_hor_tie"]?>, 6 );"></div>
          <div class="D"><b>Domingo</b><input type="checkbox" name="dom_hor_tie" id="dom_hor_tie" value="<?php echo  $arre_horario["dom_hor_tie"]; ?>" <?php echo  $domingo; ?> onclick="actualizar_dia(<?php echo $arre_horario["tienda_cod_tie"]?>,<?php echo $arre_horario["dom_hor_tie"]?>, 7 );"></div>
        </div>
        <?php }
  else {
    echo "<div class='act-hor'><h4><b>Debes activar los horarios<b></h4>";
    ?>
    <button class="btn btn-warning" onclick="insertar_horario();" name="hora">Activar Horario</button></div>
    <?php
  } ?>

          <div class="tie_opt">
            <button class="btn btn-primary" onclick="cambiar_clave();">Cambiar Clave</button>
    <button class="btn btn-success" onclick="actualizar_tienda();">Actualizar</button>
          </div>
      </div>
    </div>

  </body>

  </html>
<?php } ?>