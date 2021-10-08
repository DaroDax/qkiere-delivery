/* CONSULTA DE INICIO */
function consulta_inicio(){

	if($('#municipio').val()=="")
	{	
		Swal.fire("Error!", "Seleccione Tu municipio", "warning");
		return false;
	}
	var texto=document.getElementById("consultar").value;
	var municipio=document.getElementById("municipio").value;
	var parametros = {
		"texto": texto,
		"municipio":municipio
	};

		$.ajax({ 
		data:parametros,
		url:"../../backend/ajax/query_inventario/query_barra_busqueda.php",
		type:"POST",
		success: function(response){
			$("#datos").html(response);
		}
	});


}

/*----------------------------------------------------*/
function notificacion_confir() {
	
	let chat_id=document.getElementById("chat_id_usu").value;
	let nom_usu=document.getElementById("name").value;

    var mensaje = "\u2705 Hola, "+ nom_usu +" acabas de enviar una Comprobacion del sistema de notificaciones de <b>Q' Kiere</b>, por favor no eliminar este chat para recibir todas las alertas. ";
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

/*----------------------------------------------------*/
function insertar_chat(){

        chat = $("#chat_id_usu").val();

        dataString="chat_id_usu="+chat+"&&accion=add_chat_id";

                $.ajax({
                    type:"POST",
                    url:"../../backend/controlador/usuario/usuario.php",
                    data:dataString,
                    success:function(r){

                    }
                });
                    
}

/* CONSULTA MUNICIPIO Y CATEGORIA CLIENTE */


function consulta_mun_cat(){
var boton_municipio=$('#municipio').val();

	if(boton_municipio==''){
	 	$('#cat_tienda').hide(); 
	}else{
		$('#cat_tienda').show(); 
	}
		$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select/query_sitios_disponibles.php",
			data:"cod_mun="+$('#municipio').val(),
			success:function(r){
				$('#sitios_disponibles').html(r);
			}
		});

		$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select/query_cat_tienda.php",
			data:"cod_mun="+$('#municipio').val(),
			success:function(r){
				$('#cod_cat_tie').html(r);
				consulta_sitios();
			}
		});


	$(".H_banner").hide();
	$("#home_bread").css("padding","30px");

}


function consulta_sitios(){
	var cod_mun=$('#municipio').val();
	var valor=$('#cat_tienda').val();
	 var dataString ="cod_cat_tie="+valor+'&&cod_mun='+cod_mun;

	 

		$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select/query_sitios_disponibles.php",
			data:dataString,
			success:function(r){
				$('#sitios_disponibles').html(r);
			}
		});

		$.ajax({
			type:"POST",
			url:"../../backend/controlador/usuario/usuario.php",
			data:"lon_miu="+valor+"&&accion=select_cat",
			success:function(r){
				console.log("valor ="+valor);
			}
		});
}




/* AGREGAR SITIOS FAVORITOS */
function add_sitios_favoritos(raz_tie){

	var valida_check=document.getElementById("cod_tie_fav").checked;
	var outro = document.getElementById('des_bot');
	if (valida_check==true){ 
		accion="insertar";
		outro.style.color = '#F4D03F';
		
	}else{

		accion="eliminar";
		outro.style.color = '#000000';
	}

	 var dataString = 'cod_tie='+$('#cod_tie_fav').val()+'&&accion='+accion;

	$.ajax({
			type:"POST",
			url:"../../backend/controlador/sitio_favorito/sitio_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){
					
    			Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: raz_tie+'<br> Eliminado de Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				
				}else{
				
				
					Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: raz_tie+'<br> Agregado a Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
			}
		});


}

function quitar_sitios_favoritos(raz_tie, cod_tie){
	
	 var dataString = 'cod_tie='+cod_tie+'&&accion=eliminar';

	$.ajax({
			type:"POST",
			url:"../../backend/controlador/sitio_favorito/sitio_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){
					
    			Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: raz_tie+'<br> Eliminado de Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				
				}
			}
		});


}



/* AGREGAR PRODUCTOS FAVORITOS */
function add_producto_favorito(id,dato){
	var intro = document.getElementById('fav_bot');
	if (dato==true){ 
		accion="insertar";
		intro.style.color = '#E74C3C';
	}else{

		accion="eliminar";
		intro.style.color = '#000000';
	}
	var dataString = 'cod_inv='+id+'&&accion='+accion;
	

$.ajax({
			type:"POST",
			url:"../../backend/controlador/producto_favorito/producto_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){

    				Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: 'Producto Favorito Eliminado',
						  showConfirmButton: false,
						  timer: 1500
						});
				}else{
					Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Agregado a Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
			}
		});

}


/* AGREGAR MIS DIRECCIONES USUARIO */
function add_usuario_dir(){


	var sector=document.getElementById('cod_sector').value;
	
      if($("#nom_dir_usu").val()=='' || $("#dir_dir_usu").val()=='' || sector==''){
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");

			return false;
      }else{
	
			var dataString = 'nom_dir_usu='+$("#nom_dir_usu").val()+'&&dir_dir_usu='+$("#dir_dir_usu").val()+'&&sector='+sector+'&&accion=insertar';

			$.ajax({
						type:"POST",
						url:"../../backend/controlador/usuario/usuario.php",
						data:dataString,
						success:function(r){
							if(r!=''){
					

    			Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Dirección Añadida',
						  showConfirmButton: false,
						  timer: 1500
						});
    			$("#nom_dir_usu").val(''); 
    			$("#dir_dir_usu").val('');
    			$("#cod_sector").val('');
    			$("#municipio").val('');
    			direccion_delivery();
				}else{
					Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: 'Dirección Eliminada',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
						}
					});
		}
		

}



/* EDITAR MIS DIRECCIONES USUARIO */
function editar_direccion(cod_dir){

	var sector=document.getElementById('cod_sector').value;
	var cod_dir_usu=cod_dir;
	
      if($("#nom_dir_usu").val()=='' || $("#dir_dir_usu").val()=='' || sector==''){
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");

			return false;
      }else{
	
				var dataString = 'nom_dir_usu='+$("#nom_dir_usu").val()+'&&dir_dir_usu='+$("#dir_dir_usu").val()+'&&sector='+sector+'&&cod_dir_usu='+cod_dir_usu+'&&accion=modificar_direccion';
			
				$.ajax({
						type:"POST",
						url:"../../backend/controlador/usuario/usuario.php",
						data:dataString,
						success:function(r){
		
			    			Swal.fire({
									  position: 'top-end',
									  icon: 'success',
									  title: 'Dirección Actualizada',
									  showConfirmButton: false,
									  timer: 1500
							});
		    			
						}
				});
			}
		

}






/*---------------------------------------------------------------------------------------------------*/
function eliminar_direccion(id){
	Swal.fire({
	  title: 'Desea Eliminar la Dirección?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/usuario/usuario.php",
					data:"cod_dir_usu=" +id+"&&accion=eliminar_direccion",
					success:function(r){
						
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Dirección Eliminada',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
		  	} 
	})

}


/*---------------------------------------------------------------------------------*/

/* SELECT DE MUNICIPIO Y SECTOR */

function Consultar_sector(){

	$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select_direccion/sector.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sector').html(r);

					}
				});
}


/* SELECT DE MUNICIPIO Y SECTOR */

function act_usuario(){
  
   var cod_area=document.getElementById('cod_area').value;
      var telefono=document.getElementById('telefono').value;
	
	alert(sector);
      if($("#cod_area").val()=='' || $("#telefono").val()==''){
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");

			return false;
      }else{
	
	
			$.ajax({
					type:"POST",
					url:"../../backend/controlador/query_select_estado/query_sector.php",
					data:"cod_mun=" + $('#municipio').val(),
					success:function(r){
						$('#sector').html(r);
							}
						});
			
		}
}




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
									url:"../../backend/controlador/usuario/usuario.php",
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

function new_usuario_dir(){

		Swal.fire({
		  title: 'Escribe tu dirección',
		  html:
		    '<input type="text" id="nom_dir" class="swal2-input" placeholder="Nombre Dirección" value="">' +
			'<input type="text" id="des_dir" class="swal2-input" placeholder="Descripción" value="">'+
			'<input type="text" id="sec_dir" class="swal2-input" placeholder="Sector" value="1" readonly>',
		  focusConfirm: false,
		  preConfirm: () => {

		    let nom=document.getElementById('nom_dir').value;
			let des=document.getElementById('des_dir').value;
			let sec=document.getElementById('sec_dir').value;
			
			if(nom=='' || des=='' || sec==''){
		    	Swal.fire("Error!", "Tienes Campos Vacios", "warning");
				return false;
			}else{

			var dataString = 'nom_dir_usu='+nom+'&&dir_dir_usu='+des+'&&sector='+sec+'&&accion=insertar';

			$.ajax({
						type:"POST",
						url:"../../backend/controlador/usuario/usuario.php",
						data:dataString,
						success:function(r){
							Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Dirección Añadida',
						  showConfirmButton: false,
						  timer: 1500
						});
						}
				  
			})
		}}
 	})		
}		  




					/*----------------------------------------------*/
    function notificacion_tienda() {

    var mensaje = "\u2705 Hola "+raz_tie+", Se ha creado una nueva orden de compra ";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}

function notificacion_yei() {

    var mensaje = "\u2705 Hola Yeimer, Se ha creado una nueva orden de compra en "+raz_tie+".";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=669577448&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}

function notificacion_nico() {

     var mensaje = "\u2705 Hola Nico, se ha creado una orden de compra en "+raz_tie+".";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=1727293259&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}

/*-----------------------------------------*/

notificacion_nico();
notificacion_yei();
notificacion_tienda();
/*-----------------------------------------*/
/*					window.location.href = "orden_pedido.php?cod_tie="+cod_tie;

			  	} 
		})
	}//CIERRE ELSE 
	
}
*/
function cancelar_orden_compra(cod_ord_com){

Swal.fire({
		  title: 'Desea Cancelar la Orden de Compra # '+cod_ord_com+' ?',
		  showCancelButton: true,
		  confirmButtonText: 'Si'
			}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  dataString="cod_ord_com="+cod_ord_com+"&&accion=eliminar_orden_compra";

			  if (result.isConfirmed) {
			    	$.ajax({
						type:"POST",
						url:"../../backend/controlador/orden_compra/orden_compra.php",
						data:dataString,
						success:function(r){
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Orden de Compra Eliminada con Exito.',
								showConfirmButton: false,
								timer: 1500
							});
						}
					});
						

			  	} 
		})
}	





/*----------------------------------------------------------------------------------------------*/
function modificar_datos(){

	  			$("#tel_usu").attr("readonly", "readonly");
                $("#cod_area").attr("disabled", "disabled");

                 $("#tel_usu").css("border", "1px solid #FF6A00");
                $("#cod_area").css("border", "1px solid #FF6A00");

Swal.fire({
		  title: 'Desea actualizar sus Datos?',
		  showCancelButton: true,
		  confirmButtonText: 'Si'
			}).then((result) => {
			let cod_area_usu=document.getElementById('cod_area').value;
			let tel_usu=document.getElementById('tel_usu').value;

			alert(cod_area_usu +" "+tel_usu);

		  /* Read more about isConfirmed, isDenied below */
		  dataString="cod_area_usu="+cod_area_usu+"&&tel_usu="+tel_usu+"&&accion=modificar_datos";

			  if (result.isConfirmed) {
			    	$.ajax({
						type:"POST",
						url:"../../backend/controlador/usuario/usuario.php",
						data:dataString,
						success:function(r){
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Sus Datos se Actualizaron con Exito.',
								showConfirmButton: false,
								timer: 1500
							});
						}
					});
						

			  	} 
		})
}





/*------------------------------------------------------------------------------*/
function direccion_delivery(){

var parametros="hola";
		$.ajax({ 
		type:"POST",
		data:parametros,
		url:"../../backend/ajax/query_select_direccion/direccion_delivery.php",
		success: function(response){
			$("#direccion_delivery").html(response);
		}
	});


}



  /*----FUNCION DE LOS MENSAJES----*/
/*----------------------------------*/
function tienda_chat(id){
	dataString="tienda_cod_tie="+id;

	$(".inbox_people").hide();
	$(".mesgs").show();

	$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_chat/chat.php",
			data:dataString,
			success:function(r){
				$('#chat_tienda').html(r);
				var miInterval = setInterval(tienda_chat(id),2000);
					
					}
				});
}

/*----------------------------------*/

function sent_msj(){
	cod_tie = $("#tienda_cod").val();
	cod_dom = $("#domi_cod").val();

	mensaje = $("#msj").val();





	if (cod_dom>0){
		dataString="men_chat_dom="+mensaje+"&&domiciliario_cod_dom="+cod_dom+"&&accion=new_msj_dom";
	}else{
		dataString="men_chat_usu="+mensaje+"&&tienda_cod_tie="+cod_tie+"&&accion=new_msj";
	}

	alert(dataString);


bajar_scroll();

	$.ajax({
			type:"POST",
			url:"../../backend/controlador/chat/chat.php",
			data:dataString,
			success:function(r){

					$("#msj").val("");

				
					}
				});
}

/*------------------------------------------*/

function dom_chat(id){
	dataString="domiciliario_cod_dom="+id;

	$(".inbox_people").hide();
	$(".mesgs").show();

	$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_chat/chat.php",
			data:dataString,
			success:function(r){
				$('#chat_tienda').html(r);
				var miInterval = setInterval(dom_chat(id),2000);
					
					}
				});
}

function back_to_chat(){
	location.href = "chat_page.php";
}

function bajar_scroll(){
	$(".msg_history").scrollTop(1000000);
}
/*----------------------------------------*/
function msj_leido_usu(cod_tie){

	dataString="tienda_cod_tie="+cod_tie+"&&accion=msj_leido";
	
	$.ajax({
			type:"POST",
			url:"../../backend/controlador/chat/chat.php",
			data:dataString,
			success:function(r){		
					}
				});
}

function msj_leido_dom(cod_dom){

	dataString="domiciliario_cod_dom="+cod_dom+"&&accion=msj_leido_dom";
	
	$.ajax({
			type:"POST",
			url:"../../backend/controlador/chat/chat.php",
			data:dataString,
			success:function(r){		
					}
				});
}
/*---------------------------------------------------*/
function borrado_logico(){
	cod_tie = $("#tienda_cod").val();
	cod_dom = $("#domi_cod").val();
	alert("este click funciona" + dataString);
	Swal.fire({
		  title: 'Desea eliminar el chat?',
		  showCancelButton: true,
		  confirmButtonText: 'Si'
			}).then((result) => {
				if (cod_dom>0){
		dataString="domiciliario_cod_dom="+cod_dom+"&&accion=borrado_dom";
	}else{
		dataString="tienda_cod_tie="+cod_tie+"&&accion=borrado";
	}
			  if (result.isConfirmed) {
			    	$.ajax({
			type:"POST",
			url:"../../backend/controlador/chat/chat.php",
			data:dataString,
			success:function(r){
				Swal.fire({
								position: 'top-end',
								icon: 'warning',
								title: 'Chat Eliminado.',
								showConfirmButton: false,
								timer: 1500
							});
					}
				});
			  	} 
		})
}


//*CAMBIAR MUNICIPIO NUEVA INTERFAZ*//

function municipio(){
cod_mun = $("#municipio").val();
location.href="./menu.php?mun="+cod_mun;
inicio(cod_mun);
}

