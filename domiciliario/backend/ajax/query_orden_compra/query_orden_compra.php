<?php

session_start();

if (isset($_SESSION["cod_dom"])) {

  require_once("../../clase/orden_compra.class.php");

  $obj_orden_compra = new orden_compra;
    $obj_orden_compra2 = new orden_compra;
      $obj_orden_compra3 = new orden_compra;

?>

 

    <!--<h4>Lista de Ordenes Pendientes <button onclick="noti_orden_compra();">noti</button> </h4>-->
    <h4><strong>Ordenes Nuevas:</strong></h4>
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary">
          <th>Opción</th>
          <th>Orden</th>
          <th>Tienda</th>
          <th>Cliente</th>
          <th>Dirección</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody> 
            
        <?php
  $obj_orden_compra->puntero = $obj_orden_compra->consultar();
        while (($arreglo = $obj_orden_compra->extraer_dato()) > 0) { ?>
          <tr id="fil_<?php echo $arreglo["cod_ord_com"]; ?>" class="search">
            <input type="hidden" id="fila_<?php echo $arreglo["cod_ord_com"]; ?>" value="<?php echo $arreglo["cod_ord_com"]; ?>">
          
            <!------>
            <td>
             
                <input type="hidden" name="raz_tie" id="raz_tie" value="<?php echo $arreglo["raz_tie"]; ?>">
                <a class="btn btn-success tip-bottom" title="Aceptar Pedido" onclick="aceptar_orden('<?php echo $arreglo["cod_ord_com"]; ?>','<?php echo $arreglo["cod_tie"]; ?>','<?php echo $arreglo["cod_usu"]; ?>','<?php echo $_SESSION["chat_id_dom"]; ?>','<?php echo $_SESSION["nom_dom"];?>','<?php echo $_SESSION["ape_dom"];?>','<?php echo $arreglo["chat_id_usu"];?>');" >Aceptar <i class="fas fa-check"></i></a>
              
            </td>
            <!------>
            <td>#<?php echo $arreglo["cod_ord_com"]; ?></td>
            <td><?php echo $arreglo["raz_tie"]; ?></td>
            <td><?php echo $arreglo["nom_usu"]; ?></td>
            <td><?php echo $arreglo["dir_dir_usu"]; ?></td>
            <td><?php echo $arreglo["fec_ord_ped"]; ?></td>
            
          </tr>
          <script type="text/javascript">
            //    noti_orden_compra('<?php //echo $arreglo["cod_ord_com"]; 
                                      ?>','<?php //echo $arreglo["nom_usu"]; 
                                            ?>');
          </script>
        <?php } ?>
          
      </tbody>
    </table>
<!---------------------------------------------------------->
    <h4><strong>Ordenes Aceptadas:</strong></h4>
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary" style="background-color:#85C1E9;">
          <th>Opción</th>
          <th>Orden</th>
          <th>Tienda</th>
          <th>Dirección Tienda</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody> 
            
        <?php
  $obj_orden_compra2->puntero = $obj_orden_compra2->orden_compra_aceptada();
        while (($arreglo2 = $obj_orden_compra2->extraer_dato()) > 0) { ?>
          <tr id="fil_<?php echo $arreglo2["cod_ord_com"]; ?>" class="search" style="background-color: #D6EAF8;">
            <input type="hidden" id="fila_<?php echo $arreglo2["cod_ord_com"]; ?>" value="<?php echo $arreglo2["cod_ord_com"]; ?>">
            
            <td>
             
                <a href="javascript:void(0);" data-toggle="modal" data-target="#recibir_orden_compra" class="btn btn-primary" onclick="carga_ajax('<?php echo $arreglo2['cod_ord_com']; ?>','recibir_orden_compra','modals/modal_rec_orden_compra.php');" >Recibir <i class="fas fa-qrcode" title="Recibir Orden de Compra"></i></a>
           
            </td>

            <td style="color:#000;" >#<?php echo $arreglo2["cod_ord_com"]; ?></td>
            <td style="color:#000;" ><?php echo $arreglo2["raz_tie"]; ?></td>
            <td style="color:#000;" ><?php echo $arreglo2["dir_tie"]; ?></td>
            <td style="color:#000;" ><?php echo $arreglo2["fec_ord_ped"]; ?></td>
            
          </tr>
        
      
        <?php } ?>
          
      </tbody>
    </table>
    <!---------------------------------------------------------->
  <h4><strong>Ordenes A Entregar:</strong></h4>
     <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary" style="background-color: #ABEBC6;">
          <th>Opción</th>
          <th>Orden</th>
          <th>Cliente</th>
          <th>Telefono</th>
          <th>Dirección Cliente</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody> 
            
        <?php
  $obj_orden_compra3->puntero = $obj_orden_compra3->orden_compra_recibida();
        while (($arreglo3 = $obj_orden_compra3->extraer_dato()) > 0) { ?>
          <tr id="fil_<?php echo $arreglo3["cod_ord_com"]; ?>" class="search" style="background-color: #E8F8F5  ; color:#fff;">
            <input type="hidden" id="fila_<?php echo $arreglo3["cod_ord_com"]; ?>" value="<?php echo $arreglo3["cod_ord_com"]; ?>">
            
             <td>
             
                <a class="btn btn-warning tip-bottom" title="Entregar Pedido" onclick="entregar_orden_compra('<?php echo $arreglo3["cod_ord_com"]; ?>','<?php echo $arreglo3["cod_tie"]; ?>','<?php echo $arreglo3["raz_tie"]; ?>','<?php echo $arreglo3["usuario_cod_usu"]; ?>','<?php echo $arreglo3["chat_id_dom"]; ?>','<?php echo $arreglo3["nom_dom"]; ?>','<?php echo $arreglo3["ape_dom"]; ?>','<?php echo $arreglo3["cha_id_tie"]; ?>');">Entregar <i class="fas fa-hand-holding" title="Entregar Orden"></i></a>
           
            </td>
            <!------>
            <!------>
            <td style="color:#000;">#<?php echo $arreglo3["cod_ord_com"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo3["nom_usu"]; ?></td>
            <td style="color:#000;"><a href="https://wa.me/<?php echo $arreglo3["cod_area_usu"];?><?php echo $arreglo3["tel_usu"];?>" target="_blank">+<?php echo $arreglo3["cod_area_usu"];?><?php echo $arreglo3["tel_usu"]; ?></a></td>
            <td style="color:#000;"><?php echo $arreglo3["dir_dir_usu"]; ?></td>
            <td style="color:#000;" ><?php echo $arreglo3["fec_ord_ped"]; ?></td>
         
            
            
           
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