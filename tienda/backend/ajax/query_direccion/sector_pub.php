<?php

require_once("../../clase/sector_pub.class.php");  

 $obj_sector_pub= new sector_pub;
 $obj_sector_pub->cod_mun=$_POST["cod_mun"];

 $obj_sector_pub->asignar_valor();


?>
           
        <select name="sector" class="form-control" required id="cod_sector">
            <option value="0">¿En que parte?</option>
            <?php
            $obj_sector_pub->puntero = $obj_sector_pub->listar();
            while (($arre_sector_pub = $obj_sector_pub->extraer_dato()) > 0) {
            ?>

                <option value="<?php echo $arre_sector_pub['cod_sec']; ?>"><?php echo $arre_sector_pub['nom_sec']; ?></option>
            <?php  } ?>

        </select>


<?php
 
  ?>