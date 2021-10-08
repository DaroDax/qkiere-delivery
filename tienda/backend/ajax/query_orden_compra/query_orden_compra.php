<?php

session_start();

if (isset($_SESSION["cod_tie"])) {

  require_once("../../clase/orden_compra.class.php");
    require_once("../../clase/delivery.class.php");
      require '../../../frontend/pages/phpqrcode/qrlib.php';
      


  


  
$obj_domicilio = new domicilio;

  $obj_orden_compra = new orden_compra;

      $obj_orden_compra2 = new orden_compra;

        $obj_orden_compra3 = new orden_compra;
  

    
 




?>
<!---------Funcion que avisa a TODOS los domiciliarios------------------------>
                <script>    

                  function not_domicilio(chat_id_dom) {
    /*Notificación Domiciliario*/
    var mensaje = "\u2705 Hola, hay tiendas con nuevas ordenes para repartir";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id_dom+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}                       
                  function reenviar_domi(){
              
                    <?php $obj_domicilio->puntero = $obj_domicilio->consulta();
        while (($arre_dom = $obj_domicilio->extraer_dato()) > 0) { ?>
                            not_domicilio(<?php echo $arre_dom["chat_id_dom"]; ?>);
                        <?php } ?>
                  }
                </script>

<!---------------------PRIMERA TABLA-------------------------------->                

    <!--<h4>Lista de Ordenes Pendientes <button onclick="noti_orden_compra();">noti</button> </h4>-->
    <h4><strong>Ordenes Nuevas:</strong></h4>
    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary" style="background-color: #ccc;">
          <th>Opción</th>
          <th>Orden#</th>
          <th>Cliente</th>
          <th>Estatus</th>
          <th>Dirección</th>
          <th>Fecha</th>
          

        </tr>
      </thead>
      
      <tbody> 
            
        <?php
  $obj_orden_compra->puntero = $obj_orden_compra->consultar_orden_pendientes();
        while (($arreglo = $obj_orden_compra->extraer_dato()) > 0) { ?>
          <tr id="fil_<?php echo $arreglo["cod_ord_com"]; ?>" class="search">
            <input type="hidden" id="fila_<?php echo $arreglo["cod_ord_com"]; ?>" value="<?php echo $arreglo["cod_ord_com"]; ?>">
            <td>
              <div class="btn-group">
                <a class="btn btn-success tip-bottom" title="Aceptar Pedido" onclick="aceptar_orden('<?php echo $arreglo["cod_ord_com"]; ?>','<?php echo $arreglo["usuario_cod_usu"]; ?>','<?php echo $arreglo["raz_tie"]; ?>','<?php echo $arreglo["chat_id_usu"]; ?>');" >Aceptar <i class="fas fa-check"></i></a>
                <a class="btn btn-danger tip-bottom" href="#" onclick="rechazado_logico('<?php echo $arreglo["cod_ord_com"]; ?>','<?php echo $arreglo["usuario_cod_usu"]; ?>');" title="Eliminar Pedido">Eliminar <i class="fas fa-times"></i></a>
                </a>
                <a href="javascript:void(0);" title="Ver Detalles" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_ver_orden_compra.php');" class="btn btn-warning tip-bottom">Ver <i class="far fa-eye"></i></a>
              </div>
            </td>
            <td><strong>#<?php echo $arreglo["cod_ord_com"]; ?></strong></td>
            <td><?php echo $arreglo["nom_usu"]; ?></td>
            <td><?php echo $arreglo["nom_est_ped"]; ?></td>
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


<!---------------------SEGUNDA TABLA-------------------------------->

    <h4><strong>Ordenes Aceptadas:</strong></h4>

    <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary" style="background-color: #85C1E9;">
          <th>Opción</th>
          <th>Orden#</th>
          <th>Cliente</th>
          <th>Estatus</th>
          <th>Dirección</th>
          <th>Fecha</th>
          
          
        </tr>
      </thead>
      <tbody> 
        <?php
  $obj_orden_compra2->puntero = $obj_orden_compra2->consultar_orden_aceptada_tienda();
        while (($arreglo2 = $obj_orden_compra2->extraer_dato()) > 0) { 
              
           //if($arreglo2["estatu_pedido_cod_est_ped"] == 2){
            
            ?>
            <?php
    $dato = "".$arreglo2["cod_qr_ord_com"];
      QRcode::png($dato,"../../../../images/qrcode/".$dato.".png",'L',32,5);
    ?>


          <tr style="background-color: #D6EAF8  ; color:#fff;">
            <td>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo2['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_ver_orden_compra.php');" class="btn btn-warning tip-bottom">Ver <i class="far fa-eye"></i></a>
            </td>
            <td style="color:#000;"><strong>#<?php echo $arreglo2["cod_ord_com"]; ?></strong></td>
            <td style="color:#000;"><?php echo $arreglo2["nom_usu"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo2["nom_est_ped"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo2["dir_dir_usu"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo2["fec_ord_ped"]; ?></td>
          </tr>
        <?php // }else{ echo "<h4>No hay ordenes aceptadas<h4>";}
      } //CIERRE WHILE  ?>    
      </tbody>
    </table>

<!---------------------TERCERA TABLA-------------------------------->

 <h4><strong>Ordenes A Entregar:</strong></h4>

  <table id="example1" class="table table-bordered table-striped table-responsive">
      <thead>
        <tr class="bg bg-primary" style="background-color: #ABEBC6">
          <th>Opción</th>
          <th>Orden #</th>
          <th>Cliente</th>
          <th>Estatus</th>
          <th>Dirección</th>
          <th>Domiciliario</th>
          
          
          
        </tr>
      </thead>
      <tbody> 
        <?php
  $obj_orden_compra3->puntero = $obj_orden_compra3->consultar_orden_aceptada_domiciliario();
        while (($arreglo = $obj_orden_compra3->extraer_dato()) > 0) { ?>          
<?php
              
           if($arreglo["estatu_pedido_cod_est_ped"] == 3){
            ?>
          <tr id="fil_<?php echo $arreglo["cod_ord_com"]; ?>" class="search" style="background-color: #E8F8F5;">
            <input type="hidden" id="fila_<?php echo $arreglo["cod_ord_com"]; ?>" value="<?php echo $arreglo["cod_ord_com"]; ?>">

            <td>
              <div class="btn-group">
                
                <a href="javascript:void(0);" data-toggle="modal" data-target="#detalle_orden_compra" onclick="carga_ajax('<?php echo $arreglo['cod_ord_com']; ?>','detalle_orden_compra','modals/modal_confirmar_orden.php');" class="btn btn-primary tip-bottom">Entregar <i class="fas fa-qrcode"></i></a>
              </div>
            </td>

            <td style="color:#000;"><strong>#<?php echo $arreglo["cod_ord_com"]; ?></strong></td>
            <td style="color:#000;"><?php echo $arreglo["nom_usu"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo["nom_est_ped"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo["nom_sec"]; ?></td>
            <td style="color:#000;"><?php echo $arreglo["nom_dom"]; ?></td>
           
          </tr>

        
<?php }else{ echo "<h4>No hay ordenes aceptadas<h4>";} ?>
          <script type="text/javascript">
            //    noti_orden_compra('<?php //echo $arreglo["cod_ord_com"]; 
                                      ?>','<?php //echo $arreglo["nom_usu"]; 
                                            ?>');
          </script>
        <?php } ?>


          
      </tbody>
    </table>
  



                      







  </div><!--MAIN DIV-->
<?php  //F

} else {
  header("location: ../index.php");
  exit();
}
?>