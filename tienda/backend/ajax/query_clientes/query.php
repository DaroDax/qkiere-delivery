<?php

session_start();

if (isset($_SESSION ["idusuarios"],$_SESSION ["nombres"],$_SESSION ["idcompany"])){

require_once("../../clase/cliente.class.php");

 $obj_cliente= new cliente;
 $obj_cliente->texto=$_POST["texto"];
 $obj_cliente->asignar_valor();
 $obj_cliente->puntero=$obj_cliente->filtrar();

if($obj_cliente->texto!=''){
	$patron=stripslashes($_POST["texto"]);
	  $si=strlen($patron);
if($si>3){
  
  if($obj_cliente>0){
  ?>
  <br/>
  <br/>
  <div class="table-responsive">
    
        <table id="example1" class="table table-bordered table-striped table-responsive">
           <thead>
                <tr class="bg bg-primary">
                  <th>Contrato</th>
                  <th>Nombres y Apellidos</th>
                  <th>Direcciòn</th>
                  <th>IP</th>
                  <th>MAC</th>
                  <th>Plan</th>
                  <th>Opciòn</th>
                </tr>
              </thead>
               <tbody>
<?php
while(($arreglo=$obj_cliente->extraer_dato())>0){ ?>

				<tr>
                  <td><?php echo $arreglo["idcontratos"]; ?></td>
                  <td><?php echo $arreglo["nombres"]; ?></td>
                  <td><?php echo $arreglo["direccion"]; ?></td>
                  <td><a href="http://<?php echo $arreglo['ip_contrato']; ?>" target="_black" ><?php echo $arreglo['ip_contrato']; ?></a></td>
                  <td><?php echo $arreglo["mac"]; ?></td>
                  <td><?php echo $arreglo["nombre_plan"]; ?></td>
                  <td> <div class="btn-group">
                            <a class="btn btn-primary tip-bottom" title="Editar Datos del Cliente" href="perfil_cliente.php?contrato=<?php echo $arreglo['idcontratos']; ?>"><i class="fa fa-user"></i></a>

                            <a class="btn btn-danger tip-bottom"  href="registrar_pago.php?contrato=<?php echo $arreglo['idcontratos']; ?>" title="Registrar Pago"><i class="fa fa-dollar"></i>
                            </a>

                            <a class="btn btn-warning tip-bottom"  href="../../backend/reportes/contratos.php?contrato=<?php echo $arreglo['idcontratos']; ?>" target="_black" title="Imprimir Contrato"><i class="fa  fa-list"></i></a>
                        </div> 
                  </td>
                </tr>
	<?php } ?>
 				</tbody>
            </table>
  </div>



<?php  //F
}else{
	echo "<br/><br/><br/><h2 aling='center'>No Existen Registros...!!!</h2>";
}
}else { echo "<br/><br/><br/><h2 aling='center'>Consulta muy corta minimo 4 Caracteres...!!!</h2>";}
}
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>