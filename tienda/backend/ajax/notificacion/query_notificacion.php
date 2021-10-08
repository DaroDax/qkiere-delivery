<?php

session_start();
if (isset($_SESSION["cod_tie"])) {
    require_once("../../clase/notificacion_tienda.class.php");
  $obj_notificacion_tienda = new notificacion_tienda;
    
$obj_notificacion_tienda ->puntero = $obj_notificacion_tienda ->not_seguimiento();

while (($arre_noti = $obj_notificacion_tienda->extraer_dato()) > 0) { ?>
    
<script>
    function limpiar_noti(){
  
                       
             $.ajax({
                        type:"POST",
                        url:"../../../tienda/backend/controlador/notificacion_tienda/notificacion.php",
                        data:"accion=actualizar",
                        success:function(r){
                        }
                });
    }

function noti_movil(){
  
                       
             Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: '<?php echo $arre_noti["not_ale_tie"] ?> en <?php echo $arre_noti["raz_tie"]?>',
                         
                        });
    }
       </script>

        <script>
            function generar_push(){
            Push.create('Nueva Aviso en tu Tienda', {
                    body:'<?php echo $arre_noti["not_ale_tie"] ?> en <?php echo $arre_noti["raz_tie"]?>',
                    icon:'./cart.png',
                    //timeout:5000,
                    vibrate:[100,100,100],
                    
                });
        noti_movil();
        
        limpiar_noti();
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