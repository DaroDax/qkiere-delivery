  <?php
require_once("../../clase/inbox.class.php");

 $obj_inbox= new inbox;
 
 $obj_inbox->asignar_valor();
 $obj_inbox->puntero=$obj_inbox->listar();
  ?> 


   <table class="table table-hover table-striped" id="consultar">
                  <tbody>
                   <?php
while(($arreglo=$obj_inbox->extraer_dato())>0){ ?>
                  <tr>
                    <td><input type="checkbox"></td>
                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                    <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                    <td class="mailbox-subject"><b><?php echo $arreglo["asu_inb"]; ?></b> <?php echo $arreglo["men_inb"]; ?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo $arreglo["fec_inb"]; ?></td>
                  </tr>
	<?php } ?>
                
              
                  </tbody>
                </table>

 				</tbody>
            </table>