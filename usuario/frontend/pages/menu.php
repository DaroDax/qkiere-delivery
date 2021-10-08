<?php


require_once "../../backend/clase/municipio_pub.class.php";
$obj_municipio_pub = new municipio_pub;

require_once "../../backend/clase/tienda.class.pub.php";
$obj_tienda_pub = new tienda_pub;




$obj_tienda_pub->cod_mun = $_GET["mun"];
$obj_tienda_pub->asignar_valor();

$obj_municipio_pub->cod_mun = $_GET["mun"];
$obj_municipio_pub->asignar_valor();
$obj_municipio_pub->puntero = $obj_municipio_pub->municipio();
$arre_nombre = $obj_municipio_pub->extraer_dato();
session_start();

if (isset($_SESSION["cod_usu"])) {

    require_once "../../backend/clase/usuario.class.php";
    require_once "../../backend/clase/sitio_favorito.class.php";
    $obj_usuario = new usuario;
    $obj_sitio_fav = new sitio_favorito;

    $obj_usuario->puntero = $obj_usuario->select_opcion();
           $arre_ubi = $obj_usuario->extraer_dato();

           require_once("../../backend/clase/chat.class.php");
$obj_chat_usu = new chat_usu; 
$obj_chat_usu->puntero = $obj_chat_usu->new_contador();
$arre_usu = $obj_chat_usu->extraer_dato();


}


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
    <link href="../css/inicio.css" rel="stylesheet">

    <link href="../css/responsive.css?2" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>

    <!--WAP--------------------------------->
  <meta name="theme-color" content="#FF6A00">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">
  <link rel="shortcut icon" type="image/png" href="../../../img/64.png">
  <link rel="apple-touch-icon" href="../../../img/64.png">
  <link rel="apple-touch-startup-image" href="../../../img/64.png">
  <link rel="manifest" href="./manifest.json">
  <script src="./script.js"></script>



    <!------>


    <!--Sweet-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>


    <link href="../css/swal_edit.css" rel="stylesheet">
    <!------->

    <!--JavaScript-->
    <script src="../js/buttons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../backend/ajax/funcion/favoritos.js"></script>
    <!-------------->

</head>

<body>

<div  id="notificacion"></div>

    <script>
        function pedir_mun(){
                //ubi = "<?php echo $arre_ubi["lat_miu"];?>";
                get_ubi ="<?php echo $_GET["mun"];?>";
                
            //Deslogeado
            if(get_ubi > 0){
                //alert("tienes una direccion yuju");
            }else{
                Swal.fire({
          title: 'Elige Tu Dirección Por Favor',
          html:
            '<select name="" id="swal-input1" class="swal2-input">' +
            '<?php
$obj_municipio_pub->puntero = $obj_municipio_pub->listar();
while (($arre_mun = $obj_municipio_pub->extraer_dato()) > 0) {
    ?><option value="<?php echo $arre_mun["cod_mun"]; ?>"><?php echo $arre_mun["nom_mun"]; ?></option><?php } ?>'+
            '</select>',
          focusConfirm: false,
          preConfirm: () => {
            let lugar=document.getElementById('swal-input1').value;
            //alert(lugar);
            $('#municipio > option[value='+lugar+']').attr('selected',true);
            municipio();
                    }
                })
            }//else

            //Deslogeado
        }//function
        window.onload = pedir_mun();
    </script>
    <div class="nav_menu">
        <nav class="navigation">
            <div class="nav-items">
                <img src="../../../img/64.png" alt="" class="intercod_img">

                <?php

if (isset($_SESSION["cod_usu"])) {?>
                <select name="municipios" id="municipio" class="ubi_mun" onchange="municipio(); tomar_mun();">
                <?php } else {?>
                     <select name="municipios" id="municipio" class="ubi_mun" onchange="municipio();">
                <?php }?>
                    <option value="<?php echo $arre_nombre["cod_mun"]; ?>"><?php echo $arre_nombre["nom_mun"]; ?></option>
                    <?php
$obj_municipio_pub->puntero = $obj_municipio_pub->listar();
while (($arre_mun = $obj_municipio_pub->extraer_dato()) > 0) {
    ?>
                        <option value="<?php echo $arre_mun["cod_mun"]; ?>"><?php echo $arre_mun["nom_mun"]; ?></option>

                    <?php }?>
                </select>

                <i class="fas fa-heart" onclick="favorito();"></i>
                <div class="chat"><i class="fas fa-comment" onclick="chat();"></i><br>         
                    <?php if ( $arre_usu['new_msj'] > 0) {
                        ?>
                            <i class="fas fa-circle" style="color:#45B39D; "></i>
                        <?php
                    }?>
                </div>

            </div>
        </nav>
    </div>

    <div id="main_page">
        <div class="content">

            <div class="inicio_content">

                <div class="feed">
                    <h1>Tiendas Disponibles</h1>
                    <!--<h3>¡¡Abierto!!</h3>-->
                    <hr>
                </div>
                <div class="cartas">
                <?php

$obj_tienda_pub->puntero = $obj_tienda_pub->mostrar();
while (($arre_tienda = $obj_tienda_pub->extraer_dato()) > 0) {

    if (isset($_SESSION["cod_usu"])) {
        $obj_sitio_fav->cod_tie = $arre_tienda['cod_tie'];
        $obj_sitio_fav->asignar_valor();
        $obj_sitio_fav->puntero = $obj_sitio_fav->consultar();
        $arre_sitio_f           = $obj_sitio_fav->extraer_dato();
        $checked                = ($arre_sitio_f["cod_tie"] != "") ? "checked" : "";
    }

    ?>

                <div class="card-body">
                    <a href="#" class="link_tie" onclick="tienda(<?php echo $arre_tienda['cod_tie']; ?>);">
                        <div class="card">
                            <div class="title-card">
                                <h2 class="name-card"><?php echo $arre_tienda["raz_tie"]; ?></h2>

                            </div>
                            <div class="img-card">
                                <img class="logo-card" src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
                            </div>
                    </a>
                            <div class="text-card">
                            <div class="category-part"><h3 class="category-card"><?php echo $arre_tienda["nom_cat_tie"]; ?></h3></div>
                          <?php if (isset($_SESSION["cod_usu"])) {?>

                            <?php
                                            if ($arre_sitio_f["tienda_cod_tie"] > 0) {
                                                $color = '#F4D03F';
                                            } else {
                                                $color = '#000000';
                                            }

                                            ?>
                               <div class="check-fav"><input type="checkbox" <?php echo $checked; ?> id="cod_tie_fav" onclick="add_sitios_favoritos('<?php echo $arre_tienda['raz_tie']; ?>',<?php echo $arre_tienda['cod_tie']; ?>);" /> <i class="fas fa-bookmark"  id="des_bot" style="color: <?php echo $color; ?>"></i></div>
                           <?php }?>
                                <div class="horary-part">
                                <h5 class="horary-card"><i class="far fa-clock"></i> <?php echo $arre_tienda["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tienda["hor_sab_hor_tie"]; ?></h5>
                                </h5>
                                </div>
                            </div>

                            <p class="sec_mun"><i class="fas fa-map-marker-alt"></i> <?php echo $arre_tienda["nom_sec"]; ?> - <?php echo $arre_tienda["nom_mun"]; ?></p>
                        </div>
                    </div>

                <?php }?>
                </div>
            </div>

        </div>
   

    <div><br></div>

    <div><br></div>


    <div class="nav_bottom">
        <div class="bottom_items">
            <a href="./menu.php?mun=<?php echo $_GET["mun"] ?>" class="item"><i class="fas fa-home"></i></a>
            <a href="#" class="item" onclick="buscador(<?php echo $_GET['mun'] ?>);"><i class="fas fa-search"></i></a>
            <a href="#" class="item" onclick="carrito();"><i class="fas fa-shopping-cart"></i></a>
            <a href="#" class="item" onclick="pedidos();"><i class=" fas fa-shopping-bag"></i></a>
            <a href="#" class="item" onclick="usuario();"><i class="fas fa-user"></i></a>

        </div>
    </div>


<div  id="notificacion"></div>
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
<?php if (isset($_SESSION["cod_usu"])){
     require "../../backend/ajax/notificacion/act_notificacion.php" ;
} ?>

</body>
