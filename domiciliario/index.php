<?php

require_once("./backend/clase/sesion.class.php");

 if (isset($_COOKIE["cod_dom"]) && isset($_COOKIE["ema_dom"]) && isset($_COOKIE["nom_dom"]) && isset($_COOKIE["ape_dom"]) && isset($_COOKIE["pas_dom"]) && isset($_COOKIE["chat_id_dom"])) {

 $ema_dom=$_COOKIE["ema_dom"];
 $clave=$_COOKIE["pas_dom"];

                        $obj_sesion = new sesion;
                        $obj_sesion->ema_dom = $ema_dom;
                        $obj_sesion->pas_dom=$clave;
                        $obj_sesion->asignar_valor();
                        $obj_sesion->puntero = $obj_sesion->validar_sesion2();

                         while(($arre_dom = $obj_sesion->extraer_dato()) > 0 ){

                                $cod_dom=$arre_dom["cod_dom"]; 
                                $ema_dom=$arre_dom["ema_dom"]; 
                                $pas_dom=$arre_dom["pas_dom"]; 
                                $nom_dom=$arre_dom["nom_dom"]; 
                                $ape_dom=$arre_dom["ape_dom"];
                                $chat_id_dom=$arre_dom["chat_id_dom"];
                                $cod_mun=$arre_dom["cod_mun"];
                                $tienda_cod_tie=$arre_dom["tienda_cod_tie"];
                        }
                     
                    if($cod_dom>0){
                        session_start();
                                $_SESSION ["cod_dom"] =  $cod_dom;
                                $_SESSION ["ema_dom"] =  $ema_dom;
                                $_SESSION ["pas_dom"] =  $pas_dom;
                                $_SESSION ["nom_dom"] =  $nom_dom;
                                $_SESSION ["ape_dom"] =  $ape_dom;
                                $_SESSION ["cod_mun"] =  $cod_mun;
                                $_SESSION ["chat_id_dom"] =  $chat_id_dom;
                                $_SESSION ["tienda_cod_tie"] =  $tienda_cod_tie;
                            setcookie("cod_dom",$cod_dom,time()+(60*60*24*365),"/");
                            setcookie("ema_dom",$ema_dom,time()+(60*60*24*365),"/");
                            setcookie("pas_dom",$pas_dom,time()+(60*60*24*365),"/");
                            setcookie("nom_dom",$nom_dom,time()+(60*60*24*365),"/");
                            setcookie("ape_dom",$ape_dom,time()+(60*60*24*365),"/");
                            setcookie("chat_id_dom",$chat_id_dom,time()+(60*60*24*365),"/");
                            setcookie("cod_mun",$cod_mun,time()+(60*60*24*365),"/");
                            setcookie("tienda_cod_tie",$tienda_cod_tie,time()+(60*60*24*365),"/");
                                     
                                header("Location: frontend/pages/menu.php"); 
                     //   print "<script>alert(\"Acceso invalido.\");window.location='index.php';</script>";
                    }else{
                        setcookie("cod_dom","",time()-1000,"/");
                        setcookie("ema_dom","",time()-1000,"/");
                        setcookie("pas_dom","",time()-1000,"/");
                        setcookie("nom_dom","",time()-1000,"/");
                        setcookie("ape_dom","",time()-1000,"/");
                        setcookie("chat_id_dom","",time()-1000,"/");
                        setcookie("cod_mun","",time()-1000,"/");
                        setcookie("tienda_cod_tie","",time()-1000,"/");
                        header("Location: index.php?val=3");
                    }

}
    
/*------------------FIN DE LA FUNCION DE SESION------------------------*/

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
    <link href="frontend/css/login.css?2" rel="stylesheet">
    <link href="frontend/css/menu.css?5" rel="stylesheet">
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
                <img src="../img/64.png" alt="" class="intercod_img">
                <h1 class="intercod_h1">Domiciliario</h1>


            </div>
        </nav>
    </div>

    <div id="main_page">
        <div class="page_content">

            <div class="item-box">

                <div class="title">
                    <div class="iniciar" onclick="login();">
                        <h3>Iniciar Sesión</h3>
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
                                <input type="text" class="form-control" name="ema_dom" id="ema_dom" placeholder="Correo Electrónico" value="" required />
                                <input type="password" class="form-control" name="pas_dom" id="pas_dom" placeholder="Contraseña" value="" required />
                                <input type="submit" id="Iniciar" class="final_button" value="Acceder" />

                </div>
                </form>
            </div>

            <!--<div class="registrarse" style="display:none">
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
                    <div class="tel">
                        <select name="cod_area_usu" class="form-control" id="phone_N">
                            <option value="58">+58</option>
                            <option value="57">+57</option>
                        </select>
                        <input type="number" class="form-control" id="tel_usu" required placeholder="Telefono*">
                    </div>

                    <div class="cat_tie">
                        <select class="form-control" id="cat">
                                <option value="0">-¿Que Vendes?-</option>
                                <?php
//$obj_categoria_tienda->puntero = $obj_categoria_tienda->listar();
//while (($arre_cat = $obj_categoria_tienda->extraer_dato()) > 0) {
    ?>
                                            <option value="<?php echo $arre_cat["cod_cat_tie"]; ?>"><?php echo $arre_cat["nom_cat_tie"]; ?></option>
                                        <?php //}?>
                            </select>
                    </div>

                    <div class="mun">
                        <select class="form-control" id="lugar" onchange ="consultar_sector();">
                                <option>¿Donde Te Ubicas?</option>
                                <?php
//$obj_municipio_pub->puntero = $obj_municipio_pub->listar();
//while (($arre_muni = $obj_municipio_pub->extraer_dato()) > 0) {
    ?>
                                            <option value="<?php echo $arre_muni["cod_mun"]; ?>"><?php echo $arre_muni["nom_mun"]; ?></option>
                                        <?php //}?>
                            </select></div>

                            <div id="sector"></div>

                    <a href="#" onclick="crear_tienda();" id="registrar" class="final_button">¡¡Registrarse!!</a>
                </div>
            </div>-->

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