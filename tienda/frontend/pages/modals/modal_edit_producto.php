<?php 
session_start();

if (isset($_SESSION ["cod_tie"])){
    require_once("../../../backend/clase/tienda.class.php");
    require_once("../../../backend/clase/inventario.class.php");
    require_once("../../../backend/clase/categoria_producto.class.php");
    //require("../funcion_foto/utilidades.php");
   
    $obj_tienda = new tienda;
    $obj_tienda->puntero=$obj_tienda->consultar();
    $arre_tie=$obj_tienda->extraer_dato();
    
    $obj_categoria_producto=new categoria_producto;

    $obj_inventario = new inventario;
  
    $obj_inventario->cod_inv=$_POST['id'];
    $obj_inventario->asignar_valor();
    $obj_inventario->puntero=$obj_inventario->consultar_producto();
    $arre_inv=$obj_inventario->extraer_dato();

     if (isset($_POST["formulario"]))
        {
           echo "<script>alert('ENTRO 1')</script>";
         $nombre_archivo = $_FILES["imagen"]["name"];
          $nombre_tmp = $_FILES["imagen"]["tmp_name"];
          $tam = $_FILES["imagen"]["size"];
          $ruta_destino = "../../../../img/inv_tie/";
          $rutafinal = $ruta_destino.$nombre_archivo;
          header("location: ../menu.php");

          if ($nombre_archivo!=null) {
       echo "<script>alert('ENTRO')</script>"; //validamos que la imagen exista
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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">¿Editar Producto?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
                
                <img src="../../../img/inv_tie/<?php echo $arre_inv["img_inv"];  ?>" class="img-responsive img-thumbnail"  >
                <strong>Imagen:</strong> 
                  <strong><?php echo $resultado; ?> Inferiores a 20MB</strong>
                <img src="../../../img/inv_tie/<?php echo $name?>" alt="">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="formul" enctype="multipart/form-data">
  Subir Imagen: <input type="file" name="imagen" id="file">
  <input type="hidden" name="formulario">

  <input type="hidden" name="photo" id="cons_img" value="<?php echo $arre_inv["img_inv"];?>">

                <strong>Cantidad:</strong> <input type="text" name="can_inv" id="can_inv"  placeholder="Nombre del Producto" class="form-control"value="<?php echo $arre_inv["can_inv"];  ?>">
             <strong>Nombre:</strong> <input type="text" name="nom_inv" id="nom_inv"  placeholder="Nombre del Producto" class="form-control"value="<?php echo $arre_inv["nom_inv"];  ?>"><br>
            <strong>Descripción:</strong> 
                <textarea class="form-control"  id="des_inv" name="des_inv" placeholder="Descripción del Producto"><?php echo $arre_inv["des_inv"];  ?></textarea>

               
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
                 <strong> Precio:</strong> 
                 <input type="text" name="pre_inv" id="pre_inv" value="<?php echo $arre_inv["pre_inv"];  ?>" class="form-control"  >

                 <strong style="display:inline-block;">Tiempo estimado: </strong> <p style="color:#6BB2ED;display:inline-block;">(Horas y Minutos)</p>
                 <input type="time" name="tie_inv" id="tie_inv" value="<?php echo $arre_inv["tie_inv"];  ?>" class="form-control" placeholder="Tiempo estimado de preparacion">

                 
             
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary"  onclick="edit_producto('<?php echo $arre_inv['cod_inv'];  ?>');">Editar Producto</a>
          
          </div>
           <input type="hidden" value=" <?php echo $arre_inv["cod_inv"];  ?>" name="inventario_cod_inv">
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


