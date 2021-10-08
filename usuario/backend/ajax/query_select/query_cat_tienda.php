<?php

session_start();
if (isset($_SESSION ["cod_usu"])){

require_once("../../clase/categoria_tienda.class.php");  
require_once("../../clase/usuario.class.php");

 $obj_usuario = new usuario; 

 $obj_categoria_tie= new categoria_tienda;
 $obj_categoria_tie->cod_mun=$_POST["municipio"];

 $obj_categoria_tie->asignar_valor();
 $obj_categoria_tie->puntero=$obj_categoria_tie->listar_select();

?>
<input type="hidden" value="$_POST['municipio'];">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php   $obj_usuario->puntero = $obj_usuario->select_opcion();
                                                         $arre_ubi = $obj_usuario->extraer_dato();
                                                                ?>
<script>jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
    });
});

$("#cat_tienda > option[value=<?php echo $arre_ubi["lon_miu"];?>]").attr("selected",true);
</script>


            <select name="cat_tienda" id="cat_tienda" class="mi-selector" onchange="consulta_sitios();" class="selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="">---Categoria---</option>
                <?php 
                    while(($arre_cat=$obj_categoria_tie->extraer_dato())>0) {  ?>
                    <option value="<?php echo $arre_cat["cod_cat_tie"]; ?>">
                        <?php echo $arre_cat["nombre_cat"]; ?>
                    </option>
                <?php } ?>
             
            </select>
<?php
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>