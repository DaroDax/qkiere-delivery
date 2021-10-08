/*
$(document).ready(function() {

	notificacion_telegram('<?php echo $_SESSION ["cha_id_tie"];?>')
	setInterval(function(){ notificacion_telegram('<?php echo $_SESSION ["cha_id_tie"];?>'); }, 2000);

});
*/

function notificacion_telegram(chat_id) {
    var mensaje = "\u2705 Tienes nuevos Pedidos Por favor verifique en su tienda virtual";
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    if (Respuesta_mensaje.ok==true) {
      
        console.log("aqui.true");
            notificaciones("Comprobacion exitosa","success");
    }else{
        console.log("aqui.false");
        notificaciones("Error al comprobar","danger");
        window.open('https://telegram.me/1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0?start=ci<?php echo $_SESSION["user"]; ?>', '_blank');
     
    }
}

function notificacion_confir(nom_dom, ape_dom, chat_id) {

    var mensaje = "\u2705 Hola, "+nom_dom+" "+ape_dom+" Gracias Por Pertenecer a nuestra red de domiciliarios, acabas de enviar una Comprobacion del sistema de notificaciones de <b>Q' Kiere</b>, por favor no eliminar este chat para recibir todas las alertas. ";
   	
    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    if (Respuesta_mensaje.ok==true) {
   
        console.log("aqui.true");
            Swal.fire("Bien Hecho","Comprobacion exitosa, Su Chat ID ha sido actualizado","success");
    }/*else{
        console.log("aqui.false");
        notificaciones("Error al comprobar","danger");
        window.open('https://telegram.me/1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0?start=ci<?php echo $_SESSION["user"]; ?>', '_blank');
        
    }*/
}
function notificacion_conf_orden_compra(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom) {
		

    var mensaje = "\u2705 Hola "+nom_dom+" "+ape_dom+", Confirmaste la <b>Orden de Compra N: </b> "+cod_ord_com+"  <b>Tienda:</b> "+raz_tie2+".";

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
/*-----------------------------------*/
function notificacion_conf_orden_compra_nick(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom) {
		

    var mensaje = "\u2705 El domiciliario = "+nom_dom+" "+ape_dom+", Acepto la <b>Orden de Compra N: </b> "+cod_ord_com+" de "+raz_tie2+".";

    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=935272316&text="+mensaje+"&parse_mode=HTML",
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

function notificacion_conf_orden_compra_yei(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom) {
		

    var mensaje = "\u2705 El domiciliario = "+nom_dom+" "+ape_dom+", Acepto la <b>Orden de Compra N: </b> "+cod_ord_com+" de "+raz_tie2+".";

    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=669577448&text="+mensaje+"&parse_mode=HTML",
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
/*------------------------------*/

function notificacion_orden_compra_recibida(chat_id, cod_ord_com, raz_tie, nom_dom, ape_dom) {
		

    var mensaje = "\u2705 Hola "+nom_dom+" "+ape_dom+", Recibiste la <b>Orden de Compra N: </b> "+cod_ord_com+"  <b>Tienda:</b> "+raz_tie+".";

    var JSON=$.ajax({
    url:"https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id="+chat_id+"&text="+mensaje+"&parse_mode=HTML",
    dataType: 'json',
    async: false}).responseText;
    var Respuesta_mensaje=jQuery.parseJSON(JSON);
        console.log("Aqui"+Respuesta_mensaje.ok);
    
}


/*------------------------------*/

/*---------------------------------------------------*/


/*---------------------------------------------------*/
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
									url:"../../backend/controlador/domiciliario/domiciliario.php",
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

function disponibilidad_domiciliario(){

 let estatu_dispo=document.getElementById('switch-label').value;

if(estatu_dispo=='0'){
	mensaje="Activar Disponibilidad recibira todas las notificaciones";
	valor=1;
}else{
	mensaje="Desactivar disponibilidad no recibira notificaciones";
	valor=0;
}

	Swal.fire({
	  title: 'Desea '+mensaje,
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {

	  dataString="dis_dom="+valor+"&&accion=disponibilidad";
	  /* Read more about isConfirmed, isDenied below */

		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/domiciliario/domiciliario.php",
					data:dataString,
					success:function(r){
						/*NOTIFICA TELEGRAM DOMICILIARIO*/
						notificacion_disponibilidad(chat_id, cod_ord_com, raz_tie2, nom_dom, ape_dom);

						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Se Actualizo su Estatus',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
					
		  	} 
	})

}

/*-----------------------------INSERTAR CHAT ID------------------------------------*/


/*-----------------------------------------------------------------------------------------------------------*/
/*  FUNCIONES PARA MUNICIPIO Y SECTOR */
function Consultar_sector(){
$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_direccion/sector.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sector').html(r);

					}
				});
}
