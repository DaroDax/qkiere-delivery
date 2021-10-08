<?php

session_start();

if (isset($_SESSION["cod_tie"])) {

  require_once("../../clase/orden_compra.class.php");

  require '../../../frontend/pages/phpqrcode/qrlib.php';

  $obj_orden_compra2 = new orden_compra;




?>

<!--<h4>Lista de Ordenes Aceptadas <button onclick="noti_orden_compra();">noti</button> </h4>-->
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary">
          <th>Orden #</th>
          <th>Cliente</th>
          <th>Direcciòn</th>
          <th>Fecha</th>
          <th>Estatus</th>
          
          <th>Opciòn</th>
        </tr>
      </thead>
      <tbody> 
           

        <?php
  $obj_orden_compra2->puntero = $obj_orden_compra2->consultar_orden_aceptada_tienda();
        while (($arreglo2 = $obj_orden_compra2->extraer_dato()) > 0) { 
              
           //if($arreglo2["estatu_pedido_cod_est_ped"] == 2){
            
            ?>
            <?php
    $dato = "".$arreglo2["cod_qr_ord_com"];
      QRcode::png($dato,"../../../../images/qrcode/".$dato.".png",'L',32,5);
    ?>


          <tr>
         
            <td>#<?php echo $arreglo2["cod_ord_com"]; ?></td>
            <td><?php echo $arreglo2["nom_usu"]; ?></td>
            <td><?php echo $arreglo2["nom_sec"]; ?></td>
            <td><?php echo $arreglo2["fec_ord_ped"]; ?></td>
            <td><?php echo $arreglo2["nom_est_ped"]; ?></td>
            <td>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo2['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_ver_orden_compra.php');" class="btn btn-warning tip-bottom">Ver <i class="far fa-eye"></i></a>
            </td>
          </tr>

        
        <?php // }else{ echo "<h4>No hay ordenes aceptadas<h4>";}
      } //CIERRE WHILE  ?>


          
      </tbody>
    </table>



</div>

<?php  //F



} else {
  header("location: ../index.php");
  exit();
}
?>