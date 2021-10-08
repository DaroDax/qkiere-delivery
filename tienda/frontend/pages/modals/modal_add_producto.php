<?php 
session_start();

if (isset($_SESSION ["cod_tie"])){
    require_once("../../../backend/clase/tienda.class.php");
    require_once("../../../backend/clase/inventario.class.php");
    require_once("../../../backend/clase/categoria_producto.class.php");
    require("../funcion_foto/utilidades.php");
   
    $obj_tienda = new tienda;
    $obj_tienda->puntero=$obj_tienda->consultar();
    $arre_tie=$obj_tienda->extraer_dato();
    
    $obj_categoria_producto=new categoria_producto;

    $obj_inventario = new inventario;

    $resultado = null;
       
   if (isset($_POST["formulario"]))
        {
           //echo "<script>alert('ENTRO 1')</script>";
         $nombre_archivo = $_FILES["imagen"]["name"];
          $nombre_tmp = $_FILES["imagen"]["tmp_name"];
          $tam = $_FILES["imagen"]["size"];
          $ruta_destino = "../../../../img/inv_tie/";
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
    }else{
      ?>
      <div class="hide_msj" style="display:none;">

      <div><h2 style="text-align:center; font-family: 'Roboto', sans-serif;">Imagen Muy Pesada</h2>
        <h4 style="text-align:center; font-family: 'Montserrat', sans-serif; font-weight: 500;">Redireccionando a la pagina de vuelta...</h4></div>
        <div style="text-align: center;"><img src="./loader.gif" alt=""></div>

        </div>
        <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
        <script>
          
          window.onload = function() {
            $(".hide_msj").show();
            $(".modal-content").hide();
            setTimeout(regresar(),20000);
          }

          function regresar() {
            //alert("llama a la funcion");
          location.href="../menu.php"
          }
        </script>
      <?php
    }

  
    ?>

  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title">
              <h3 class="modal-title" id="exampleModalLabel">¿Añadir Producto?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            </div>
          </div>

          <div class="modal-body">          
            <div class="agg-img">
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="formul" enctype="multipart/form-data">
                Subir Imagen: <input type="file" name="imagen" id="files">
                <input type="hidden" name="formulario">
                <!--<input type="submit" value="Subir" onclick="add_producto('<?php //echo $arre_inv['cod_inv'];?>');">-->
              </form>
            </div>

            <div class="info-pro">

            <div class="new_can">
              <strong>Cantidad:</strong> 
              <input type="text" name="can_inv" id="can_inv"  placeholder="Cantidad del Producto" class="form-control"value="<?php echo $arre_inv["can_inv"];  ?>">
            <div class="new_nom">
              <strong>Nombre:</strong>
              <input type="text" name="nom_inv" id="nom_inv"  placeholder="Nombre del Producto" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>">
            </div>
            <div class="new_des">
              <strong>Descripción:</strong> 
              <textarea class="form-control"  id="des_inv" name="des_inv" placeholder="Descripción del Producto"><?php echo $arre_inv["des_inv"];  ?></textarea>
            
            <div class="new_cat">
              <strong>Categoria:</strong> 
                  <select name="cod_cat_pro" id="cod_cat_pro" class="form-control" >
                    <option value="<?php echo $arre_inv["cod_cat_pro"];  ?>"><?php echo $arre_inv["nom_cat_pro"];  ?></option>
                    <?php 
                    $obj_categoria_producto->cod_cat_tie= $arre_tie["categoria_tienda_cod_cat_tie"];
                    $obj_categoria_producto->asignar_valor();
                    $obj_categoria_producto->puntero=$obj_categoria_producto->listar();
                    while(( $arre_cat=$obj_categoria_producto->extraer_dato())>0){
                    ?>
                      <option value="<?php echo $arre_cat['cod_cat_pro']; ?>"><?php echo $arre_cat["nom_cat_pro"]; ?></option>
                  <?php } ?>
                  </select>
            </div>
            <div class="new_pre">
              <strong> Precio:</strong> 
                 <input type="text" name="pre_inv" id="pre_inv" value="<?php echo $arre_inv["pre_inv"];  ?>" class="form-control" placeholder="Sin puntos ni comas">
            </div>

            </div>



          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <a class="btn btn-primary"  onclick="add_producto('<?php echo $arre_inv['cod_inv'];  ?>');">Añadir Producto</a>
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


