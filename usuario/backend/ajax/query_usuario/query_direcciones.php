<?php

session_start();
if (isset($_SESSION ["cod_usu"])){

require_once("../../clase/usuario.class.php");

    $obj_usuario = new usuario;
    $obj_usuario->asignar_valor();
  $obj_usuario->puntero=$obj_usuario->misDirecciones();
    while(($arre_usu=$obj_usuario->extraer_dato())>0){ ?>

      <div class="signup_right col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="login_box">
          <h2 class="title">#Direcciones</h2> <button type="submit" title="¿Eliminar?" onclick="eliminar_direccion('<?php echo $arre_usu["cod_dir_usu"];?>');"><i class="fa fa-times" aria-hidden="true" id="far"></i></button>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_dir" onclick="carga_ajax('<?php echo $arre_usu["cod_dir_usu"]; ?>','edit_dir','modals/modal_edit_dir.php');"><i class="fas fa-pencil-alt" id="edit"></i></a>
               <div class="login_box_content">
                  <h5>Nombre:</h5>
                  <input type="hidden" id="nom_Dir" value="<?php echo $arre_usu['nom_dir_usu'];?>" name="nom_Dir" placeholder="Mi casa, Mi oficina.....">
                  <b><?php echo $arre_usu['nom_dir_usu'];?>.</b>

                  <br>
                  <br>

                  <h5>Descripción:</h5>
                  <input type="hidden" id="des_Dir" value="<?php echo $arre_usu['dir_dir_usu'];?>" name="des_Dir" placeholder="Avenida, Calle, Urbanización">
                   <p><?php echo $arre_usu['dir_dir_usu'];?>.</p>


                  <h5>Municipio:</h5>
                  
                  <input type="hidden" id="mun_Dir" value="<?php echo $arre_usu["cod_mun"]; ?>" name="mun_Dir">
                  <p><?php echo $arre_usu["nom_mun"]; ?></p>
                  <br>
                  
                  <h5>Sector:</h5>
                  
                  <input type="hidden" id="sec_Dir" value="<?php echo $arre_usu['cod_sec'];?>" name="sec_Dir">
                  <p><?php echo $arre_usu['nom_sec'];?></p>
                  <br>
                  <hr>
              </div>
              <div class="" id="editSA">
                  <form method="post" id="ShippingAdd" action="thank-you.html">
                      <div class="login_form">
                          <ul>
                              <li>
                                  <label for="Address">Address</label>
                                  <textarea class="form-control" id="dress" name="address" title="Address"></textarea>
                              </li>
                              <li>
                                  <label for="EmailAddress">Email Address</label>
                                  <input class="form-control" id="EmailAddress" name="emailaddress" title="Email Address" type="email">
                              </li>
                              <li>
                                  <label for="Password">Password</label>
                                  <input class="form-control" title="Password" id="Pasword" name="password" type="password">
                              </li>
                              <li>
                                  <button type="submit" class="loginbutton red_btn trans ShippingAddbtn hvr-float-shadow" name="Login">Submit</button>
                              </li>
                          </ul>
                      </div>
                     
                  </div>
              </div>
        </div>
<?php }//// CIERRE WHILE
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>