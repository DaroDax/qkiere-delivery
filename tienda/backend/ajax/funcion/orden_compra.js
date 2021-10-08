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




function aceptar_orden(cod_ord_com,cod_usu,raz_tie,chat_id_usu){

	 function not_usuario() {
    /*Notificación Domiciliario*/
    var mensaje = "\u2705 Hola, usuario, su orden N"+cod_ord_com+" fue aceptada por la tienda "+raz_tie;
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id_usu+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    }



	dataString="cod_ord_com="+cod_ord_com+"&&cod_usu="+cod_usu+"&&accion=aceptar_orden";



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

						reenviar_domi();
						not_usuario();

						Swal.fire(
  'Aceptaste La orden!',
  'Ahora, debes esperar al domicilairio',
  'success'
)
					}
				});
				
		    	 

/*----------------------------------------------*/
    function not_domicilio(chat_id_dom) {
    /*Notificación Domiciliario*/
    var mensaje = "\u2705 Hola, la tienda "+raz_tie+" tiene una nueva orden para repartir N="+cod_ord_com+".";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id_dom+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}
/*----------------------------------------------*/

   function not_dom() {
    /*Notificación Nicolay*/
    var mensaje = "\u2705 Hola Nico, la tienda "+raz_tie+" acepto la orden N="+cod_ord_com+".";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=935272316&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}

 function not_domi() {
    /*Notificacion Yeimer*/
    var mensaje = "\u2705 Hola Yeimer, la tienda "+raz_tie+" acepto la orden N="+cod_ord_com+".";
    
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=669577448&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}
/*-----------------------------------------*/

not_dom();
not_domi();

		  	} 
	})

}



/*---------------------------------------------------------------------------------------------------------*/

function rechazado_logico(cod_ord_com,cod_usu){

dataString="cod_ord_com="+cod_ord_com+"&&cod_usu="+cod_usu+"&&accion=eliminar_logico";


	Swal.fire({
	  title: '¿Desea Eliminar? ¡No podra restaurar su Producto!',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/orden_compra/orden_compra.php",
					data:dataString,
					success:function(r){
						
					}
				});
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Producto Eliminado',
						showConfirmButton: false,
						timer: 1500
					});
		  	} 
	})


}
