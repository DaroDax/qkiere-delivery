<?php
session_start();
//$_SESSION["cod_usu"];
if (isset($_SESSION["cod_usu"])) {

  require_once("../../backend/clase/sitio_favorito.class.php");
  $obj_sitio_fav = new sitio_favorito;
?>
  <div class="tie-fav">
    <?php
    $obj_sitio_fav->puntero = $obj_sitio_fav->listar();
    while (($arre_tienda = $obj_sitio_fav->extraer_dato()) > 0) { ?>
      <div class="ties_list">
      <a href="#" class="link_tie" onclick="tienda(<?php echo $arre_tienda['cod_tie']; ?>);">
        <div class="card">
          <div class="title-card">
            <h2 class="name-card"><?php echo $arre_tienda["raz_tie"]; ?></h2>

          </div>
          <div class="img-card">
            <img class="logo-card" src="../../../img/log_tie/<?php echo $arre_tienda["log_tie"]; ?>" alt="">
          </div>
      </a>
      <div class="text-card">
        <?php
        if ($arre_tienda["cod_tie"] > 0) {
          $checked = "checked";
          $color = '#F4D03F';
        } else {
          $color = '#000000';
        }
        ?>
        <h3 class="category-card"><?php echo $arre_tienda["nom_cat_tie"]; ?></h3>
        <i class="fas fa-bookmark" style="color:#FFA600;"><input type="checkbox" id="cod_tie_fav" value="<?php echo $arre_tienda["cod_tie"]; ?>" <?php echo $checked; ?> title="Agregar A Favoritos" onclick="quitar_sitios_favoritos('<?php echo $arre_tienda["raz_tie"] ?>','<?php echo $arre_tienda["cod_tie"] ?>' );" /></i>

        <h5 class="horary-card"><i class="far fa-clock"></i> <?php echo $arre_tienda["hor_lun_vie_hor_tie"]; ?> - <?php echo $arre_tienda["hor_sab_hor_tie"]; ?></h5>
        </h5>
      </div>
      <p class="sec_mun"><i class="fas fa-map-marker-alt"></i> <?php echo $arre_tienda["nom_sec"]; ?> - <?php echo $arre_tienda["nom_mun"]; ?></p>
  </div>
</div>
<?php } ?>
</div>

<?php } ?>