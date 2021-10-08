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
<head><!----Bootstrap important---->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!----Bootstrap important---->
</head>
    <div class="dir-list">
      <div class="sup_dir_card">
        <div class="sup-items">
          <h5 class="dir-dir">Dirección#</h5>
          <div class="icons-dir">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_dir" onclick="carga_ajax('<?php echo $arre_usu["cod_dir_usu"]; ?>','edit_dir','./modals/modal_edit_dir.php');"><i class="fas fa-edit" ></i></a>
            
            <i class="far fa-minus-square" onclick="eliminar_direccion('<?php echo $arre_usu["cod_dir_usu"];?>');"></i>
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