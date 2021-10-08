<?php

session_start();
if (isset($_SESSION["cod_usu"])) {
  


    require_once("../../clase/usuario.class.php");
    require_once("../../clase/municipio.class.php");
    require_once("../../clase/sector.class.php");

    $obj_usuario = new usuario;
    $obj_usuario->puntero = $obj_usuario->listar();
    $arre_usuario = $obj_usuario->extraer_dato();

    $obj_usuario->puntero = $obj_usuario->hay_direccion();
    $arre_usu_dir = $obj_usuario->extraer_dato();

    $obj_municipio = new municipio;
    $obj_municipio->puntero = $obj_municipio->listar();
    $arre_municipio = $obj_usuario->extraer_dato();

    $obj_sector = new sector;
?>

 <label for="Address">Dirección de entrega<span>*</span></label>
     <?php

    if ($arre_usu_dir["cont_direccion"] > 0) { ?>

    <?php if ($arre_usu_dir["cont_direccion"] <='5'){ ?>

        <a href="javascript:void(0);" data-toggle="modal" data-target="#add_dir" 
                onclick="carga_ajax('<?php echo $arre_usu_dir['cont_direccion']; ?>','add_dir','modals/modal_add_dir.php');"> 
                <i class="fas fa-plus-square" ></i>
        </a>
            <?php } else{
                echo "Haz alcanzado todas tus direcciones";
            }
            ?>


        <select class=" form-control" name="direccion" id="dir">
            <option value="">--Selecciona tu direccion--</option>


            <?php

            $obj_usuario->puntero = $obj_usuario->misDirecciones();
            while (($arre_usu = $obj_usuario->extraer_dato()) > 0) {
            ?>

                <option value="<?php echo $arre_usu['cod_dir_usu']; ?>"><?php echo $arre_usu['nom_dir_usu']; ?></option>

            <?php } ?>


            </select>
        <?php } else {  ?>
                                        
        <a href="javascript:void(0);" data-toggle="modal" data-target="#add_dir" 
            onclick="carga_ajax('<?php echo $arre_usu_dir['cont_direccion']; ?>','add_dir','modals/modal_add_dir.php');" class="editBAbtn hvr-float-shadow"> 
            Agregar Dirección
        </a>
                                        
 <?php } 

} else {
    header("location: ../index.php");
    exit();
}
?>