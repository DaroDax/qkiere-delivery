
function chat_window(id){

	//alert(id);
	$("#chat_msj").load('./chat_ventana.php?cod_usu='+id);
  	
  	$('.chat-mensajes').show();
    $('.chat-content').hide();
    $('.chat-people').hide();

    /*$.ajax({
			type:"POST",
			url:"../../../tienda/frontend/pages/chat_ventana.php",
			data:dataString,
			success:function(r){
				$('#chat_msj').html(r);
					}
				});*/
}

//------------------------------------------------------------------------------------------//


