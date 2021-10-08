<?php
session_start();

if (isset($_SESSION["cod_usu"])) {

  require_once("../../../backend/clase/inventario.pub.class.php");
  $obj_inventario_pub = new inventario_pub;
  $obj_inventario_pub->cod_inv = $_POST["id"];
  $obj_inventario_pub->asignar_valor();
  $obj_inventario_pub->puntero = $obj_inventario_pub->producto();
  $arre_producto = $obj_inventario_pub->extraer_dato();

?>
<script src="../../backend/ajax/funcion/cart.js"></script>
 
  <!--modal-->
  <!-- Modal -->


  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h3 class="modal-title" id="exampleModalLabel">¿Desea añadir <?php echo $arre_producto["nom_inv"]; ?> al carrito?</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="descripcion">
          <h5 class="pro_des"><strong>Descripción: </strong><?php echo $arre_producto["des_inv"]; ?></h5>
        </div>

        <div class="Redio_diltype">
          <div class="radio_1">
            <input type="radio" id="takeaway" name="pedido_type" value="female" onclick="txtArea()" checked>
            <label for="takeaway">Normal</label>
          </div>

          <div class="radio_2">
            <input type="radio" id="Delivery" name="pedido_type" value="male" onclick="txtArea()">
            <label for="Delivery">Personalizado</label>
          </div>

        </div>



        <!-- Pedido Personalizado-->
        <div class="personalizado">
          <textarea class="form-control" id="area" name="obs_tem_ped" placeholder="Pedido Personalizado" style="display: none;"></textarea>
        </div>

        <hr>

        <div class="areas">
          <select name="can_tem_ped" id="can_tem_ped" Onchange="calcular();" class="form-control">
            <option value="">- Seleccione -</option>
            <?php
            echo $i = 1;
            $ca = $arre_producto["can_inv"];
            for ($i; $i <= $ca; $i++) {
            ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
          </select>
          <p>X</p>
          <input type="text" name="pre_inv" id="pre_inv" value="<?php echo $arre_producto["pre_inv"];  ?>" class="form-control" readonly>
          <p>=</p>
          <input type="text" name="tot_tem_ped" placeholder="Total" id="tot_tem_ped" class="form-control">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a class="btn btn-primary" data-dismiss="modal" onclick="add_cart('<?php echo $arre_producto['cod_inv'];  ?>','<?php echo $arre_producto['cliente_cod_cli'];  ?>');">Agregar carrito</a>
      </div>
    </div>
  </div>

  <script>
    function calcular() {
      cantidad = $("#can_tem_ped").val();
      precio = $("#pre_inv").val();
      //  cantidad = cantidad*1000;
      total = (precio * cantidad);

      $("#tot_tem_ped").val(total);

    }

    function txtArea() {
        if ($('input:radio[name=pedido_type]:checked').val() === 'female') {
          //alert("Aparecio!!!");
          $('#area').hide();
        } else {
          //alert("Desaparecio!!!");
          $('#area').show();
        }
    }
  </script>

<?php

} else {
?>
  <script>
    Swal.fire({
      title: '¡¡Tienes que iniciar sesión!!',
      text: "¿Quieres iniciar o registrarte?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Iniciar Sesion'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = "./login.php"
      }
    })
  </script>
<?php
}
?>