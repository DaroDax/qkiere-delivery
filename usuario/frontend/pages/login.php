<?php
//IP
if (empty($_POST['checkip'])) {
    $ippais = $_SERVER["REMOTE_ADDR"];
} else {
    $ippais = $_POST['checkip'];
}
//Datos de google

//Include Configuration File
include '../../../login_email/config.php';

$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

if (!isset($_SESSION['access_token'])) {
    $login_button = '<img src="https://img.icons8.com/fluent/48/000000/google-logo.png" class="google_icon"/> <a href="' . $google_client->createAuthUrl() . '" class="token_google">Iniciar Con Google</a>';
}
//Inicio de sesion con google


$email = $_SESSION['user_email_address'];
$nombre =  $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];

if (isset($email)) {
    require_once "../../backend/clase/sesion.class.php";
    $obj_sesion          = new sesion;
    $obj_sesion->ema_usu = $email;
    $obj_sesion->asignar_valor();
    $obj_sesion->puntero = $obj_sesion->validar_sesion_email();

    while (($arre_usu = $obj_sesion->extraer_dato()) > 0) {

        $cod_usu = $arre_usu["cod_usu"];
        $ema_usu = $arre_usu["ema_usu"];
        $nom_usu = $arre_usu["nom_usu"];
    }

    if ($cod_usu > 0) {
        session_start();
        $_SESSION["cod_usu"] = $cod_usu;
        $_SESSION["ema_usu"] = $ema_usu;
        $_SESSION["nom_usu"] = $nom_usu;
        setcookie("cod_usu", $cod_usu, time() + (60 * 60 * 24 * 365), "/");
        setcookie("nom_usu", $ema_usu, time() + (60 * 60 * 24 * 365), "/");
        setcookie("nom_usu", $nom_usu, time() + (60 * 60 * 24 * 365), "/");

        header("Location: ./menu.php");

    } else {
        setcookie("cod_usu", "", time() - 1000, "/");
        setcookie("ema_usu", "", time() - 1000, "/");
        setcookie("nom_usu", "", time() - 1000, "/");
        ?>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script>
                                    function crear_google(){
                                        var ema_usu = "<?php echo $email; ?>";
                                        var nom_usu = "<?php echo $nombre; ?>";
                                        //alert(ema_usu + " " +nom_usu);
                                        var parametros="ema_usu="+ema_usu+"&&nom_usu="+nom_usu+"&&accion=insertar_email";
                                        $.ajax({
                                        data:parametros,
                                        url:"../../backend/controlador/reg_usu/usuario.php",
                                        type:"POST",
                                        success: function(response){
                                            console.log("Entro!");
                                              location.reload();
                                                }
                                        });
                                    }
                                    crear_google();
                            </script>
                            <?php
        }
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
    <link rel="icon" href="../../../img/64.png" type="image/png" />
    <link href="../icons/css/all.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link href="../css/menu.css" rel="stylesheet">
    <link href="../icons/css/all.css" rel="stylesheet">
    <!------>

    <!--Sweet-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!------->

    <!--JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-------------->
</head>

<body>

    <script>
        function guardar_ip(){
    let ip = $("#cod_ip").val();
    let user = $("#ema_usu").val();
    var parametros = "ip_log="+ip+"&&ema_usu_log="+user+"&&accion=add_ip";
    //alert(parametros);
    $.ajax({
        data:parametros,
        url:"../../backend/controlador/usuario_pub/usuario_pub.php",
        type:"POST",
        success: function(response){
        }
    });
}

        function crear_cuenta() {
            if ($('#nom_usu').val() == "" || $('#phone_N').val() == "" || $('#tel_usu').val() == "" || $('#ema_usu_new').val() == "" || $('#pas_usu_new').val() == "") {
                Swal.fire("Error!", "Hay Campos Vacios", "warning");
                return false;
            }
            var nom_usu = $('#nom_usu').val();
            var cod_area_usu = $('#phone_N').val();
            var tel_usu = $('#tel_usu').val();
            var ema_usu = $('#ema_usu_new').val();
            var pas_usu = $('#pas_usu_new').val();
            var cod_sug_usu = $('#cod_sug_usu').val();
            alert("nom_usu" + nom_usu + " phone_N" + cod_area_usu + "tel_usu " + tel_usu + "ema_usu " + ema_usu + "pas_usu " + pas_usu);
           
            var parametros = "nom_usu=" + nom_usu + "&&cod_area_usu=58&&tel_usu=000-000-0000&&ema_usu=" + ema_usu + "&&pas_usu=" + pas_usu + "&&cod_sug_usu=" + cod_sug_usu + "&&accion=insertar";
            $.ajax({
                data: parametros,
                url: "../../backend/controlador/reg_usu/usuario.php",
                type: "POST",
                success: function(response) {
                    Swal.fire("Bien Hecho!", "Cuenta Creada Con Exito", "success");
                    $('#nom_usu').val('');
                    $('#phone_N').val('');
                    $('#tel_usu').val('');
                    $('#ema_usu_new').val('');
                    $('#pas_usu_new').val('');
                }
            });
        }
    </script>

    <script>
        function next_step() {
            let municipio = $('#municipios').val();
            location.href = "frontend/pages/menu.php?mun=" + municipio;
        }
    </script>

    <script>
        function login() {
            $('.iniciar_sesion').show();
            $('.registrarse').hide();
        }

        function regis() {
            $('.registrarse').show();
            $('.iniciar_sesion').hide();
        }
    </script>

    <script>
        function consulta_email(){
    texto = $("#ema_usu_new").val();
    var parametros = "texto="+texto.replace(/ /g, "");
//alert(parametros);
console.log(parametros);
        $.ajax({
        data:parametros,
        url:"consulta.php",
        type:"POST",
        success: function(response){
        console.log(response);
        if(response>0){
            $("#validar_email").css("color","red");
            $("#registrar").hide("slow");
            $("#validar_email").html("Ya Existe Esta Cuenta de Correo");
        }else{
            $("#validar_email").css("color","green");
            $("#registrar").show("slow");
            $("#validar_email").html("Cuenta de Correo Disponible");
         }
        }
    });
}
    </script>

    <div class="nav_menu">
        <nav class="navigation">
            <div class="nav-items">
                <img src="../../../img/64.png" alt="" class="intercod_img">
                <h1 class="intercod_h1">Q'KIERE</h1>


            </div>
        </nav>
    </div>

    <div id="main_page">
        <div class="page_content">

            <div class="item-box">

                <div class="title">
                    <div class="iniciar" onclick="login();">
                        <h3>Iniciar</h3>
                    </div>

                    <div class="divider">
                        <h3>|</h3>
                    </div>

                    <div class="registrar" onclick="regis();">
                        <h3>Registrar</h3>
                    </div>
                </div>

                <div class="google_account">
                    <div class="gmail_part">
                        <?php
                        if ($login_button == '') {
                            echo '<div align="center" class="google_items">' . $login_button . '</div>';
                        } else {
                            echo '<div align="center" class="google_items">' . $login_button . '</div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="iniciar_sesion">
                    <br>
                    <hr>
                    <form name="form" action="../../backend/controlador/sesion/sesion.php">
                        <input type="hidden" name="accion" value="sesion" />
                        <input type="hidden" id="cod_ip" value="<?php echo $ippais; ?>">
                        <div class="iniciar_items">
                            <input type="text" class="form-control" name="ema_usu" id="ema_usu" placeholder="Correo Electrónico" required />
                            <input type="password" class="form-control" name="pas_usu" id="pas_usu" placeholder="Contraseña" required />
                            <input type="submit" id="Iniciar" class="final_button" value="Iniciar Sesión" onclick="guardar_ip()";/>
                        </div>
                    </form>
                </div>

                <div class="registrarse" style="display:none">
                    <div class="registrar_items">
                        <div class="nom">
                            <input type="text" class="form-control" id="nom_usu" required placeholder="Nombre y Apellido*">
                        </div>
                        <div class="pas">
                            <input type="password" class="form-control" id="pas_usu_new" required placeholder="Contraseña*">
                        </div>
                        <div class="ema">
                            <input type="email" class="form-control" id="ema_usu_new" required placeholder="Em@il*" onkeyup="consulta_email();">
                        </div>
                        <div id="validar_email"></div>
                        <!--<div class="tel">
                            <select name="cod_area_usu" class="form-control" id="phone_N">
                                <option value="58">+58</option>
                                <option value="57">+57</option>
                            </select>
                            <input type="number" class="form-control" id="tel_usu" required placeholder="Telefono*">
                        </div>-->

                        <a href="#" onclick="crear_cuenta();" id="registrar" class="final_button">¡¡Registrarse!!</a>
                    </div>
                </div>

                <div class="play-store-box">
                    <h2 class="info-text">Descarga Nuestra APP</h2>
                    <a href="https://play.google.com/store/apps/details?id=com.qkiere&hl=es_VE&gl=US"><img src="../../../img/googleplay.png" alt=""></a>
                </div>
            </div>

        </div>
    </div>

    <div class="nav_bottom">
        <div class="bottom_bar">



        </div>
    </div>

<script type="text/javascript">
     if(<?php echo $_GET["val"] ?>==2){
     Swal.fire("Error!", "¡¡Usuario o clave incorrectos!! ", "warning");
        }

  if(<?php echo $_GET["val"] ?>==3){
     Swal.fire("Error!", "¡¡Su Sesión ha caducado!! ", "warning");
        }
        /* CONSULTA DE INICIO */
    </script>

</body>