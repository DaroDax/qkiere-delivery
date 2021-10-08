<?php 
session_start();
if (isset($_SESSION ["cod_dom"])){

    require_once("../../../backend/clase/orden_compra.class.php");

    $obj_orden_compra = new orden_compra;
    $obj_orden_compra->cod_ord_com=$_POST['id'];
    $obj_orden_compra->asignar_valor();
    $obj_orden_compra->puntero=$obj_orden_compra->comparar_codigo();
    $arre_orden_com = $obj_orden_compra->extraer_dato();

 ?>
<script> function comprobar_cod(){
    let cod_ord = "<?php echo $arre_orden_com["cod_qr_ord_com"];?>";
    let cod_com = $('#cod_qr_ord_com').val();
    console.log(cod_ord);
    console.log(cod_com);
    if (cod_ord == cod_com) {
      
      $("#next").prop('disabled', false);
      $("#next").css('width', '60%');

    }else{
      $("#next").prop('disabled', true);
    }
}

</script>
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Orden de Compra # <?php echo $_POST["id"]; ?></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">

            <h4 class="card-title" style="text-align:center;"><b>Introduce el codigo que te de la tienda</b></h4>
            <p class="category" style="text-align:center;">¡Valida el codigo y ve a entregar el pedido!</p>
            <div class="card-content">
                <div class="text-center">
                  <!--<video id="preview" width="80%" style="text-align: center;"></video>
                    <script>
                        let scanner = new Instascan.Scanner(
                            {
                                video: document.getElementById('preview')
                                , mirror: false
                            }
                        );
                        scanner.addListener('scan', function(content) {
                          //  alert('Codigo Escaneado: ' + content);
                         //   window.open(content);
                        
                            document.getElementById('cod_qr_ord_com').value = content;
                            location.href ="validar_orden.php?cod="+content;
                          //  document.getElementById('resultado').innerHTML = content;

                           
                        });
                        Instascan.Camera.getCameras().then(cameras => 
                        {
                            if(cameras.length > 0){
                                scanner.start(cameras[1]);
                            } else {
                                console.error("No se detectaron camaras");
                            }
                        });

                        function cerrar_cam(){
                           scanner.stop(cameras[1]);
                        }
                    </script>-->
              
                  <form name="validar_f" id="validar_f" action="recibo.php" method="GET">
                  <input type="text" name="cod"  id="cod_qr_ord_com" width="100%" autocomplete="off" class="form-control" placeholder="Ingrese el Codigo" onkeyup="comprobar_cod();">
                  <br>
                  <button type="submit" class="btn btn-primary" id="next" disabled>Validar</button>
                </form>
                </div>
            </div>


     
    <!-- Classic Modal -->
   
         
            </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cerrar_cam();">Cerrar</button>
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


