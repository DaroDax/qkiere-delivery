/*  FUNCIONES PARA MUNICIPIO Y SECTOR */
function consultar_sector(){
	//alert("hola");
$.ajax({
			type:"POST",
			url:"../../../delivery/tienda/backend/ajax/query_direccion/sector_pub.php",//en el servidor acuerdate de quitarle delivery
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sector').html(r);

					}
				});
}

/*----------------------------------------------------*/

/*----------------------------------*/
function tienda_chat(id){
	dataString="usuario_cod_usu="+id;


	$(".inbox_people").hide();
	$(".mesgs").show();

	$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_chat/chat.php",
			data:dataString,
			success:function(r){
				$('#chat_usuario').html(r);
				var miInterval = setInterval(tienda_chat(id),2000);
					
					}
				});
}

/*----------------------------------*/

function sent_msj(){
	cod_usu = $("#usuario_cod").val();
	cod_dom = $("#domi_cod").val();

	mensaje = $("#msj").val();



	if (cod_dom>0){
		dataString="men_chat_tie="+mensaje+"&&domiciliario_cod_dom="+cod_dom+"&&accion=new_msj_dom";
	}else{
		dataString="men_chat_usu="+mensaje+"&&usuario_cod_usu="+cod_usu+"&&accion=new_msj";
	}

	


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
				$('#chat_usuario').html(r);
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
function msj_leido_usu(cod_usu){

	dataString="usuario_cod_usu="+cod_usu+"&&accion=msj_leido";
	
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

	cod_usu = $("#usuario_cod").val();
	cod_dom = $("#domi_cod").val();

	if (cod_dom>0){
		dataString="domiciliario_cod_dom="+cod_dom+"&&accion=borrado_dom";
	}else{
		dataString="usuario_cod_usu="+cod_usu+"&&accion=borrado";
	}

	alert("este click funciona" + dataString);
	

	Swal.fire({
		  title: 'Desea eliminar el chat?',
		  showCancelButton: true,
		  confirmButtonText: 'Si'
			}).then((result) => {

				if (cod_dom>0){
		dataString="domiciliario_cod_dom="+cod_dom+"&&accion=borrado_dom";
	}else{
		dataString="usuario_cod_usu="+cod_usu+"&&accion=borrado";
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

