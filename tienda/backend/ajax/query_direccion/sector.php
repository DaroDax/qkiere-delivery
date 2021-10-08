<?php

session_start();
if (isset($_SESSION ["cod_tie"])){

require_once("../../clase/sector.class.php");  

 $obj_sector= new sector;
 $obj_sector->cod_mun=$_POST["cod_mun"];

 $obj_sector->asignar_valor();


?>
           
        <select name="sector" class="form-control" required id="cod_sector">

            <?php
            $obj_sector->puntero = $obj_sector->listar();
            while (($arre_sector = $obj_sector->extraer_dato()) > 0) {
            ?>

                <option value="<?php echo $arre_sector['cod_sec']."-".$arre_sector['nom_sec']; ?>"><?php echo $arre_sector['nom_sec']; ?></option>
            <?php  } ?>

        </select>


<?php
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>