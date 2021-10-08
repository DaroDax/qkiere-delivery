<?php 
session_start();

if (isset($_SESSION ["cod_tie"])){
    require_once("../../../backend/clase/delivery.class.php");
   
  
   
    $obj_domicilio = new domicilio;

    $obj_domicilio->cod_dom=$_POST['id'];
    $obj_domicilio->asignar_valor();
    $obj_domicilio->puntero=$obj_domicilio->ver_domici();
    $arre_domi=$obj_domicilio->extraer_dato();

    $resultado = null;

  if (isset($_POST["formulario"]))
        {
           echo "<script>alert('ENTRO 1')</script>";
         $nombre_archivo = $_FILES["imagen"]["name"];
          $nombre_tmp = $_FILES["imagen"]["tmp_name"];
          $tam = $_FILES["imagen"]["size"];
          $ruta_destino = "../../../../img/dom_tie/";
          $rutafinal = $ruta_destino.$nombre_archivo;
          header("location: ../menu.php");

          if ($nombre_archivo!=null) {
       //echo "<script>alert('ENTRO')</script>"; //validamos que la imagen exista
             if ($tam <= 18728640) { //validamos que el tamaño sea menor a 15MB
                  if (copy($nombre_tmp, $rutafinal)) { // Copiamos la Imagen
                      crop($nombre_tmp,500,500,$rutafinal); // Cortamos la imagen a tamaño 500x500 px
                      resizeToVariable($nombre_tmp,500,500,$rutafinal); // Redimensionamos la imagen a tamaño 500x500 px
                         header("location: ../menu.php");
                  }
              }
          }
    }



    ?>



  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Domiciliario #<?php echo $arre_domi["cod_dom"];?></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
<h4><strong>Datos.</strong></h4><?php echo $arre_deli['cod_dom']?>
                <div class="informacion">
                  <label for="">
              <strong>Foto Adjunta:</strong><br> 
              </label>
              <div class="photo" style="width: 25%; height:150px; border:1px solid #ccc; border-radius: 10px;">
                <img src="../../../img/dom_tie/<?php echo $arre_domi["img_dom"];?>" class="img-responsive" />


                
              </div>
              <strong><?php echo $resultado; ?></strong>
                <img src="../../../../img/dom_tie/<?php echo $name?>" alt="">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="formul" enctype="multipart/form-data">
  <strong>Imagen Del Domiciliario:</strong> <input type="file" name="imagen" id="file">
  <input type="hidden" name="formulario">
    <input type="hidden" name="photo" id="con_img" value="<?php echo $arre_domi["img_dom"];?>">
  <!--<input type="submit" value="Subir" onclick="add_producto('<?php echo $arre_inv['cod_inv'];?>');">-->
</form>
            
            <label for="" class="edits">
              <strong>Nombre:</strong><br>
            <input type="text" value="<?php echo $arre_domi["nom_dom"];?>" class="edits" id="name_dom">
              </label>
              <br>
              <label for="" class="edits">
              <strong>Apellido:</strong><br>
            <input type="text" value="<?php echo $arre_domi["ape_dom"];?>" class="edits" id="apel_dom">
              </label>
              <br>
              <label for="" class="edits">
              <strong>Cedula:</strong><br>
            <input type="text" value="<?php echo $arre_domi["ced_dom"];?>" class="edits" id="cedu_dom"> 
              </label>
              <br>
              <label for="" class="edits">
              <strong>Telefono:</strong><br>
            <input type="text" value="<?php echo $arre_domi["tel_dom"];?>" class="edits" id="tele_dom">
              </label>
              <br>
              <label for="" class="edits">
              <strong>Em@il:</strong><br>
            <input type="text" value="<?php echo $arre_domi["ema_dom"]?>" class="edits" id="email_dom">
              </label>
              <br>
              <label for="" class="edits">
              <strong>Direccion:</strong><br>
             <textarea value="<?php echo $arre_domi["dir_dom"]?>" class="edits" id="dire_dom"></textarea>

             <input type="hidden" id="dir_dom" value="<?php echo $arre_domi["dir_dom"]?>">
              </label>
              <br>

              <label for="" class="edits">
              <strong>Chat ID:</strong><br>
            <input type="text" value="<?php echo $arre_domi["chat_id_dom"]?>" class="edits" id="chat_id">
              </label>
              </div>

              

              <div class="modal-body">
               
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="actualizar_dom('<?php echo $arre_domi["cod_dom"];?>');">Actualizar Info</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

    </div>
  </div>
       
  <?php   

}
else{
    header("location: ../index.php");
    exit();

}
?>


