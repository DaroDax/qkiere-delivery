<?php

session_start();
if (isset($_SESSION ["cod_usu"])){

require_once("../../clase/sector.class.php");  

 $obj_sector= new sector;
 $obj_sector->cod_mun=$_POST["cod_mun"];

 $obj_sector->asignar_valor();


?>

              <h5>Sector</h5>
              <?php
            $obj_sector->puntero = $obj_sector->listar_2();
            $arre_sector = $obj_sector->extraer_dato();
            ?>
              
        <select name="sector" class="form-control" required id="cod_sector">
            <option value="<?php echo $arre_sector['cod_sec'];?>"><?php echo $arre_sector['nom_sec'];?></option>

            <?php
            $obj_sector->puntero = $obj_sector->listar();
            while (($arre_sector = $obj_sector->extraer_dato()) > 0) {
            ?>

                <option value="<?php echo $arre_sector['cod_sec']; ?>"><?php echo $arre_sector['nom_sec']; ?></option>
            <?php  } ?>

        </select>


<?php
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>