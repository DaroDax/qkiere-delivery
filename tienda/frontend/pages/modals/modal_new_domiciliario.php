<?php 
session_start();

if (isset($_SESSION ["cod_tie"])){
    require_once("../../../backend/clase/tienda.class.php");
    require_once("../../../backend/clase/inventario.class.php");
    require_once("../../../backend/clase/categoria_producto.class.php");
    require_once("../../../backend/clase/sector.class.php");  
    require_once("../../../backend/clase/municipio.class.php");

    $obj_municipio = new municipio;

 $obj_sector= new sector;
 $obj_sector->cod_mun=$_POST["cod_mun"];

 $obj_sector->asignar_valor();
   
    $obj_tienda = new tienda;
    $obj_tienda->puntero=$obj_tienda->consultar();
    $arre_tie=$obj_tienda->extraer_dato();
    
    $obj_categoria_producto=new categoria_producto;

    $obj_inventario = new inventario;
  
    $obj_inventario->cod_inv=$_POST['id'];
    $obj_inventario->asignar_valor();
    $obj_inventario->puntero=$obj_inventario->consultar_producto();
    $arre_inv=$obj_inventario->extraer_dato();
   
    $resultado = null;

   if (isset($_POST["formulario"]))
        {
           //echo "<script>alert('ENTRO 1')</script>";
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
   
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    function consultar_sector(){
      //alert($('#mun').val());
      mun = $('#mun').val();
      $("#sector").load("../../backend/ajax/query_direccion/sector_get.php?cod_mun="+mun);

/*$.ajax({
      type:"POST",
      url:"../../backend/ajax/query_direccion/sector_get.php",
      data:"cod_mun=" + $('#mun').val(),
      success:function(r){
        $('#sector').html(r);

          }
        });
*/
}
</script>

  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">¿Añadir Domiciliario?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
             
                <strong><?php echo $resultado; ?></strong>
                <img src="../../../../../delivery/images/dom_tienda/<?php echo $name?>" alt="">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="formul" enctype="multipart/form-data">
  Imagen Del Domiciliario: <input type="file" name="imagen" id="files">
  <input type="hidden" name="formulario">
  <!--<input type="submit" value="Subir" onclick="add_producto('<?php echo $arre_inv['cod_inv'];?>');">-->
</form>

                <strong>Nombre:</strong> <input type="text" name="nom_dom" id="nom_dom"  placeholder="Juan" class="form-control"value="<?php echo $arre_inv["can_inv"];  ?>">
             <strong>Apellido:</strong> <input type="text" name="ape_dom" id="ape_dom"  placeholder="Espinoza" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>">

              <strong>Cedula:</strong> <input type="text" name="ced_dom" id="ced_dom"  placeholder="Documento de identidad" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>">

              <strong>Telefono:</strong> <select name="cod_area_dom" id="cod_area_dom" class="form-control" >
                                                        <option value="58">+58</option> 
                                                        <option value="57">+57</option>    
                                                    </select> <input type="text" name="tel_dom" id="tel_dom"  placeholder="Telefono" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>"><br>

              <strong>Em@il:</strong> <input type="text" name="ema_dom" id="ema_dom"  placeholder="Em@il" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>"><br>

              <strong>Contraseña:</strong> <input type="password" name="pas_dom" id="pas_dom"  placeholder="*******" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>"><br>

              <strong>Ubicación:</strong> 
              <select name="municipio" id="mun" class="form-control" onchange="consultar_sector();">
        <option value="<?php echo  $arre_tienda["cod_mun"]; ?>"><?php echo  $arre_tienda["nom_mun"]; ?></option>
        <?php
        $obj_municipio->puntero = $obj_municipio->listar();
        while (($arre_municipio= $obj_municipio->extraer_dato()) > 0) {
        ?>
          <option value="<?php echo $arre_municipio["cod_mun"]; ?>"><?php echo $arre_municipio["nom_mun"]; ?></option>
        <?php } ?>
      </select>

      <div id="sector"></div>
            

                 
             
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary"  onclick="add_domiciliario('<?php echo $arre_deli['cod_dom'];  ?>');">Añadir Domiciliario</a>
          
          </div>
           <input type="hidden" value=" <?php echo $arre_deli["cod_dom"];  ?>" name="domicilio_cod_dom">
          <input type="hidden" value="<?php echo $arre_inv["cliente_cod_cli"];  ?>" name="cliente_cod_cli">
     </form>
    </div>
  </div>
       
  <?php   

}
else{
    header("location: ../index.php");
    exit();

}
?>


