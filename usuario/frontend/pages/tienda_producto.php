<?php
session_start();

require_once("../../backend/clase/tienda.class.pub.php");
require_once("../../backend/clase/inventario.pub.class.php");


$obj_tienda_pub = new tienda_pub;
$obj_tienda_pub->cod_tie = $_GET["cod_tie"];
$obj_tienda_pub->asignar_valor();
$obj_tienda_pub->puntero = $obj_tienda_pub->tienda();
$arre_tienda = $obj_tienda_pub->extraer_dato();

//$obj_inventario_pub = new inventario_pub;

if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  require_once("../../backend/clase/producto_favorito.class.php");
 $obj_producto_fav= new producto_favorito;
  $obj_usuario = new usuario;
}

?>

<head>
  <link href="../css/tienda_producto.css" rel="stylesheet">
  <link href="../css/modals/add_cart.css" rel="stylesheet">

     <!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../../backend/ajax/funcion/favoritos.js"></script>
    
    <!----Bootstrap important---->
  </head>

<body>

<div class="modal " id="add_cart" role="dialog"></div>

  <script type="text/javascript">
    function actualizar() {
      location.reload(true);
    }
    //Función para actualizar cada 4 segundos(4000 milisegundos)
   // setInterval("actualizar()",2000);

    function scrollear() {
      $('html, body').animate({
        scrollTop: $("#<?php echo $_GET["cod_inv"] ?>").offset().top
      }, 100);
    }
    window.onload = scrollear();

    /*function act (){
      cod_tie = "<?php echo $_POST["cod_tie"];?>";
      $.ajax({
      type:"POST",
      url:"../../../usuario/frontend/pages/tienda_producto.php?tienda=",
      data:"cod_tie="+cod_tie,
      success:function(r){
                 $('.inv_list').html(r); 
                 setInterval(act(), 10000);        
          }
      });
    }

    window.onload = act();*/
  </script>

  <div class="main">
    <div class="tienda_content">
      <div class="feed">
        <div class="inv_list">

          <?php $obj_tienda_pub->puntero = $obj_tienda_pub->inventario_tienda();
          while (($arre_inv = $obj_tienda_pub->extraer_dato()) > 0) {     
    ?>
          
            <div class="card" id="<?php echo $arre_inv["cod_inv"]; ?>">
              <div class="product-name">
                <img src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
                <a onclick="tienda(<?php echo $arre_inv['cod_tie']; ?>);">
                  <h2 class="pro_nom"><?php echo $arre_inv["raz_tie"]; ?></h2>
                </a>
              </div>

              <div class="img-card">
                <img src="../../../img/inv_tie/<?php echo $arre_inv["img_inv"]; ?>" alt="">
              </div>


              <div class="product-info">

                <div class="info-info">
                  <h2 class="pro_nom"><?php echo $arre_inv["nom_inv"]; ?></h2>
                  <h4 class="des_pro"><?php echo $arre_inv["des_inv"]; ?></h4>
                  <h5 class="pre_pro">$<?php echo $precio = number_format($arre_inv["pre_inv"], 0, ",", ".");  ?></h5>

                </div>
                <div class="info-pre">
                  <div>
                 <?php  if(isset($_SESSION["cod_usu"])){
                  
                  $obj_producto_fav->cod_tie = $_POST["cod_tie"];
                  $obj_producto_fav->asignar_valor();
                 $obj_producto_fav->puntero = $obj_producto_fav->listarXtienda();
                  while (($arre_pro_f = $obj_producto_fav->extraer_dato()) > 0){

                    if ($arre_pro_f["inventario_cod_inv"] == $arre_inv["cod_inv"]) {

                        ${"producto" .  $arre_inv["cod_inv"]} = "#C0392B";
                         ${"check" .  $arre_inv["cod_inv"]} = "checked";

                      }
                  ?>
                  <?php } ?>

                                    <input type="checkbox" id="cod_inv" name="cod_inv<?php echo $arre_inv["cod_inv"];?>"
                                    value="<?php echo $arre_inv["cod_inv"];?>" <?php echo ${'check' .  $arre_inv['cod_inv']}?>
                                    onclick="add_producto_favorito('<?php echo $arre_inv['cod_inv']; ?>',this.checked);" />
                                <i class="fa fa-heart"  id="fav_bot" aria-hidden="" style="color: <?php echo ${'producto'.$arre_inv['cod_inv']}; ?>" ></i>
                   
                  <?php } ?>


                  
                     </div>


                                                
                </div>
              </div>
              <div class="add-button">
                <?php  if($arre_inv["can_inv"]>0){ ?>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="button-a">Agregar</a>
          <?php }else{ echo "Producto no Disponible."; }?>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
  </div>
 
    <script src="../js/bootstrap.min.js"></script>
    <script src="./modals/idmodal.js"></script>

</body>

</html>
<?php ?>