<?php
require_once("backend/clase/categoria_tienda.class.php"); 
require_once("backend/clase/sector_pub.class.php"); 
require_once("backend/clase/municipio_pub.class.php"); 
require_once("backend/clase/sesion.class.php");


 if (isset($_COOKIE["cod_tie"]) && isset($_COOKIE["ema_tie"]) && isset($_COOKIE["pas_tie"])) {
   

 $ema_tie=$_COOKIE["ema_tie"];
 $clave=$_COOKIE["pas_tie"];

                        $obj_sesion = new sesion;
                        $obj_sesion->ema_tie = $ema_tie;
                        $obj_sesion->pas_tie=$clave;
                        $obj_sesion->asignar_valor();
                        $obj_sesion->puntero = $obj_sesion->validar_sesion2();

                         while(($arre_tie = $obj_sesion->extraer_dato()) > 0 ){

                                $cod_tie=$arre_tie["cod_tie"]; 
                                $ema_tie=$arre_tie["ema_tie"]; 
                                $pas_tie=$arre_tie["pas_tie"]; 
                                $raz_tie=$arre_tie["raz_tie"]; 
                                $cha_id_tie=$arre_tie["cha_id_tie"];
                        }
                     
                    if($cod_tie>0){
                        session_start();
                                $_SESSION ["cod_tie"] =  $cod_tie;
                                $_SESSION ["ema_tie"] =  $ema_tie;
                                $_SESSION ["pas_tie"] =  $pas_tie;
                                $_SESSION ["raz_tie"] =  $raz_tie;
                                $_SESSION ["cha_id_tie"] =  $cha_id_tie;
                            setcookie("cod_tie",$cod_tie,time()+(60*60*24*365),"/");
                            setcookie("nom_tie",$ema_tie,time()+(60*60*24*365),"/");
                            setcookie("pas_tie",$pas_tie,time()+(60*60*24*365),"/");
                            setcookie("raz_tie",$raz_tie,time()+(60*60*24*365),"/");
                            setcookie("cha_id_tie",$cha_id_tie,time()+(60*60*24*365),"/");
                                     
                                header("Location: frontend/pages/menu.php"); 
                     //   print "<script>alert(\"Acceso invalido.\");window.location='index.php';</script>";
                    }else{
                        setcookie("cod_tie","",time()-1000,"/");
                        setcookie("ema_tie","",time()-1000,"/");
                        setcookie("pas_tie","",time()-1000,"/");
                        setcookie("raz_tie","",time()-1000,"/");
                        setcookie("cha_id_tie","",time()-1000,"/");
                        header("Location: index.php?val=3");
                    }

}

//Datos de google

//Include Configuration File
/*include '../login_email/config.php';

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
}*/
//Inicio de sesion con google

require_once "backend/clase/categoria_tienda.class.php";
require_once "backend/clase/municipio_pub.class.php";
$obj_categoria_tienda = new categoria_tienda;
$obj_municipio_pub    = new municipio_pub;

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
  <meta name="theme-color" content="#FF6A00">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="shortcut icon" type="image/png" href="../img/192.png">
  <link rel="apple-touch-icon" href="../img/192.png">
  <link rel="apple-touch-startup-image" href="../img/192.png">
  <link rel="manifest" href="./manifest.json">
  <script src="./script.js"></script>

    <!--Fuentes-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">


    <!------------>
    <link rel="icon" href="../img/64.png" type="image/png" />
    <link href="frontend/icons/css/all.css" rel="stylesheet">
    <link href="frontend/css/styles.css" rel="stylesheet">
    <link href="frontend/css/index.css" rel="stylesheet">
    <link href="frontend/css/login.css" rel="stylesheet">
    <link href="frontend/css/menu.css" rel="stylesheet">
    <link href="frontend/icons/css/all.css" rel="stylesheet">
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
        
    </script>

    <script>function consultar_sector(){
    alert($('#lugar').val());
$.ajax({
            type:"POST",
            url:"backend/ajax/query_direccion/sector_pub.php",//en el servidor acuerdate de quitarle delivery
            data:"cod_mun=" + $('#lugar').val(),
            success:function(r){
                $('#sector').html(r);

                    }
                });
}
</script>

<script>
    function crear_tienda(){
    if($('#nom_usu').val()=="" || $('#ema_usu_new').val()=="" || $('#pas_usu_new').val()==""  || $('#cat').val()=="0" || $('#cod_sector').val()=="0" || $('#mun').val()=="0")
    {   
        Swal.fire("Error!", "Hay Campos Vacios", "warning");
        return false;
    }
    var raz_tie=$('#nom_usu').val();
    var ema_tie=$('#ema_usu_new').val();
    var pas_tie=$('#pas_usu_new').val();
    var categoria=$('#cat').val();
    var sector=$('#cod_sector').val();

  alert("tip_doc_tie=V&&raz_tie="+raz_tie+"&&rif_tie=29-000-000&&tel_tie=58-000-000-0000&&tel2_tie=00000000&&ema_tie="+ema_tie+"&&pas_tie="+pas_tie+"&&dir_tie=Ingrese Su Ubicacion Especifica&&categoria_tienda_cod_cat_tie="+categoria+"&&sector_cod_sec="+sector+"&&log_tie=Null&&accion=insertar");

    var parametros="tip_doc_tie=V&&raz_tie="+raz_tie+"&&rif_tie=29-000-000&&tel_tie=58-000-000-0000&&tel2_tie=00000000&&ema_tie="+ema_tie+"&&pas_tie="+pas_tie+"&&dir_tie=Ingrese Su Ubicacion Especifica&&categoria_tienda_cod_cat_tie="+categoria+"&&sector_cod_sec="+sector+"&&log_tie=Null&&accion=insertar";

        $.ajax({ 
        data:parametros,
        url:"backend/controlador/reg_tie/tienda.php",
        type:"POST",
        success: function(response){
            Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Cuenta creada con exito',
                        showConfirmButton: false,
                        timer: 1500
                    });
             $('#nom_usu').val('');
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
        if(response>0){
            console.log(response);
            $("#validar_email").css("color","red");
            $("#registrar").hide("slow");
            $("#validar_email").html("Ya existe esta dirección de correo");
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
                <img src="https://qkiere.com/img/64.png" alt="" class="intercod_img">
                 
                <h1 class="intercod_h1">Q'KIERE | TIENDA</h1>


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

                <!--<div class="google_account">
                    <div class="gmail_part">
                        <?php
/*
if ($login_button == '') {
echo '<div align="center" class="google_items">' . $login_button . '</div>';
} else {
echo '<div align="center" class="google_items">' . $login_button . '</div>';
}
 */
?>
                    </div>
                </div>-->

                <div class="iniciar_sesion">
                    <br>
                    <hr>
                    <form role="form" action="./backend/controlador/sesion/sesion.php" method="POST">
                        <input type="hidden" name="accion" value="sesion" />

                            <div class="iniciar_items">
                                <input type="text" class="form-control" name="ema_tie" id="ema_usu" placeholder="Correo Electrónico" value="" required />
                                <input type="password" class="form-control" name="pas_tie" id="pas_usu" placeholder="Contraseña" value="" required />
                                <input type="submit" id="Iniciar" class="final_button" value="Acceder" />

                </div>
                </form>
            </div>

            <div class="registrarse" style="display:none">
                <div class="registrar_items">
                    <div class="nom">
                        <input type="text" class="form-control" id="nom_usu" required placeholder="Razón ó Nombre De La Tienda">
                    </div>
                    <div class="pas">
                        <input type="password" class="form-control" id="pas_usu_new" required placeholder="Contraseña*">
                    </div>
                    <div class="ema">
                        <input type="email" class="form-control" id="ema_usu_new" required placeholder="Correo Electronico" onkeyup="consulta_email();">
                    </div>
                    <div id="validar_email"></div>
                    <!--<div class="tel">
                        <select name="cod_area_usu" class="form-control" id="phone_N">
                            <option value="58">+58</option>
                            <option value="57">+57</option>
                        </select>
                        <input type="number" class="form-control" id="tel_usu" required placeholder="Telefono*">
                    </div>-->

                    <div class="cat_tie">
                        <select class="form-control" id="cat">
                                <option value="0">-¿Que Vendes?-</option>
                                <?php
$obj_categoria_tienda->puntero = $obj_categoria_tienda->listar();
while (($arre_cat = $obj_categoria_tienda->extraer_dato()) > 0) {
    ?>
                                            <option value="<?php echo $arre_cat["cod_cat_tie"]; ?>"><?php echo $arre_cat["nom_cat_tie"]; ?></option>
                                        <?php }?>
                            </select>
                    </div>

                    <div class="mun">
                        <select class="form-control" id="lugar" onchange ="consultar_sector();">
                                <option>¿Donde Te Ubicas?</option>
                                <?php
$obj_municipio_pub->puntero = $obj_municipio_pub->listar();
while (($arre_muni = $obj_municipio_pub->extraer_dato()) > 0) {
    ?>
                                            <option value="<?php echo $arre_muni["cod_mun"]; ?>"><?php echo $arre_muni["nom_mun"]; ?></option>
                                        <?php }?>
                            </select></div>

                            <div id="sector"></div>

                    <a href="#" onclick="crear_tienda();" id="registrar" class="final_button">¡¡Registrarse!!</a>
                </div>
            </div>

            <div class="play-store-box">
                <h2 class="info-text">Descarga Nuestra APP</h2>
                <a target="_blank" href="https://play.google.com/store/apps/details?id=com.qkiere&hl=es_VE&gl=US"><img src="https://qkiere.com/img/googleplay.png" alt=""></a>

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