<?php
session_start();
require_once("backend/clase/municipio_pub.class.php");
$obj_municipio_pub = new municipio_pub;

require_once("backend/clase/sesion.class.php");



            //Iniciar con Cookies
            if (isset($_COOKIE["cod_usu"]) && isset($_COOKIE["ema_usu"]) && isset($_COOKIE["pas_usu"]) && isset($_COOKIE["nom_usu"])) {

                $ema_usu = $_COOKIE["ema_usu"];
                $clave   = $_COOKIE["pas_usu"];

                $obj_sesion          = new sesion;
                $obj_sesion->ema_usu = $ema_usu;
                $obj_sesion->pas_usu = $clave;
                $obj_sesion->asignar_valor();
                $obj_sesion->puntero = $obj_sesion->validar_sesion2();

                while (($arre_usu = $obj_sesion->extraer_dato()) > 0) {

                    $cod_usu = $arre_usu["cod_usu"];
                    $ema_usu = $arre_usu["ema_usu"];
                    $pas_usu = $arre_usu["pas_usu"];
                    $nom_usu = $arre_usu["nom_usu"];
                }

                if ($cod_usu > 0) {
                    session_start();
                    $_SESSION["cod_usu"] = $cod_usu;
                    $_SESSION["ema_usu"] = $ema_usu;
                    $_SESSION["pas_usu"] = $pas_usu;
                    $_SESSION["nom_usu"] = $nom_usu;
                    setcookie("cod_usu", $cod_usu, time() + (60 * 60 * 24 * 365), "/");
                    setcookie("nom_usu", $ema_usu, time() + (60 * 60 * 24 * 365), "/");
                    setcookie("pas_usu", $pas_usu, time() + (60 * 60 * 24 * 365), "/");
                    setcookie("nom_usu", $nom_usu, time() + (60 * 60 * 24 * 365), "/");

                    header("Location: frontend/pages/menu.php");
                    //   print "<script>alert(\"Acceso invalido.\");window.location='index.php';</script>";
                } else {
                    setcookie("cod_usu", "", time() - 1000, "/");
                    setcookie("ema_usu", "", time() - 1000, "/");
                    setcookie("pas_usu", "", time() - 1000, "/");
                    setcookie("nom_usu", "", time() - 1000, "/");
                    header("Location: index.php");
                }
            }

if (isset($_SESSION['cod_usu'])){
 
    require_once("backend/clase/usuario.class.php");
    $obj_usuario = new usuario;
    $obj_usuario->puntero=$obj_usuario->listar();
    $arre_usu=$obj_usuario->extraer_dato();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->

    <!--Fuentes-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">


    <!------------>
    <link rel="icon" href="../img/64.png" type="image/png" />
    <link href="icons/css/all.css" rel="stylesheet">
    <link href="frontend/css/styles.css" rel="stylesheet">
    <link href="frontend/css/index.css" rel="stylesheet">
    <link href="frontend/css/menu.css" rel="stylesheet">
    <link href="frontend/icons/css/all.css" rel="stylesheet">
    <!------>

    <!--JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-------------->
</head>

<body>

    <script>
        function autoload(){
        location.href = "frontend/pages/menu.php?mun=";
    }

    window.onload = autoload();
    </script>
    <script>
        function next_step() {
            let municipio = $('#municipios').val();

            location.href = "frontend/pages/menu.php?mun=" + municipio;
        }
    </script>

    <div class="nav_menu">
        <nav class="navigation">
            <div class="nav-items">
                <img src="../img/64.png" alt="" class="intercod_img">
                <h1 class="intercod_h1">Q'KIERE</h1>

            </div>
        </nav>
    </div>

    <div id="main_page">
        <div class="page_content">

            <div class="item-box"><?php echo "Hola, ".$arre_usu["nom_usu"]; ?>
                <div class="title"><i class="fas fa-map-marker-alt"></i> - ¿Donde Estas?</div>
                <div class="select-box">
                    <select class="form-control" name="mun" id="municipios" onchange="next_step();">
                        <option>-Tu Ubicacion-</option>
                        <?php
                        $obj_municipio_pub->puntero = $obj_municipio_pub->listar();
                        while (($arre_muni = $obj_municipio_pub->extraer_dato()) > 0) {
                        ?>
                            <option value="<?php echo $arre_muni["cod_mun"]; ?>"><?php echo $arre_muni["nom_mun"]; ?></option>
                        <?php } ?>

                    </select>
                    </select>
                </div>
                <br>
                <hr>
                <br>

                <div class="play-store-box">
                    <h2 class="info-text">Descarga Nuestra APP</h2>
                    <a href="https://play.google.com/store/apps/details?id=com.qkiere&hl=es_VE&gl=US"><img src="../img/googleplay.png" alt=""></a>
                </div>
            </div>

        </div>
    </div>

    <div class="nav_bottom">
        <div class="bottom_bar">



        </div>
    </div>

</body>