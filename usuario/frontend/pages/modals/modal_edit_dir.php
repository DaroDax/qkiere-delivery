<?php 
session_start();

if (isset($_SESSION ["cod_usu"])){

     require_once("../../../backend/clase/usuario.class.php");
  
     require_once("../../../backend/clase/municipio.class.php");

    $obj_usuario=new usuario;
  
    $obj_usuario->cod_dir_usu=$_POST['id'];
    $obj_usuario->asignar_valor();
    $obj_usuario->puntero=$obj_usuario->consultar_direccion();
    $arreglo=$obj_usuario->extraer_dato();
   
    $obj_municipio = new municipio;
    //$obj_municipio->puntero = $obj_municipio->listar();
    //$arre_municipio = $obj_usuario->extraer_dato();
    ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script>
            function Consultar_sector() {
        let municipio = $("#lugar").val();
        //alert(municipio);
    $.ajax({
        type: "POST",
        url: "../../backend/ajax/query_select_direccion/sectorEdit.php",
        data: "cod_mun="+municipio,
        success: function(r) {
            $('#sector').html(r);
        }
    });
            }
        </script>
<!--modal-->
<!-- Modal -->
        

  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">¿Editar Dirección?</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
           
           
           <h5>Nombre</h5>
           <input type="text" class="form-control" id="nom_dir_usu" placeholder="Mi Direccion" name="nom_dir_usu2" value="<?php echo $arreglo['nom_dir_usu']; ?>">
           <h5>Descripción</h5>
           <textarea class="form-control" id="dir_dir_usu" placeholder="Exactamente en" name="dir_dir_usu"><?php echo $arreglo['dir_dir_usu']; ?></textarea>

   <h5>Municipio</h5>
      <select name="municipio" class="form-control" required id="lugar" onchange ="Consultar_sector();">
          <option value="<?php echo $arreglo["cod_mun"]; ?>"><?php echo $arreglo["nom_mun"]; ?></option>

          <?php
          $obj_municipio->puntero = $obj_municipio->listar();
          while (($arre_municipio = $obj_municipio->extraer_dato()) > 0) {
          ?>

              <option value="<?php echo $arre_municipio["cod_mun"]; ?>"><?php echo $arre_municipio["nom_mun"]; ?></option>
          <?php  } ?>

          
      </select>
      <script>  window.onload = Consultar_sector(); </script>
      <div id="sector"></div>
     

          </div>
          <div class="modal-footer">

           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary"  data-dismiss="modal" onclick="editar_direccion('<?php echo $arreglo['cod_dir_usu'];?>');">Editar dirección</a>
          
          </div>
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


