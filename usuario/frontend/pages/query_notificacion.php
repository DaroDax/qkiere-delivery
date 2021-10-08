<?php
session_start();
if (isset($_SESSION["cod_usu"])) {
    require_once("../../clase/notificacion_usuario.class.php");
  $obj_notificacion_usuario = new notificacion_usuario;
    
$obj_notificacion_usuario ->puntero = $obj_notificacion_usuario ->not_seguimiento();

while (($arre_noti = $obj_notificacion_usuario->extraer_dato()) > 0) { ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>alert("esto funciona");</script>
<script>
    function limpiar_noti(){
  
                       
             $.ajax({
                        type:"POST",
                        url:"../../../usuario/backend/controlador/notificacion_usuario/notificacion.php",
                        data:"accion=actualizar",
                        success:function(r){
                        }
                });
    }

    function noti_movil(){
  
                       
             Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: 'Su orden numero '+<?php echo $arre_noti["orden_compra_cod_ord_com"]?>+' ha sido <?php echo $arre_noti["nom_est_ped"]?>',
                         
                        });
    }

       </script>

        <script>
            function generar_push(){
            Push.create('Orden Aceptada', {
                    body:'Su orden numero '+<?php echo $arre_noti["orden_compra_cod_ord_com"]?>+' ha sido <?php echo $arre_noti["nom_est_ped"]?>',
                    icon:'../../../../images/not_icons/ok.png',
                    //timeout:5000,
                    vibrate:[100,100,100],
                    
                });
        noti_movil();

        limpiar_noti();
        }

            window.onload=generar_push();
        </script>

<?php } ?>


<?php } else {
    header("location: ../index.php");
    exit();
}
?>