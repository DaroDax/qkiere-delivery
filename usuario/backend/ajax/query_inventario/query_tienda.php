<?php

session_start();
if (isset($_SESSION ["cod_usu"])){

    require_once("../../clase/inventario.class.php");
    require_once("../../clase/producto_favorito.class.php");
 $obj_producto_fav= new producto_favorito;
  

 $obj_inventario= new inventario;
 $obj_inventario->tienda_cod_tie=$_GET["id"];
 $obj_inventario->asignar_valor();
 $obj_inventario->puntero=$obj_inventario->listar();
 

  ?>


  
  <div class="table-responsive" >
           <div class="col-lg-6 col-md-5 col-sm-7 col-xs-12">
                <div class="tab-content">
                <?php 
                    while(($arre_inv=$obj_inventario->extraer_dato())>0)
        { 
             $cod_i=$arre_inv["cod_inv"];
    $obj_producto_fav->cod_inv=$arre_inv["cod_inv"];
    $obj_producto_fav->asignar_valor();
    $obj_producto_fav->puntero=$obj_producto_fav->consultar();
    $arre_producto_f=$obj_producto_fav->extraer_dato();
    ${"checked_producto" . $arre_inv["cod_inv"]} = ($arre_producto_f["cod_tie"]!="")?"checked":"";
                     ?>
                     

                    <div id="<?php echo $arre_inv["nom_cat_pro"]; ?>" class=" tab-pane active ">
                        <div class="item_list">
                            <div class="pizza_items fifth_items">
                                <ul>
                                   
                                    <li>
                                        <div class="P_itmesbox">
                                            <div class="PT_image">
                                            

                                                <img id="Zoom" src="../../../images/inv_tienda/<?php echo $arre_inv["img_inv"];?>" class="absoImg" alt="">

                                             


                                            </div>
                                            <div class="PT_dscr">
                                                <h3 class="PT_title" value="<?php echo $arre_inv["nom_inv"];?>" id="item"><?php echo $arre_inv["nom_inv"];?> </h3>
                                                <p class="PT_dtls"><?php echo $arre_inv["des_inv"];?></p>
                                               
                                                <div class="price_block"> 
                                                    <div class="price">$ <?php 
                                                echo $pesos = number_format($arre_inv["pre_inv"], 0, ",", "." );
                                                ?> </div>
                                                <?php 

                                                    
                                                    if($arre_inv["can_inv"]>0) { ?>                                                                                                  
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_cart" onclick="carga_ajax('<?php echo $arre_inv['cod_inv']; ?>','add_cart','modals/modal_add_cart.php');" class="card_btn">Agregar</a>
                                                <?php }else{ echo "<div class='text-red'>Producto no Disponible.</div>"; } ?>
                                            </div>

                                            <div class="heart">
                                    <input type="checkbox" id="cod_inv" name="cod_inv<?php echo $arre_inv["cod_inv"];?>"
                                    value="<?php echo $arre_inv["cod_inv"];?>" <?php echo ${"checked_producto" . $arre_inv["cod_inv"]} ?> 
                                    onclick="add_producto_favorito('<?php echo $arre_inv['cod_inv']; ?>',this.checked);" />

                                                <?php
                                                  if (${"checked_producto" . $arre_inv["cod_inv"]}==true){    
                                                      $color= '#E74C3C';
                                                    }else{
                                                     $color= '#000000';
                                                    }

                                                ?>

                                                <i class="fa fa-heart"  id="fav_bot" aria-hidden="" style="color: <?php echo $color; ?>" ></i>
                                                </div>
                                                <div class="time" style="text-align: right; color:#6BB2ED; font-weight: 600;">Tiempo Estimado:<p
                                                     style="color:#000; display: inline-block;">
                                                (Hr,Mt,Sg)</p><p><?php echo $arre_inv["tie_inv"];?></p></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>



        <script src="../js/fav.js" defer></script>
        <script>
 function favor(){
         var valida_check_he=document.getElementById("cod_inv").checked;
         var intro = document.getElementById('fav_bot');
        if (valida_check_he==true){ 	
		intro.style.color = '#E74C3C';
	}else{
        intro.style.color = '#000000';
        }

    }

    window.onload = favor();
 
 </script>



<?php
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>