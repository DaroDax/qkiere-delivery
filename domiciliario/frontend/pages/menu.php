<?php
 session_start();

if (isset($_SESSION["cod_dom"])) {

require_once("../../backend/clase/orden_compra.class.php");
require_once("../../backend/clase/chat.class.php");
$obj_chat_usu = new chat_usu; 
$obj_chat_usu->puntero = $obj_chat_usu->new_contador();
$arre_usu = $obj_chat_usu->extraer_dato();

  

  $obj_orden_compra = new orden_compra;

    $obj_orden_compra->puntero = $obj_orden_compra->cont_orden_aceptadas();
       $arre_cont = $obj_orden_compra->extraer_dato();

       $obj_orden_compra->puntero = $obj_orden_compra->cont_orden_recibidas();
            $arre_cont1 = $obj_orden_compra->extraer_dato();

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
        <!--CSS-->
        <link rel="icon" href="../../../img/64.png" type="image/png" />
        <link href="../icons/css/all.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../css/menu.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
        <link href="../css/inicio.css" rel="stylesheet">
        <script src="../../backend/ajax/funcion/cargas.js"></script>
        <script src="../../backend/ajax/funcion/orden_compra.js"></script>
        <script src="../../backend/ajax/funcion/inventario.js"></script>


        <!------>


        <!--Sweet-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

        <link href="../css/swal_edit.css" rel="stylesheet">

        <link href="../css/add_cart.css" rel="stylesheet">
        <!------->


        <!--JavaScript-->
        <script src="../js/buttons.js"></script>
        <script src="../../backend/ajax/funcion/orden_compra.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


    
        
    <!----Bootstrap important---->
    
        <!-------------->

    </head>

    <body>
        <div class="modal " id="recibir_orden_compra" role="dialog"></div>
        <script>
            function nue() {
                $('.new_ord').show();
                $('.ace_ord').hide();
            }

            function ace() {
                $('.ace_ord').show();
                $('.new_ord').hide();
            }
        </script>

        
        <div class="nav_menu">
            <nav class="navigation">
                <div class="nav-items">
                    <img src="../../../img/64.png" alt="" class="intercod_img">
                    <h1 class="intercod_h1">Domiciliario</h1>

                    <div class="chat"><i class="fas fa-comment" onclick="chat();"></i><br>         
                    <?php if ( $arre_usu['new_msj'] > 0) {
                        ?>
                            <i class="fas fa-circle" style="color:#45B39D; "></i>
                        <?php
                    }?>
                </div>
                    <i class="fas fa-power-off" onclick="logout();"></i>
                    <script>
                        function logout(){
                            location.href="../../backend/controlador/sesion/sesion.php?accion=cerrar";
                        }
                    </script>
                </div>
            </nav>
        </div>

        <div id="main_page">
            <div class="content">

                <div class="inicio_content">
                    <div class="feed">
                        <h1>Pedidos Para Buscar</h1>
                        <h2><?php echo $tienda["nom_dom"]; ?></h2>
                        <hr>
                    </div>

                    <div class="buttons_user">
                        <div class="usuario-but" onclick="nue();">
                            <i class="fas fa-plus"></i>
                            <h5 class="buttons">Nuevos</h5>
                        </div>
                        <div class="gps-but" onclick="ace();">
                            <i class="fas fa-check"></i>
                            <h5 class="buttons">Aceptados</h5>
                        </div>
                    </div>
                    <!-----------------Nuevos pedidos------------------------------>
                    <div class="new_ord">
                        <?php require_once("./actos/act-pedidos_nuevos.php"); ?>
                    </div>

                    <!----------------------Aceptados-------------------------->
                    <div class="ace_ord" style="display:none;">
                        <?php require_once("./actos/act-pedidos_aceptados.php"); ?>
                    </div>

                </div>
                <!--Inicio Content-->

            </div>
        </div>

        <div><br></div>

        <div><br></div>


        <div class="nav_bottom">
            <div class="bottom_items">
                <a href="./menu.php" class="item"><i class="fas fa-motorcycle"></i></a>
                <a href="#" class="item" onclick="historial();"><i class="fas fa-list"></i></a>
                <a href="#" class="item" onclick="cuenta();"><i class="fas fa-user"></i></a>

            </div>
        </div>
        
            <script src="../js/bootstrap.min.js"></script>
        <script src="./modals/idmodal.js"></script>
    </body>

   <?php if (isset($_SESSION["cod_dom"])){
        require("../../backend/ajax/notificacion/act_notificacion.php");
   }?>
<script src="../../backend/js/push_lib/push.min.js"></script>
<script src="../../backend/js/push.js"></script>

<script type="text/javascript">
    window.onload = function(){
        Push.Permission.request();
        if(Push.Permission.GRANTED){
            Push.Permission.request();
        }
    }
</script>

<?php

} else {
  header("location: ../../index.php");
  exit();
}
?>