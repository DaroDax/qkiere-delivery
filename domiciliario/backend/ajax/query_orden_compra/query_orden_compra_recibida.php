<?php

session_start();

if (isset($_SESSION["cod_dom"])) {

  require_once("../../clase/orden_compra.class.php");

  $obj_orden_compra3 = new orden_compra;

?>

 

    <!--<h4>Lista de Ordenes Pendientes <button onclick="noti_orden_compra();">noti</button> </h4>-->
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary">
          <th>Orden #</th>
          <th>Tienda</th>
          <th>Direcciòn</th>
          <th>Fecha</th>
          <th>Usuario</th>
          <th>Telefono</th>
          <th>Opciòn</th>
        </tr>
      </thead>
      <tbody> 
            
        <?php
  $obj_orden_compra3->puntero = $obj_orden_compra3->orden_compra_recibida();
        while (($arreglo3 = $obj_orden_compra3->extraer_dato()) > 0) { ?>
          <tr id="fil_<?php echo $arreglo3["cod_ord_com"]; ?>" class="search">
            <input type="hidden" id="fila_<?php echo $arreglo3["cod_ord_com"]; ?>" value="<?php echo $arreglo3["cod_ord_com"]; ?>">
            <td>#<?php echo $arreglo3["cod_ord_com"]; ?></td>
          
            <!------>
            <!------>
            <td><?php echo $arreglo3["raz_tie"]; ?></td>
            <td title="<?php echo $arreglo3["dir_dir_usu"]; ?>"><?php echo $arreglo3["nom_dir_usu"]; ?></td>
            <td><?php echo $arreglo3["fec_ord_ped"]; ?></td>
            <td><?php echo $arreglo3["nom_usu"]; ?></td>
            <td><a href="https://wa.me/<?php echo $arreglo3["cod_area_usu"];?><?php echo $arreglo3["tel_usu"];?>" target="_blank">+<?php echo $arreglo3["cod_area_usu"];?><?php echo $arreglo3["tel_usu"]; ?></a></td>
            <td>
             
                <a class="btn btn-warning tip-bottom" title="Entregar Pedido" onclick="entregar_orden_compra('<?php echo $arreglo3["cod_ord_com"]; ?>','<?php echo $arreglo3["cod_tie"]; ?>','<?php echo $arreglo3["raz_tie"]; ?>','<?php echo $arreglo3["usuario_cod_usu"]; ?>','<?php echo $arreglo3["chat_id_dom"]; ?>','<?php echo $arreglo3["nom_dom"]; ?>','<?php echo $arreglo3["ape_dom"]; ?>','<?php echo $arreglo3["cha_id_tie"]; ?>');">Entregar Pedido <i class="fas fa-hand-holding" title="Entregar Orden"></i></a>
           
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