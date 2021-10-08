<?php

session_start();

if (isset($_SESSION ["cod_tie"])){

  require_once("../../clase/inventario.class.php");
  $obj_inv = new inventario;

 
  ?>


        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Img</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Nombre</th>
              <th scope="col">Descripción</th>
              <th scope="col">Precio</th>
              <th scope="col">Opción</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $obj_inv->puntero = $obj_inv->listar();
            while (($arre_inv = $obj_inv->extraer_dato()) > 0) { ?>
    <tr>
      <td>
        <div class="profile-userpic">
          <img src="../../../images/inv_tienda/<?php echo $arre_inv['img_inv']; ?>" class="img-responsive" />
        </div>
      </td>
      <td><?php echo $arre_inv["can_inv"]; ?></td>
      <td><a href="#"><?php echo $arre_inv["nom_inv"]; ?></a></td>
      <td><?php echo $arre_inv["des_inv"]; ?></td>
      <td><?php echo $tot = number_format($arre_inv["pre_inv"], 0, ",", "."); ?></td>
      <td>
        <div class="group-btn">
          <a href="javascript:void(0);" title="Editar Elemento" data-toggle="modal" data-target="#edit_producto" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','edit_producto','modals/modal_edit_producto.php');" class="btn btn-warning tip-bottom">Editar<i class="fas fa-pen"></i></a>
          <a href="#" title="Eliminar Pedido" onclick="eliminar_logico(<?php echo $arre_inv['cod_inv']; ?>);" class="btn btn-danger tip-bottom"> Eliminar<i class="fas fa-ban"></i></a>
              <div class="col-sm-5">
      <?php


      
      if ($arre_inv["estatu_cod_est"] == 1) {
        ${"estado". $arre_inv["cod_inv"]} = "checked";
        
      }else{

      }
      
     ?>

      <div class="switch-button">
    <!-- Checkbox -->
    <input type="checkbox" name="switch-button" id="switch-label<?php echo $arre_inv['cod_inv']?>" class="switch-button__checkbox" <?php echo ${"estado". $arre_inv["cod_inv"]}; ?> onclick="estatu_producto('<?php echo $arre_inv["cod_inv"]; ?>','<?php echo $arre_inv["estatu_cod_est"];?>');">
    <!-- Botón -->
    <label for="switch-label<?php echo $arre_inv['cod_inv']?>" class="switch-button__label"></label>
</div>
    </div>
          </div>
        </td>
      </tr>
    <?php } ?>

  </tbody>
</table>
</div>



<?php  //F

 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>