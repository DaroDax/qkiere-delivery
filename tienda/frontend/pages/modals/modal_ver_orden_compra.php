<?php 
session_start();

if (isset($_SESSION ["cod_tie"])){
    require_once("../../../backend/clase/orden_compra.class.php");
    require_once("../../../backend/clase/detalle_orden_compra.class.php");
  
  
    $obj_oden_compra = new orden_compra;
    $obj_oden_compra->cod_ord_com=$_POST['id'];
    $obj_oden_compra->asignar_valor();
    $obj_oden_compra->puntero=$obj_oden_compra->consultar_orden_compra_pendiente();
    $arre_orden_compra=$obj_oden_compra->extraer_dato();

    $obj_detalle_ord_com= new detalle_orden_compra;
    $obj_detalle_ord_com->cod_ord_com=$_POST['id'];
    $obj_detalle_ord_com->asignar_valor();
 
    ?>
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Orden de Compra # <?php echo $arre_orden_compra["cod_ord_com"]; ?></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

         

              <div class="modal-body">
            <div>Monto Total <?php echo $retotal = number_format($arre_orden_compra["mon_ord_ped"], 0, ",", "." ); ?></div>
              <div class="table-responsive">
            <table class="table table-respondive">
              <tr>
                <th>Cantidad</th>
                 <th>Producto</th>
                  <th>Observación</th>
                   <th>Precio</th>
                   <th>Total</th>
              </tr>
              <?php 
                
                $obj_detalle_ord_com->puntero=$obj_detalle_ord_com->consultar();
                while(($arreglo=$obj_detalle_ord_com->extraer_dato())>0){?>
              <tr>
                <td><?php echo $arreglo["can_det_ord_com"];  ?></td>
                <td><?php echo $arreglo["nom_inv"];  ?></td>
                <td><?php echo $arreglo["obs_det_ord_com"];  ?></td>
                <td><?php echo $precio = number_format($arreglo["mon_det_ord_com"], 0, ",", "." ); ?></td>
                <td><?php echo $total = number_format($arreglo["mon_tot_det_ord_com"], 0, ",", "." ); ?></td>
              </tr>
              <?php } ?>
            </table>
             </div>
          </div>
          <div class="modal-footer">
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


