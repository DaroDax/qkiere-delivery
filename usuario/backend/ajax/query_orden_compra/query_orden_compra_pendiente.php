<?php

session_start();
if (isset($_SESSION ["cod_usu"])){

require_once("../../clase/orden_compra.class.php");
require_once("../../clase/seguimiento_orden_compra.class.php");
                                       
    $obj_orden_compra = new orden_compra;
     $obj_seg_orden_compra = new seguimiento_orden_compra;

                                            $obj_orden_compra->puntero = $obj_orden_compra->orden_compra_p();
                                            while (($arre_orden_compra = $obj_orden_compra->extraer_dato()) > 0) {  

                                              /* VERIFICA EL ESTATUS DEL PEDIDO*/
                                              $obj_seg_orden_compra->cod_tie=$arre_orden_compra["tienda_cod_tie"];
                                              $obj_seg_orden_compra->cod_ord_com=$arre_orden_compra["cod_ord_com"];
                                              $obj_seg_orden_compra->asignar_valor();
                                                $obj_seg_orden_compra->puntero = $obj_seg_orden_compra->seguimiento();
                                            $arre_seg_orden_compra = $obj_seg_orden_compra->extraer_dato();

                                              ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


                                                <div class="col-lg-12 col-md-8 col-sm-6 col-xs-4">

                                                    <div class="P_itmesbox Myorder-card">

                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                                                                <div class="PT_image">
                                                                          <a href="tienda.php?id=<?php echo $arre_orden_compra["cod_tie"]; ?>" class="clean">
                                                                    <img src="../../../images/logo_tienda/<?php echo $arre_orden_compra["log_tie"]; ?>" / name="log_tie">
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                                <div class="table-responsive">
                                                                <table class="table">
                                                              <thead >
                                                                <tr>
                                                                  <th scope="col">Orden#</th>
                                                                  <th scope="col">Tienda</th>
                                                                  <th scope="col">Fecha</th>
                                                                  <th scope="col">Monto Total</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                <tr>
                                                                  <th scope="row"><?php echo $arre_orden_compra["cod_ord_com"]; ?></th>
                                                                  <td><?php echo $arre_orden_compra["raz_tie"]; ?></td>
                                                                  <td><?php echo $arre_orden_compra["fec_ord_ped"]; ?></td>
                                                                  <td><?php echo $tota = number_format($arre_orden_compra["mon_ord_ped"], 0, ",", "."); ?></td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                            </div>

                                                                


                                                        <?php                                                            
                                                            $obj_seg_orden_compra->puntero = $obj_seg_orden_compra->seguimiento();
                                                              while (($arre_seg_orden_compra = $obj_seg_orden_compra->extraer_dato()) > 0){
                                                                  
                                                                 //echo $arre_orden_compra["cod_ord_com"];
                                                                  
                                                                    if ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 1) {
                                                                      ${"color1" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
                                                                      $show = "inline-block";
                                                                      $dom_sho = "none";
                                                                    }
                                                                    elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 2) {
                                                                     ${"color2" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
                                                                     $show = "none";
                                                                     $dom_sho = "none";
                                                                    }

                                                                    elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 3) {
                                                                      ${"color3" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
                                                                      $show = "none";
                                                                      $dom_sho = "inline-block";
                                                                    }

                                                                    elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 4) {
                                                                     ${"color4" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
                                                                     $show = "none";
                                                                     $dom_sho = "inline-block";
                                                                    }

                                                                    elseif ($arre_seg_orden_compra["estatu_pedido_cod_est_ped"] == 5) {
                                                                      ${"color5" . $arre_orden_compra["cod_ord_com"]} = "#2ECC71";
                                                                      $show = "none";
                                                                      $dom_sho = "none";
                                                                    }
                                                                  
                                                                  }
                                                            



                                                           $recibido = "fas fa-store";
                                                           $preparado ="fas fa-box";                                                          
                                                           $repartido = "fas fa-share-square";
                                                           $entregado = "fas fa-check-square";

                                                          //echo $arre_seg_orden_compra["orden_compra_cod_ord_com"];
                                                          //echo $arre_seg_orden_compra["seg_seg_ord_com"];
                                                          //echo $arre_seg_orden_compra["cod_seg_ord_com"]                                                            

                                                        ?>




                                                        <div class="temp_line">
                                                                <div class="head">
                                                                    <h5>Creado</h5>
                                                                    <h5>Recibido</h5>
                                                                    <h5>Preparado</h5>
                                                                    <h5>Repartido</h5>
                                                                    <h5>Entregado</h5>
                                                                    </div>

                                                                    <div class="draws">

                                                         <i name="iconos" class="far fa-check-square" style="color: <?php echo  ${"color1" . $arre_orden_compra["cod_ord_com"]} ?>"></i>
                                                        
                                                         <i name="iconos" class="<?php echo $recibido; ?>" style="color: <?php echo ${"color2" . $arre_orden_compra["cod_ord_com"]} ?>"></i>
                                                       
                                                         <i name="iconos" class="<?php echo $preparado; ?>" style="color: <?php echo  ${"color3" . $arre_orden_compra["cod_ord_com"]} ?>"></i>
                                                     
                                                         <i name="iconos" class="<?php echo $repartido; ?>" style="color: <?php echo  ${"color4" . $arre_orden_compra["cod_ord_com"]} ?>"></i>
                                                     
                                                         <i name="iconos" class="<?php echo $entregado; ?>" style="color: <?php echo ${"color5" . $arre_orden_compra["cod_ord_com"]} ?>"></i>


                                                         </div>
                                                                    
                                                         </div>
                                                          <hr>
                                                            </div>
                                                             
                                                             <div class="options">

                                                                      
                                                                           <i href="#" onclick="cancelar_orden_compra('<?php echo $arre_orden_compra["cod_ord_com"]; ?>');" class="fa fa-times" aria-hidden="true" id="delete" style="display: <?php echo $show?>">Eliminar</i>
                                                               
                                         
                         <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arre_orden_compra["cod_ord_com"]; ?>','detalle_orden_compra','modals/modal_det_ped.php');"><i class="fas fa-info-circle" id="details"> Detalles</i></a>

                       
                               <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_domi" onclick="carga_ajax('<?php echo $arre_orden_compra["domiciliario_cod_dom"]; ?>','detalle_domi','modals/modal_det_domi.php');"><i class="fas fa-info-circle" id="details" style="display: <?php echo $dom_sho?>; color=#ccc"> Domiciliario</i></a>
                        <!-- Button trigger modal -->

                        <!----->
                          
                


                         <!-- --->




                                                                    </div>


                                                        </div>

                                                        
                                                       
                                                    </div>
                                                </div>


                                            <?php } 

}
else{
    header("location: ../index.php");
    exit();

}
  ?>