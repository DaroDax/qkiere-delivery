<?php 
session_start();

if (isset($_SESSION ["cod_usu"])){

    require_once("../../../backend/clase/orden_compra.class.php");

    $obj_orden_compra =new orden_compra;
  
    $obj_orden_compra->cod_ord_com=$_POST['id'];
    $obj_orden_compra->asignar_valor();
 

    ?>

  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Detalle orden de compra # <?php echo $_POST['id'];?></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
            
            <div class="table-responsive">
              
            
            <table class="table table-condensed">
              <tr>
                <th>Cantidad</th>
                 <th>Producto</th>
                  <th>Observación</th>
                   <th>Precio</th>
                   <th>Total</th>
              </tr>
              <?php 
              $obj_orden_compra->puntero=$obj_orden_compra->consulta_detalle_orden_compra();
   
              while(($arreglo=$obj_orden_compra->extraer_dato())>0){?>
              <tr>
                <td><?php echo $arreglo["can_det_ord_com"];  ?></td>
                <td><?php echo $arreglo["nom_inv"];  ?></td>
                <td><?php echo $arreglo["obs_det_ord_com"];  ?></td>
                <td><?php echo $precio = number_format($arreglo["mon_det_ord_com"], 0, ",", ".");  ?></td>
                <td><?php echo $can_total = number_format($arreglo["mon_tot_det_ord_com"], 0, ",", ".");  ?></td>
                
                <?php echo $precio = number_format($arreglo["mon_ord_ped"], 0, ",", ".");  ?>
            
              </tr>
              <?php } ?>
            </table>
            </div>
            <?php

             $obj_orden_compra->puntero=$obj_orden_compra->mostrar_monto();
              $arreglo_ord=$obj_orden_compra->extraer_dato();
              ?>
            <div>Delivery = <strong>$<?php echo $de = number_format($arreglo_ord["mon_del_ord_ped"], 0, ",", ".");?></strong>
            <div>Monto Total = <strong>$<?php $total_max = number_format($arreglo_ord["mon_ord_ped"], 0, ",", ".");
                $completo = $arreglo_ord["mon_del_ord_ped"] + $arreglo_ord["mon_ord_ped"];
                echo $com_ord = number_format($completo, 0, ",", ".");
            ?></strong></div>
          </div>
          <div class="modal-footer">

           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          
          
          </div>
          <input type="hidden" value=" <?php echo $arre_ped_tem["cod_tem_ped"];  ?>" name="cod_tem_ped">
           <input type="hidden" value=" <?php echo $arre_ped_tem["cod_inv"];  ?>" name="inventario_cod_inv">
         
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