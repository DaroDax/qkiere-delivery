<?php
session_start();

if (isset($_SESSION["cod_usu"])) {

    require_once "../../../backend/clase/municipio.class.php";

    $obj_municipio = new municipio;

    ?>

    <script src="../../../backend/ajax/lib/jquery.min.js"></script>
        <script src="../../../backend/ajax/funcion/query.js"></script>
        <script>
            function Consultar_sector() {
        let municipio = $("#lugar").val();
        //alert(municipio);
    $.ajax({
        type: "POST",
        url: "../../backend/ajax/query_select_direccion/sector.php",
        data: "cod_mun="+municipio,
        success: function(r) {
            $('#sector').html(r);
        }
    });
            }
        </script>
        <script>
            /*function agregar_dir(){    
                dataString = "aja";
            $.ajax({
            type: "POST",
            url: "../select-miubicacion.php",
            data: dataString,
            success: function(r) {
                 $('#dir_select').html(r);
                }
            });
        }*/
        </script>

        <script>
            function add_usuario_dir() {
    var sector = document.getElementById('cod_sector').value;
    if ($("#nom_dir_usu").val() == '' || $("#dir_dir_usu").val() == '' || sector == '') {
        Swal.fire("Error!", "Tienes Campos Vacios", "warning");
        return false;
    } else {
        var dataString = 'nom_dir_usu=' + $("#nom_dir_usu").val() + '&&dir_dir_usu=' + $("#dir_dir_usu").val() + '&&sector=' + sector + '&&accion=insertar';
        $.ajax({
            type: "POST",
            url: "../../backend/controlador/usuario/usuario.php",
            data: dataString,
            success: function(r) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Dirección Añadida',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    //agregar_dir(); 
            }
        });
    }
}
        </script>

  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Agregar Dirección</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

                       <div class="login_box_content" id="log_box" >

                            <h5>Nombre</h5>
                            <input type="text" class="form-control" id="nom_dir_usu" name="nom_dir_usu2" placeholder="Mi Casa">
                            <h5>Descripción</h5>
                            <textarea  class="form-control" id="dir_dir_usu" name="dir_dir_usu" placeholder="Calle N#"></textarea>

                            <h5>Municipio</h5>
                            <select id="lugar" class="form-control" required onchange ="Consultar_sector();">
                                <option value="">- Municipio -</option>

                                <?php
$obj_municipio->puntero = $obj_municipio->listar();
    while (($arre_municipio = $obj_municipio->extraer_dato()) > 0) {
        ?>

                                    <option value="<?php echo $arre_municipio["cod_mun"]; ?>"><?php echo $arre_municipio["nom_mun"]; ?></option>
                                <?php }?>
                            </select>
                            <div id="sector"></div>


                            
                        </div>
</div>

          <div class="modal-footer">


            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
            <a href="#" class="btn btn-primary" data-dismiss="modal" onclick="add_usuario_dir();">Agregar</a>


          </div>
           <input type="hidden" value=" <?php echo $arre_inv["cod_inv"]; ?>" name="inventario_cod_inv">
          <input type="hidden" value="<?php echo $arre_inv["cliente_cod_cli"]; ?>" name="cliente_cod_cli">
     </form>
    </div>
  </div>
         <script src="../js/mask/package.js" defer></script>


  <?php

} else {
    header("location: ../index.php");
    exit();

}
?>


