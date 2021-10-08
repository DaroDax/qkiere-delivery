<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/usuario.class.php");

  $obj_usuario = new usuario;
  $obj_usuario->asignar_valor();
  $obj_usuario->puntero = $obj_usuario->misDirecciones();
  while (($arre_usu = $obj_usuario->extraer_dato()) > 0) {
?>

    <div class="dir-list">
      <div class="sup_dir_card">
        <div class="sup-items">
          <h5 class="dir-dir">Dirección#</h5>
          <div class="icons-dir">
            <i class="fas fa-edit"></i>
            <i class="far fa-minus-square"></i>
          </div>
        </div>

        <div class="buttom-items">
          <div class="but-info">
            <h3 class="nom-dir"><?php echo $arre_usu['nom_dir_usu']; ?></h3>
            <h4 class="des-dir"><?php echo $arre_usu['dir_dir_usu']; ?></h4>
            <h5 class="mun-dir"><?php echo $arre_usu["nom_mun"]; ?></h5>
            <h5 class="sec-dir"><?php echo $arre_usu['nom_sec']; ?></h5>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>
<?php } ?>