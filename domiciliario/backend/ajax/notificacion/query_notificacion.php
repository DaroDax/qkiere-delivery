<?php

session_start();
if (isset($_SESSION["cod_dom"])) {
    require_once("../../clase/notificacion_domicilio.class.php");
  $obj_notificacion_domicilio = new notificacion_domicilio;
    
$obj_notificacion_domicilio ->puntero = $obj_notificacion_domicilio ->not_seguimiento();

while (($arre_noti = $obj_notificacion_domicilio->extraer_dato()) > 0) { ?>
    
<script>
    function limpiar_noti(){
  
                       
             $.ajax({
                        type:"POST",
                        url:"../../../domiciliario/backend/controlador/notificacion_domicilio/notificacion.php",
                        data:"accion=actualizar",
                        success:function(r){
                        }
                });           
    }
    function desactivar_noti(){
        $.ajax({
                        type:"POST",
                        url:"../../../domiciliario/backend/controlador/notificacion_domicilio/notificacion.php",
                        data:"accion=desactivar",
                        success:function(r){
                        }
                });
    }

    
function noti_movil(){
  
                       
             Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Hay pedidos disponibles para recoger en <?php echo $arre_noti["raz_tie"]?>',
                         
                        });
    }
       </script>

        <script>
            function generar_push(){
            Push.create('Nueva Pedido', {
                    body:'Hay pedidos disponibles para recoger en <?php echo $arre_noti["raz_tie"]?>',
                    icon:'./moto.png',
                    //timeout:5000,
                    vibrate:[100,100,100],
                    
                });
        
        noti_movil();
        limpiar_noti();
        setTimeout(desactivar_noti(),4000);
        }


            //setInterval('generar_push()',2000);
            window.onload=generar_push();



            

             
            

        </script>

<?php } ?>


<?php } else {
    header("location: ../index.php");
    exit();
}
?>