<?php

session_start();

if (isset($_SESSION["cod_dom"])) {

  require_once("../../clase/orden_compra.class.php");

  $obj_orden_compra2 = new orden_compra;

?>

 

    <!--<h4>Lista de Ordenes Pendientes <button onclick="noti_orden_compra();">noti</button> </h4>-->
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary">
          <th>Orden #</th>
          <th>Tienda</th>
          <th>Direcciòn</th>
          <th>Fecha</th>
          <th>Opciòn</th>
        </tr>
      </thead>
      <tbody> 
            
        <?php
  $obj_orden_compra2->puntero = $obj_orden_compra2->orden_compra_aceptada();
        while (($arreglo2 = $obj_orden_compra2->extraer_dato()) > 0) { ?>
          <tr id="fil_<?php echo $arreglo2["cod_ord_com"]; ?>" class="search">
            <input type="hidden" id="fila_<?php echo $arreglo2["cod_ord_com"]; ?>" value="<?php echo $arreglo2["cod_ord_com"]; ?>">
            <td>#<?php echo $arreglo2["cod_ord_com"]; ?></td>
          
            <!------>
            <!------>
            <td><?php echo $arreglo2["raz_tie"]; ?></td>
            <td><?php echo $arreglo2["dir_tie"]; ?></td>
            <td><?php echo $arreglo2["fec_ord_ped"]; ?></td>
            <td>
             
                <a href="javascript:void(0);" data-toggle="modal" data-target="#recibir_orden_compra" class="btn btn-primary" onclick="carga_ajax('<?php echo $arreglo2['cod_ord_com']; ?>','recibir_orden_compra','modals/modal_rec_orden_compra.php');" >Recibir Paquete <i class="fas fa-qrcode" title="Recibir Orden de Compra"></i></a>
           
            </td>
          </tr>
        
      
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