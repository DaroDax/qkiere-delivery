<?php 
session_start();

if (isset($_SESSION ["cod_usu"])){
 
    require_once("../../../backend/clase/cart.class.php");
     require_once("../../../backend/clase/inventario.class.php");

    $obj_cart=new cart;
  
    $obj_cart->cod_tem_ped=$_POST['id'];
    $obj_cart->asignar_valor();
    $obj_cart->puntero=$obj_cart->consulta_carrito();
    $arre_ped_tem=$obj_cart->extraer_dato();
   

    $obj_inventario = new inventario;
  
    $obj_inventario->cod_inv=$arre_ped_tem['cod_inv'];
    $obj_inventario->asignar_valor();
    $obj_inventario->puntero=$obj_inventario->filtrar();
    $arre_inv=$obj_inventario->extraer_dato();
    ?>

       
<!--modal-->
<!-- Modal -->
        

  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">¿Desea añadir el siguiente elemento a su compra?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
           
             <h1>  <?php echo $arre_ped_tem["nom_inv"];  ?></h1>
            <strong> Descripción:</strong>  <span><?php echo $arre_ped_tem["des_inv"];  ?></span>

              <!-- Pedido Personalizado-->
                <div class="Redio_diltype">
                   <ul>
                      <li>
                        <input type="radio" id="takeaway" name="pedido_type" value="female" onclick="txtArea()" checked>
                        <label for="takeaway">Normal</label>
                      </li>
                      <li>
                        <input type="radio" id="Delivery" name="pedido_type" value="male" onclick="txtArea()" >
                          <label for="Delivery">Personalizado</label>
                      </li>
                     </ul>
                </div>
                                      
                                    <!-- Pedido Personalizado-->
                <textarea class="form-control"  id="area" name="obs_tem_ped" placeholder="Pedido Personalizado" style="display: none;"><?php echo $arre_ped_tem["obs_tem_ped"];  ?></textarea>

                <div class="areas">
                  <select name="can_tem_ped" id="can_tem_ped" Onchange="calcular();" class="form-control">
                    <option value="<?php echo $arre_ped_tem["can_tem_ped"];  ?>"><?php echo $arre_ped_tem["can_tem_ped"];  ?></option>
                    <?php 
                    echo $i=1;
                   $ca= $arre_inv["can_inv"];
                      for($i;$i<=$ca;$i++){
                    ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                  <?php } ?>
                  </select>
                 <p>X</p>
                 <input type="text" name="pre_inv" id="pre_inv" value="<?php echo $price = number_format($arre_inv["pre_inv"], 0, ",", "." );  ?>" class="form-control" readonly >
                <p>=</p>
                <input type="text" name="tot_tem_ped" placeholder="Total" id="tot_tem_ped" class="form-control" value="<?php echo $arre_ped_tem["tot_tem_ped"];  ?>" >
          </div>

          </div>
          <div class="modal-footer">

           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary"  data-dismiss="modal" onclick="edit_cart('<?php echo $arre_ped_tem['cod_tem_ped'];  ?>');">Guardar Cambios</a>
          
          </div>
          <input type="hidden" value=" <?php echo $arre_ped_tem["cod_tem_ped"];  ?>" name="cod_tem_ped">
           <input type="hidden" value=" <?php echo $arre_ped_tem["cod_inv"];  ?>" name="inventario_cod_inv">
         
     </form>
    </div>
  </div>
       
         <script src="../js/mask/package.js" defer></script>
  <script>
    function calcular () {
      cantidad = $("#can_tem_ped").val();
      precio = $("#pre_inv").val();
      cantidad = cantidad*1000;
      total = (cantidad * precio);

      $("#tot_tem_ped").val(total);
          
    }

    function txtArea(){
       if ($('input:radio[name=pedido_type]:checked').val() === 'female') {
            //alert("Aparecio!!!");
            $('#area').hide(); 
        }else{
            //alert("Desaparecio!!!");
            $('#area').show();
      }
    }
  </script>

  <?php   

}
else{
    header("location: ../index.php");
    exit();

}
?>


