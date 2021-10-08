$(document).ready(function() {

	notificacion_telegram('<?php echo $_SESSION ["cha_id_tie"];?>')
	setInterval(function(){ notificacion_telegram('<?php echo $_SESSION ["cha_id_tie"];?>'); }, 2000);

});

function busqueda(){

	var texto=document.getElementById("consultar").value;
	var parametros = {
		"texto": texto
	};
	

	$.ajax({ 
		data:parametros,
		url:"../../backend/ajax/query_clientes/query.php",
		type:"POST",
		success: function(response){
			$("#datos").html(response);
		}
	});

}




function aceptar_orden(cod_ord_com,cod_tie,cod_usu,chat_id, nom_dom, ape_dom,chat_id_usu){

	function not_usuario() {
    /*Notificación Domiciliario*/
    var mensaje = "\u2705 Hola, usuario, su orden N"+cod_ord_com+" sera buscada por el domiciliario "+nom_dom+" "+ape_dom;
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id_usu+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    }

let raz_tie2=document.getElementById("raz_tie").value;

dataString="cod_ord_com="+cod_ord_com+"&&cod_tie="+cod_tie+"&&cod_usu="+cod_usu+"&&accion=aceptar_orden";

	Swal.fire({
	  title: 'Desea Aceptar la orden de Compra # '+cod_ord_com+' ?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {

	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/orden_compra/orden_compra.php",
					data:dataString,
					success:function(r){
						/*NOTIFICA TELEGRAM DOMICILIARIO*/
						notificacion_conf_orden_compra(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom);
						notificacion_conf_orden_compra_nick(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom);
						notificacion_conf_orden_compra_yei(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom);
						not_usuario();

						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Orden de Compra Aceptada',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
					
		  	} 
	})

}

function recibir_orden_compra(cod_ord_com, cod_tie, raz_tie, cod_usu, chat_id, nom_dom, ape_dom){


dataString="cod_ord_com="+cod_ord_com+"&&cod_tie="+cod_tie+"&&cod_usu="+cod_usu+"&&accion=recibir_paquete";
//alert(dataString);

	Swal.fire({
	  title: 'Desea Recibir la orden de Compra # '+cod_ord_com+' ?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {

	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/orden_compra/orden_compra.php",
					data:dataString,
					success:function(r){
						/*NOTIFICA TELEGRAM DOMICILIARIO*/
						//notificacion_orden_compra_recibida(chat_id, cod_ord_com, raz_tie, nom_dom, ape_dom);

						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Orden de Compra Recibida',
						showConfirmButton: false,
						timer: 1500
					});

						 setTimeout(location.href="menu.php",4000);
					}
				});
					
		  	} 
	})

}



/*---------------------------------------------------------------------------------------------------------*/

function entregar_orden_compra(cod_ord_com, cod_tie, raz_tie, cod_usu, chat_id, nom_dom, ape_dom,cha_id_tie){

	function not_tienda() {
    /*Notificación Domiciliario*/
    var mensaje = "\u2705 Hola "+raz_tie+", el domiciliario <b>"+nom_dom+" "+ape_dom+"</b> Entrego la orden de compra N"+cod_ord_com;
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+cha_id_tie+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    }


dataString="cod_ord_com="+cod_ord_com+"&&cod_tie="+cod_tie+"&&cod_usu="+cod_usu+"&&accion=entregar_paquete";


	Swal.fire({
	  title: 'La orden de Compra # '+cod_ord_com+' ha sido entregada?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {

	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/orden_compra/orden_compra.php",
					data:dataString,
					success:function(r){
						/*NOTIFICA TELEGRAM DOMICILIARIO*/
						//notificacion_orden_compra_entregada(chat_id, cod_ord_com, raz_tie, nom_dom, ape_dom,chat_id_tie);
						not_tienda();
						
						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Orden de Compra Entregada',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
					
		  	} 
	})

}


