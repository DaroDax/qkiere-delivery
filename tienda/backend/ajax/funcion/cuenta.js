/*-----------------------------------------------------------------------------------------------------------*/
/*  FUNCIONES PARA MUNICIPIO Y SECTOR */
function consultar_sector(){
$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_direccion/sector.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sector').html(r);

					}
				});
}

/*-------CAMBIAR FOTO------------------------------------------------------------------------------------------------------*/
function tomar_foto (id) {
            var inp = document.getElementById ("ico");
            
            total = inp.value;
           nueva = total.substr(12,undefined);

          

          $.ajax({
			type:"POST",
			url:"../../backend/controlador/tienda/tienda.php",
			data:"log_tie="+nueva+"&&cod_tie="+id+"&&accion=cambio_foto",
			success:function(r){
				validarForm();
				
					}
				});
        }


/*-----------------------------------------------Cambiar hora----------------------------------------------------------*/
function tomar_hora(){
			desde = $("#hor_lun_vie_hor_tie").val();
			hasta = $("#appt").val();

			$.ajax({
						type:"POST",
						url:"../../backend/controlador/horario/hora.php",
						data: "hor_lun_vie_hor_tie="+desde+"&&hor_sab_hor_tie="+hasta+"&&accion=actualizar_hora",
						success:function(r){
						}
				});

		
			}
/*-------------------------------------------------Activar Horario----------------------------------------------*/

function insertar_horario(){

			$.ajax({
						type:"POST",
						url:"../../backend/controlador/horario/hora.php",
						data:"accion=activar_horario",
						success:function(r){
							location.href="cuenta.php";
						}
				});

		
			}



/*-----------------------------------------------SUBIR FOTO A CARPETA-------------------------------------------------------*/
function validarForm(sender)
{
  //obtengo mi formulario por ID
   form = document.getElementById('formul');
  //MUESTRO CONFIRMACION PARA HACER EL SUBMIT
  
    form.submit();


  
}
/*---------------------------------------------------------------------*/
function actualizar_tienda(){
	tip_doc_tie=$('#tip_doct_tie').val();
	rif_tie=$('#rif_tie').val();
	raz_tie=$('#raz_tie').val();
	dir_tie=$('#dir_tie').val();
	tel_tie=$('#tel_tie').val();
	tel2_tie=$('#tel2_tie').val();
	ema_tie=$('#ema_tie').val();

	dataString="tip_doc_tie="+tip_doc_tie+"&&rif_tie="+rif_tie+"&&raz_tie="+raz_tie+"&&dir_tie="+dir_tie+"&&tel_tie="+tel_tie+"&&tel2_tie="+tel2_tie+"&&ema_tie="+ema_tie+"&&accion=actualizar";
	
	Swal.fire({
	  title: 'Desea Actualizar los Datos?',
	  showCancelButton: true,
	  confirmButtonText: 'Si' /*blob:https://web.telegram.org/ad37aca7-c5e6-482f-9174-be7cab0bc99e*/
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/tienda/tienda.php",
					data:dataString,
					success:function(r){
						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Datos Actualizados Correctamente',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
					
		  	} 
	})

}

/* ACTIVA E INACTIVA EL PRODUCTO */
function actualizar_dia(cod_tie,estatu,dia){

	

	switch(dia){

		case 1: semana="lun_hor_tie="; 
				day="lun_hor_tie";
		break;

		case 2: semana="mar_hor_tie="; 
				day="mar_hor_tie";
		break;

		case 3: semana="mie_hor_tie="; 
				day="mie_hor_tie";
		break;

		case 4: semana="jue_hor_tie="; 
				day="jue_hor_tie";
		break;

		case 5: semana="vie_hor_tie="; 
				day="vie_hor_tie";
		break;

		case 6: semana="sab_hor_tie="; 
				day="sab_hor_tie";
		break;

		case 7: semana="dom_hor_tie="; 
				day="dom_hor_tie";
		break;

	}

if(estatu==1){
	estatu2=0;
	est="Dia Inactivo";
	est2="Desactivar";
}

else{
	estatu2=1;
	est="Dia Activo";
	est2="Activar";	
}


Swal.fire({
	  title: '¿Desea '+est2+" Este Dia?",
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {

				$.ajax({
						type:"POST",
						url:"../../backend/controlador/horario/hora.php",
						data: semana+estatu2+"&&tienda_cod_tie="+cod_tie+"&&opcion="+day+"&&estatu="+estatu2+"&&accion=actualizar_dia",
						success:function(r){
								
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: est,
									showConfirmButton: false,
									timer: 1500
								});
								//location.href="cuenta.php";
						}

				});

		  	} 
	})
}
/*----------------------------Funcion Confirmar Telegram--------------------------------------*/
function notificacion_confir() {
	
	let chat_id=document.getElementById("cha_id_tie").value;
	let raz_tie=document.getElementById("raz_tie").value;

    var mensaje = "\u2705 Hola, "+ raz_tie+" acabas de enviar una Comprobacion del sistema de notificaciones de <b>Q' Kiere</b>, por favor no eliminar este chat para recibir todas las alertas. ";
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    if (Respuesta_mensaje.ok==true) {
   
        console.log("aqui.true");
            Swal.fire("Bien Hecho","Comprobacion exitosa","success");
    }else{
        console.log("aqui.false");
        notificaciones("Error al comprobar","danger");
        window.open('https://telegram.me/1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0?start=ci<?php echo $_SESSION["user"]; ?>', '_blank');
        
    }
}
/*----------------------------------------------------------------------------------------------*/
function cambiar_clave(){

		Swal.fire({
		  title: 'Cambiar Clave',
		  html:
		    '<input type="password" id="swal-input1" class="swal2-input" placeholder="Nueva Clave">' +
		    '<input type="password" id="swal-input2" class="swal2-input" placeholder="Confirme la Clave">',
		  focusConfirm: false,
		  preConfirm: () => {

		    let clave1=document.getElementById('swal-input1').value;
		    let clave2=document.getElementById('swal-input2').value;
		    if(clave1=='' || clave2==''){
		    	Swal.fire("Error!", "Tienes Campos Vacios", "warning");
				return false;
			}else{
				    if(clave1==clave2){
				    
				    	var dataString="Newpas_usu="+clave2+"&&accion=cambio_clave";
				    	 $.ajax({
									type:"POST",
									url:"../../backend/controlador/tienda/tienda.php",
									data:dataString,
									success:function(r){
										
										Swal.fire({
												  position: 'top-end',
												  icon: 'success',
												  title: 'Su Clave se Actualizo Correctamente',
												  showConfirmButton: false,
												  timer: 1500
												});
											}
							});
							
				    }else{
				    	Swal.fire("Error!", "Error la clave no coincide", "warning");
				return false;
				    
				    }
			}
		  }
		})


}

/*---------------------------------*/

function insertar_chat(){

        chat = $("#cha_id_tie").val();

        dataString="cha_id_tie="+chat+"&&accion=add_chat_id";

                $.ajax({
                    type:"POST",
                    url:"../../backend/controlador/tienda/tienda.php",
                    data:dataString,
                    success:function(r){

                    }
                });
                    
            }
