<?php 
session_start();

if (isset($_SESSION ["cod_usu"])){

    require_once("../../../backend/clase/orden_compra.class.php");

    $obj_orden_compra =new orden_compra;
  
    $obj_orden_compra->domiciliario_cod_dom=$_POST['id'];
    $obj_orden_compra->asignar_valor();

    $obj_orden_compra->puntero=$obj_orden_compra->mostrar_domi();
              $arreglo_dom=$obj_orden_compra->extraer_dato();
 

    ?>

  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Informacion sobre tu Domiciliario</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
          
             <div class="left_table">

                <img src="../../../img/dom_tie/<?php echo $arreglo_dom['img_dom'];?>" style="width: 100%;" id="dom" alt="">
                <div class="dom_info">
                <div class ="dom_id">
            <label for="">ID:
              <h3><?php echo $arreglo_dom["cod_dom"];?> &nbsp;&nbsp;  </h3>
            </label>
          </div>


            <div class ="dom_nom">
            <label for="">Nombre:
              <h3><?php echo $arreglo_dom["nom_dom"]." ". $arreglo_dom["ape_dom"];?> &nbsp;&nbsp;</h3>
            </label>
          </div>
          
          <div class ="dom_tel">
            <label for="">Telefono:
              <h3><a href="https://wa.me/+<?php echo $arreglo_dom["tel_dom"];?>"><?php echo $arreglo_dom["tel_dom"];?></a></h3>
            </label>
          </div>
          </div>
         
            </div>
          <div class="modal-footer">

           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          
          
          </div>
     </form>
    </div>
  </div>
       
         <script src="../js/mask/package.js" defer></script>
  <script>

  </script>

  <?php   

}
else{
    header("location: ../index.php");
    exit();

}
?>