<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");
  $obj_usuario = new usuario;

?>
  <div class="dir-list">
    <select name="mi_dir" id="mi_ubi">
      <option value="">--Mis Direcciones--</option>

      <?php

      $obj_usuario->puntero = $obj_usuario->misDirecciones();
      while (($arre_usu = $obj_usuario->extraer_dato()) > 0) {
      ?>
        <option value="<?php echo $arre_usu['cod_dir_usu']; ?>"><?php echo $arre_usu['nom_dir_usu']; ?></option>
      <?php } ?>
    </select>
  </div>
<?php } ?>