<?php

session_start();

if (isset($_SESSION["cod_tie"])) {

  require_once("../../clase/orden_compra.class.php");

  $obj_orden_compra3 = new orden_compra;





?>

 
       

<!--<h4>Lista de Ordenes Aceptadas <button onclick="noti_orden_compra();">noti</button> </h4>-->
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary">
          <th>Orden #</th>
          <th>Cliente</th>
          <th>Direcciòn</th>
          <th>Domiciliario</th>
          <th>Estatus</th>
          
          <th>Opciòn</th>
        </tr>
      </thead>
      <tbody> 
           

        <?php
  $obj_orden_compra3->puntero = $obj_orden_compra3->consultar_orden_aceptada_domiciliario();
        while (($arreglo = $obj_orden_compra3->extraer_dato()) > 0) { ?>

          
     
          
<?php
              
           if($arreglo["estatu_pedido_cod_est_ped"] == 3){
           
    
            ?>




          <tr id="fil_<?php echo $arreglo["cod_ord_com"]; ?>" class="search">
            <input type="hidden" id="fila_<?php echo $arreglo["cod_ord_com"]; ?>" value="<?php echo $arreglo["cod_ord_com"]; ?>">
            <td>#<?php echo $arreglo["cod_ord_com"]; ?></td>

            <!------>
            <!------>
            <td><?php echo $arreglo["nom_usu"]; ?></td>
            <td><?php echo $arreglo["nom_sec"]; ?></td>
            <td><?php echo $arreglo["nom_dom"]; ?></td>
            <td><?php echo $arreglo["nom_est_ped"]; ?></td>
            <td>
              <div class="btn-group">
                
                <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_confirmar_orden.php');" class="btn btn-success tip-bottom">Confirmar <i class="fas fa-qrcode"></i></a>
              </div>
            </td>
          </tr>

        
<?php }else{ echo "<h4>No hay ordenes aceptadas<h4>";} ?>
          <script type="text/javascript">
            //    noti_orden_compra('<?php //echo $arreglo["cod_ord_com"]; 
                                      ?>','<?php //echo $arreglo["nom_usu"]; 
                                            ?>');
          </script>
        <?php } ?>


          
      </tbody>
    </table>
  




</div>

<?php  //F



} else {
  header("location: ../index.php");
  exit();
}
?>